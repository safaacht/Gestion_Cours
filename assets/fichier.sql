//tableau Courses
CREATE TABLE Courses( id int PRIMARY KEY AUTO_INCREMENT, title varchar(50), description text, level varchar(30), created_at datetime );
INSERT INTO courses (title, description,level,created_at) VALUES ('title1','Lorem Lorem','Débutant','2025-12-01 11:42:03'),('title2','Lorem Lorem','Intermédiaire','2025-12-01 11:45:03');

// tableau sections
CREATE TABLE sections( id int PRIMARY KEY AUTO_INCREMENT, courses_id int NOT null, FOREIGN key(courses_id) REFERENCES courses(id), title varchar(30), content text );

ALTER TABLE sections ADD position int, ADD created_at datetime;

INSERT INTO sections(courses_id,title,content,position,created_at) VALUES(2,'title1','LOREM LOREM LOREM',1,'2025-12-01 12:21:55'), (1,'title1','LOREM LOREM LOREM',1,'2025-12-01 12:21:55');

UPDATE sections SET title='title2', created_at="2025-12-01 12:28:55" WHERE id=2;

SELECT * FROM `sections`;

SELECT title FROM `sections` WHERE title='title1';

SELECT title FROM `sections` ORDER BY id;



INSERT INTO courses(title, description,level,created_at) VALUES('title3','Lorem Lorem','Intermédiaire','2025-12-01 13:26:28');



SELECT COUNT(id),level FROM courses GROUP BY level ORDER BY COUNT(id) DESC;


SELECT COUNT(id) AS NBR ,level FROM courses GROUP BY level ORDER BY COUNT(id) ASC;

SELECT * FROM `courses` WHERE description='Lorem Lorem' AND level='Intermédiaire';


SELECT * FROM courses WHERE level in ('Intermédiaire','Débutant');

SELECT * FROM courses WHERE id BETWEEN 2 AND 3;

SELECT * FROM courses WHERE id NOT BETWEEN 2 AND 3;

SELECT * FROM courses WHERE level like '%e';

//Part2//


CREATE TABLE users(
id int PRIMARY KEY AUTO_INCREMENT,
    email varchar(50) NOT null UNIQUE,
    password varchar(50) NOT null
)

INSERT INTO `users`( `email`, `password`) VALUES ('safaachtaoui@gmail.com','safaa123'),('user@example.com','loremlorem');

SELECT * FROM `users` WHERE email='safaachtaoui@gmail.com';

ALTER TABLE users ADD user_name varchar(50) UNIQUE;
INSERT INTO users(email,password,user_name) VALUES('safaacht@gmail.com','laaa','safaa chtaoui');

CREATE TABLE enrollement(
    id_user int,
    FOREIGN KEY (id_user) REFERENCES users (id) 
    ON DELETE CASCADE,
    id_course int,
    FOREIGN KEY (id_course) REFERENCES courses (id) 
    ON DELETE CASCADE,
    PRIMARY KEY (id_user,id_course)
)