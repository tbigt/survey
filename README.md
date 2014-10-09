## A Generic PHP Survey

#### MySQL Query to Create Database & Table
* run first time only:
```mysql
CREATE DATABASE survey;
USE survey;
```
* create tables (change the table prefix for a new survey)
```mysql
SET @PREFIX = "s1"; # change prefix

SET @QUERY = CONCAT('
CREATE TABLE IF NOT EXISTS ', @PREFIX, '_questions (
  id int(11) NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(id)
)');

PREPARE stmt FROM @QUERY;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
```
