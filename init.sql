CREATE TABLE users(
	id int AUTO_INCREMENT,
	username varchar(20) NOT NULL,
	password_hash varchar(60) NOT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE messages(
	id int AUTO_INCREMENT,
	user_id int,
	content TEXT,
	PRIMARY KEY(id)
);
