CREATE DATABASE movie_reviews;

use movie_reviews;

CREATE TABLE Users
(
	ID int NOT NULL AUTO_INCREMENT,
	Username varchar(255),
	 Movie varchar(255),
	 Rating int(3),
	 City varchar(255),
	 PRIMARY KEY (ID)
 );

 CREATE TABLE MovieData (
	 ID int NOT NULL AUTO_INCREMENT,
	 Release_Date int(5),
	 Movie_Title varchar(255),
	 Genre varchar(255),
	 Avg_Rating decimal(4,2),
	 PRIMARY KEY (ID)
 );
