CREATE TABLE ProjectDetail (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(45) NOT NULL
);

INSERT INTO ProjectDetail (name) VALUES ('Nette dockerization template by Patrik Duch');

CREATE TABLE User (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(100) NOT NULL,
  password VARCHAR(250) NOT NULL,
  role VARCHAR(150) NOT NULL
);



