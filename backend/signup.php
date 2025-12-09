<?php
try {
    $servername = "127.0.0.1";
    $username   = "expense_user";
    $password   = "ExpensePass123!";
    $dbname     = "expense_db";

    $conn = new PDO(
      "mysql:host=$servername;port=3307;dbname=$dbname;charset=utf8mb4",
      $username,
      $password
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    function test_input($d){ return htmlspecialchars(stripslashes(trim($d))); }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name     = test_input($_POST["name"]);
        $uname    = test_input($_POST["username"]);
        $email    = test_input($_POST["email"]);
        $pass     = test_input($_POST["password"]);

        $stmt = $conn->prepare("INSERT INTO users (name, username, email, password)
                                VALUES (:name, :username, :email, :password)");
        $stmt->execute([
          ':name'=>$name, ':username'=>$uname, ':email'=>$email, ':password'=>$pass
        ]);

        header("Location: index.html");
        exit;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
