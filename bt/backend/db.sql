CREATE DATABASE budget_tracker;
USE budget_tracker;

CREATE TABLE transactions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  type VARCHAR(255), 
  description VARCHAR(255),
  amount DECIMAL(10,2)
);