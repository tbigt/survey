## A Generic PHP Survey

#### MySQL Query to Create Database & Table
* run first time only:
```mysql
CREATE DATABASE survey;
USE survey;

# create example questions table
CREATE TABLE IF NOT EXISTS example_questions (
  id int(11) NOT NULL AUTO_INCREMENT,
  question_text varchar(200) NOT NULL,
  question_type int(2) DEFAULT 0,
  required tinyint(1) DEFAULT 0,
  helper_text varchar(200) DEFAULT NULL,
  created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(id)
);

# create example options table
CREATE TABLE IF NOT EXISTS example_options (
  id int(11) NOT NULL AUTO_INCREMENT,
  question_id int(11) NOT NULL DEFAULT 0,
  option_text varchar(200) NOT NULL,
  created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(id)
);

# create example users table
CREATE TABLE IF NOT EXISTS example_users (
  id int(11) NOT NULL AUTO_INCREMENT,
  email varchar(200) NOT NULL,
  created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(id)
);

# create example responses table
CREATE TABLE IF NOT EXISTS example_responses (
  id int(11) NOT NULL AUTO_INCREMENT,
  user_id int(11) NOT NULL,
  question_id int(11) NOT NULL,
  option_id int(11) NOT NULL DEFAULT 0,
  text varchar(1000) DEFAULT NULL,
  created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(id)
);
```
* create survey tables (change the table prefix for a new survey):
```mysql
USE survey;
SET @PREFIX = "s1"; # change prefix for each new survey

SET @Q_QUERY = CONCAT('CREATE TABLE IF NOT EXISTS ', @PREFIX, '_questions LIKE example_questions');
SET @O_QUERY = CONCAT('CREATE TABLE IF NOT EXISTS ', @PREFIX, '_options LIKE example_options');
SET @R_QUERY = CONCAT('CREATE TABLE IF NOT EXISTS ', @PREFIX, '_responses LIKE example_responses');
SET @U_QUERY = CONCAT('CREATE TABLE IF NOT EXISTS ', @PREFIX, '_users LIKE example_users');

PREPARE stmt FROM @Q_QUERY;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
PREPARE stmt FROM @O_QUERY;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
PREPARE stmt FROM @R_QUERY;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
PREPARE stmt FROM @U_QUERY;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
```
* test questions
```
# multiple radio fields (question_type = 0)
INSERT INTO survey.s1_questions 
(question_text, question_type, required, helper_text)
VALUES
("What is your favorite choice?", 0, 1, "Some Helper Text");

# options for radio fields
INSERT INTO survey.s1_options 
(question_id, option_text)
VALUES
(5, "That"); # change 5 to corresponding radio field id
INSERT INTO survey.s1_options 
(question_id, option_text)
VALUES
(5, "This"); # change 5 to corresponding radio field id

# input fields (question_type = 1)
INSERT INTO survey.s1_questions 
(question_text, question_type, required, helper_text)
VALUES
("Input Question 1", 1, 1, "");
INSERT INTO survey.s1_questions 
(question_text, question_type, required, helper_text)
VALUES
("Input Question 2", 1, 0, "");

# text fields (question_type = 2)
INSERT INTO survey.s1_questions 
(question_text, question_type, required, helper_text)
VALUES
("Text Field 1", 2, 1, "");
INSERT INTO survey.s1_questions 
(question_text, question_type, required, helper_text)
VALUES
("Text Field 2", 2, 1, "");
```
