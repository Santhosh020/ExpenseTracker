<?php
 
 $conn = "";
  
 try {
    $servername = "127.0.0.1";
$username = "expense_user";
$password = "ExpensePass123!";
$dbname = "expense_db";

$conn = new PDO("mysql:host=$servername;port=3307;dbname=$dbname;charset=utf8mb4",
                $username,
                $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 }
 catch(PDOException $e) {
     echo "Connection failed: " . $e->getMessage();
 }
  
 
 function test_input($data) {
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
 }
 
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $username = test_input($_POST["username"]);
     $password = test_input($_POST["password"]);
 
     // Query the database for the provided username and password
     $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
     $stmt->bindParam(':username', $username);
     $stmt->bindParam(':password', $password);
     $stmt->execute();
     $user = $stmt->fetch();
 
     if ($user) {
        // Valid user credentials, redirect to the main page
        header("Location: mainpage.php");
        exit; // Important: stop further execution
    } else {
        // Invalid credentials, show an error message
        echo "<script language='javascript'>";
        echo "alert('INCORRECT USERNAME OR PASSWORD');";
        echo "window.location.href = 'index.html';";
        echo "</script>";
        exit; // Important: stop further execution
    }
 }
 ?>