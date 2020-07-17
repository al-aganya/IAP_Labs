-- Database name=ics102728

CREATE TABLE user(
id int AUTO_INCREMENT PRIMARY KEY,
first_name varchar(32) NOT NULL,
last_name varchar(32),
user_city varchar(32),
username varchar(20),
password varchar(255) );
