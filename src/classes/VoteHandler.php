<?php
class VoteHandler
{
    private $db;
    private $voter;
    private $nominee;
    private $category;
    private $rating;
    private $comment;
    private $vote_status;

    public function __construct($db)
    {
        $this->db = $db;
        $this->vote_status = "";
    }

    public function setFormData($data)
    {
        $this->voter = isset($data['voter']) && is_numeric($data['voter']) ? (int)$data['voter'] : null;
        $this->nominee = isset($data['nominee']) ? trim($data['nominee']) : null;
        $this->category = isset($data['category']) ? trim($data['category']) : null;
        $this->rating = isset($data['rating']) && is_numeric($data['rating']) ? (int)$data['rating'] : null;
        $this->comment = isset($data['comment']) ? trim($data['comment']) : null;
    }

    public function handleFormSubmission()
    {
        if (empty($this->voter) || empty($this->nominee) || empty($this->category) || empty($this->rating) || empty($this->comment)) {
            $this->vote_status = "All fields are required!";
            return $this->vote_status;
        }

        if ($this->rating < 1 || $this->rating > 5) {
            $this->vote_status = "Rating must be between 1 and 5!";
            return $this->vote_status;
        }

        if ($this->voter == $this->nominee) {
            $this->vote_status = "You cannot vote for yourself!";
            return $this->vote_status;
        }

        if (!is_numeric($this->voter) || $this->voter <= 0) {
            $this->vote_status = "Invalid voter ID!";
            return $this->vote_status;
        }

        $stmt = $this->db->prepare("INSERT INTO votes (voter, nominee, rating, category, comment, timestamp) VALUES (:voter, :nominee, :rating, :category, :comment, NOW())");
        $stmt->bindParam(':voter', $this->voter, PDO::PARAM_INT);
        $stmt->bindParam(':nominee', $this->nominee, PDO::PARAM_INT);
        $stmt->bindParam(':rating', $this->rating, PDO::PARAM_INT);
        $stmt->bindParam(':category', $this->category, PDO::PARAM_STR);
        $stmt->bindParam(':comment', $this->comment, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $this->vote_status = "Vote successfully submitted!";
        } else {
            $this->vote_status = "There was an error submitting your vote.";
        }

        return $this->vote_status;
    }
}
