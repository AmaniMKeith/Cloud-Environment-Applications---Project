-- db/init.sql
CREATE DATABASE budget_tracker;
USE budget_tracker;

CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(255),
    amount DECIMAL(10,2),
    type VARCHAR(10),
    date DATE
);
