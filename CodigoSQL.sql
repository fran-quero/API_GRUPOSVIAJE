CREATE SCHEMA flywith;
USE flywith;

-- Tabla administradores
CREATE TABLE Admins (
    name VARCHAR(50) PRIMARY KEY,
    password VARCHAR(255) NOT NULL
);

-- Tabla planes 
CREATE TABLE Plans (
    ID INT PRIMARY KEY,
    city VARCHAR(100),
    plan JSON  
);

-- Tabla grupos
CREATE TABLE Groups (
    ID INT PRIMARY KEY,
    start_day DATE,
    last_day DATE,
    id_plans INT NULL,
    FOREIGN KEY (id_plans) REFERENCES Plans(ID) 
);

-- Tabla usuarios 
CREATE TABLE Users (
    email VARCHAR(50) PRIMARY KEY,
    password VARCHAR(255) NOT NULL,
    number INT NOT NULL,
    id_group INT NULL,
    FOREIGN KEY (id_group) REFERENCES Groups(ID)  
);
