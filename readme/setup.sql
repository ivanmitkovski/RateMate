-- Creating Database 
CREATE DATABASE IF NOT EXISTS rate_mate;
USE rate_mate;

-- Creating Tables 
CREATE TABLE employees (
	employee_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(64),
    last_name VARCHAR(128),
    job_title VARCHAR(128)
);

CREATE TABLE categories (
	category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(64)
);

CREATE TABLE votes (
	vote_id INT AUTO_INCREMENT PRIMARY KEY,
    voter INT,
    nominee INT,
    rating TINYINT UNSIGNED,
    comment TEXT,
    category INT,
    timestamp DATETIME,
    FOREIGN KEY (voter) REFERENCES employees(employee_id),
	FOREIGN KEY (nominee) REFERENCES employees(employee_id),
	FOREIGN KEY (category) REFERENCES categories(category_id)
);

-- Inserting Data into Employees

INSERT INTO employees (first_name, last_name, job_title)
VALUES 
	('Emily', 'Thompson', 'Software Engineer'),
	('Michael', 'Adams', 'Marketing Manager'),
    ('Olivia', 'Davis', 'Graphic Designer'),
    ('James', 'Wilson', 'Financial Analyst'),
    ('Sarah', 'Miller', 'HR Director'),
    ('David','Smith','Data Scientist'),
	('Sophia','Johnson','Sales Executive'),
    ('Ivan','Mitkovski','PHP Developer'),
    ('Daniel','Lee','Javascript Engineer'),
	('Alexander','Harris','Senior Architect')
;


-- Inserting Data into Categories

INSERT INTO categories (category_name)
VALUES
	('Makes Work Fun'),
    ('Team Player'),
    ('Culture Champion'),
    ('Difference Maker')
;
