CREATE DATABASE company;
USE company;
CREATE TABLE departments
(
    id      INT PRIMARY KEY AUTO_INCREMENT,
    dptname VARCHAR(45) UNIQUE NOT NULL
);
CREATE TABLE employees
(
    id            INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    firstname     VARCHAR(45)                    NOT NULL,
    lastname      VARCHAR(45)                    NOT NULL,
    sex           VARCHAR(45)                    NOT NULL,
    salary        DOUBLE                         NOT NULL,
    department_id INT
);

INSERT INTO employees(id, firstname, lastname, sex, salary, department_id)
VALUES (NULL, 'Young Ho', 'Lee', 'm', 6000.84, 1);
INSERT INTO employees(id, firstname, lastname, sex, salary, department_id)
VALUES (NULL, 'Jae Dong', 'Lee', 'm', 5000.75, 3);
INSERT INTO employees(id, firstname, lastname, sex, salary, department_id)
VALUES (NULL, 'Taek Yong', 'Kim', 'm', 4000.01, 2);
INSERT INTO employees(id, firstname, lastname, sex, salary, department_id)
VALUES (NULL, 'Ga Eul', 'Kim', 'w', 15000.99, 3);
INSERT INTO employees(id, firstname, lastname, sex, salary, department_id)
VALUES (NULL, 'Byung Goo', 'Song', 'm', 3000.52, 2);
INSERT INTO employees(id, firstname, lastname, sex, salary, department_id)
VALUES (NULL, 'Yoon Yeol', 'Lee', 'm', 5000.17, 1);


INSERT INTO departments
VALUES (NULL, 'Terran');
INSERT INTO departments
VALUES (NULL, 'Protoss');
INSERT INTO departments
VALUES (NULL, 'Zerg');
