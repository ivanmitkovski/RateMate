<?php
class Vote
{
    private $conn;
    private $table = 'votes';
    private $categoriesTable = 'categories';

    private $voter;
    private $nominee;
    private $rating;
    private $comment;
    private $category;
    private $timestamp;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function setVoter($voter_id)
    {
        $this->voter = $voter_id;
    }

    public function setNominee($nominee_id)
    {
        $this->nominee = $nominee_id;
    }

    public function setRating($rating)
    {

        if ($rating < 1 || $rating > 5) {
            throw new Exception('Rating must be between 1 and 5.');
        }
        $this->rating = $rating;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    public function setCategory($category_id)
    {
        $this->category = $category_id;
    }

    public function setTimestamp($timestamp = null)
    {
        if ($timestamp === null) {
            $this->timestamp = date('Y-m-d H:i:s');
        } else {
            $this->timestamp = $timestamp;
        }
    }

    public function submitVote()
    {
        if ($this->voter == $this->nominee) {
            throw new Exception('You cannot vote for yourself.');
        }


        if (empty($this->comment)) {
            throw new Exception('Please provide a comment.');
        }

        $this->setTimestamp();

        $query = 'INSERT INTO ' . $this->table . ' (voter, nominee, rating, comment, category, timestamp) 
                  VALUES (:voter, :nominee, :rating, :comment, :category,:timestamp)';
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':voter', $this->voter);
        $stmt->bindParam(':nominee', $this->nominee);
        $stmt->bindParam(':rating', $this->rating);
        $stmt->bindParam(':comment', $this->comment);
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':timestamp', $this->timestamp);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getVoteResults()
    {
        $query = 'SELECT category, nominee, AVG(rating) as average_rating, COUNT(*) as vote_count 
                  FROM ' . $this->table . ' 
                  GROUP BY category, nominee 
                  ORDER BY category, average_rating DESC';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getCategoryWinners($category)
    {
        $query = "SELECT CONCAT(e.first_name, ' ', e.last_name) AS full_name, e.job_title, AVG(v.rating) as average_rating 
                  FROM votes v
                  JOIN employees e ON v.nominee = e.employee_id
                  WHERE v.category = :category
                  GROUP BY v.nominee
                  ORDER BY average_rating DESC
                  LIMIT 3";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':category', $category);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTopVoters()
    {
        $query = 'SELECT voter, COUNT(*) as vote_count, CONCAT(e.first_name, " ", e.last_name) AS full_name
                  FROM ' . $this->table . ' v
                  JOIN employees e
                  ON e.employee_id = v.voter
                  GROUP BY voter 
                  ORDER BY vote_count DESC LIMIT 3';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getCategories()
    {
        $query = 'SELECT * FROM ' . $this->categoriesTable;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getEmployees()
    {
        $query = 'SELECT employee_id, CONCAT(first_name, " ", last_name) AS full_name 
                  FROM employees';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getAllTimeBestColleague()
    {
        $query = 'SELECT nominee, CONCAT(e.first_name, " ", e.last_name) AS full_name, 
                         e.job_title, AVG(v.rating) AS average_rating, COUNT(*) AS vote_count
                  FROM ' . $this->table . ' v
                  JOIN employees e ON v.nominee = e.employee_id
                  GROUP BY nominee
                  ORDER BY average_rating DESC, vote_count DESC
                  LIMIT 1';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return null;
        }
    }
}
