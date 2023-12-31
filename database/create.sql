CREATE DATABASE IF NOT EXISTS company;

USE company;

DROP TABLE IF EXISTS employees;
DROP TABLE IF EXISTS departaments;
DROP TABLE IF EXISTS companies;

CREATE TABLE companies (
    id BIGINT  NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    cnpj VARCHAR(14) NOT NULL
);

CREATE TABLE departaments (
    id BIGINT  NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    company_id BIGINT  NOT NULL,
    FOREIGN KEY (company_id) REFERENCES companies(id) ON DELETE CASCADE
);

CREATE TABLE employees (
    id BIGINT  NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    cpf VARCHAR(11) NOT NULL,
    salary DECIMAL(10,2) NOT NULL,
    departament_id BIGINT  NOT NULL,
    FOREIGN KEY (departament_id) REFERENCES departaments(id) ON DELETE CASCADE
);