📊 Expense Calculator Web Application

A simple and clean Expense Tracking System built using PHP, HTML, CSS, and MySQL (XAMPP).
This web application allows users to sign up, log in, add expenses, update expenses, delete entries, and visualize monthly savings.

🚀 Features
🧑‍💻 User Module

User Sign Up

User Login / Authentication

Secure form input validation

Redirect to main dashboard after login

💰 Expense Management

Add monthly expenses

Update existing expense records

Delete expense records

Display expense summary

Auto-calculations:

Total Expenses

Monthly Budget

Savings (Budget – Expenses)

📅 Dashboard

Shows:

Current month expenses

Previous month expenses

Budget overview

Savings comparison

🛠️ Tech Stack
Component	Technology
Frontend	HTML, CSS, Google Fonts
Backend	PHP (PDO & MySQLi)
Database	MariaDB / MySQL (XAMPP)
Server	Apache (XAMPP)
Version Control	Git + GitHub
📁 Project Structure
Expense-Calculator/
│
├── create.html
├── create.php
├── update.html
├── update.php
├── delete.php
├── display.php
├── validate.php      # Login validation
├── signup.html
├── signup.php        # User registration
├── mainpage.php      # Dashboard
│
├── general.css
├── create.css
├── display.css
├── update.css
├── style.css         # Login/Signup styles
├── mainpage.css
│
├── 4049458.jpg       # Background images
├── bg4.jpg
│
└── README.md

🗄️ Database Setup (MySQL)
1️⃣ Create Database
CREATE DATABASE expense_db;

2️⃣ Create users table
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  username VARCHAR(100),
  email VARCHAR(100),
  password VARCHAR(255)
);

3️⃣ Create expense table
CREATE TABLE expense (
  id INT AUTO_INCREMENT PRIMARY KEY,
  year INT,
  month VARCHAR(20),
  budget INT,
  rent INT,
  transport INT,
  groceries INT,
  food INT,
  shopping INT,
  other INT,
  expenses INT,
  savings INT
);

4️⃣ Create application user (recommended)
CREATE USER 'expense_user'@'localhost' IDENTIFIED BY 'ExpensePass123!';
GRANT ALL PRIVILEGES ON expense_db.* TO 'expense_user'@'localhost';
FLUSH PRIVILEGES;

▶️ Running the App Locally
Requirements:

XAMPP installed

Apache & MySQL running

Steps:

Place the project folder inside:

C:/xampp/htdocs/


Start:

Apache

MySQL
from XAMPP Control Panel

Visit in browser:

http://localhost/Expense-Calculator/


Signup → Login → Start tracking expenses

📌 Git Commands to Upload
git init
git add .
git commit -m "Initial commit"
git branch -M main
git remote set-url origin https://github.com/Santhosh020/ExpenseTracker.git
git push -u origin main

🧑‍💻 Author

Santhosh S
Final Year CSE Student – Sona College of Technology
Building practical projects to strengthen web development skills.

⭐ Show Your Support

If you like this project, give it a ⭐ star on GitHub!
