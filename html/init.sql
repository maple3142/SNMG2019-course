CREATE DATABASE test CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE test;
CREATE TABLE users(
	id int AUTO_INCREMENT,
	username varchar(20) NOT NULL,
	password_hash varchar(60) NOT NULL,
	PRIMARY KEY(id)
);
INSERT INTO users(username, password_hash) VALUES("test", "$2y$10$/NF0gQKgkcLsK0.Kb29PjuuPucYwOr9yS.l3iJNJ8y1HggXp9Yn7S");
CREATE TABLE messages(
	id int AUTO_INCREMENT,
	user_id int,
	content TEXT,
	PRIMARY KEY(id)
);
