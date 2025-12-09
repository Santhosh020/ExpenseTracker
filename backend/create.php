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

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $year      = test_input($_POST["year"]);
        $month     = test_input($_POST["month"]);
        $budget    = (float)($_POST["budget"] ?? 0);
        $rent      = (float)($_POST["rent"] ?? 0);
        $transport = (float)($_POST["transport"] ?? 0);
        $groceries = (float)($_POST["groceries"] ?? 0);
        $food      = (float)($_POST["food"] ?? 0);
        $shopping  = (float)($_POST["shopping"] ?? 0);
        $other     = (float)($_POST["other"] ?? 0);

        $expenses = $rent + $transport + $groceries + $food + $shopping + $other;
        $savings  = $budget - $expenses;

        $stmt = $conn->prepare("INSERT INTO expense
          (year, month, budget, rent, transport, groceries, food, shopping, other, expenses, savings)
          VALUES (:year, :month, :budget, :rent, :transport, :groceries, :food, :shopping, :other, :expenses, :savings)");

        $stmt->execute([
          ':year'=>$year, ':month'=>$month, ':budget'=>$budget, ':rent'=>$rent,
          ':transport'=>$transport, ':groceries'=>$groceries, ':food'=>$food,
          ':shopping'=>$shopping, ':other'=>$other, ':expenses'=>$expenses, ':savings'=>$savings
        ]);

        echo "<script>alert('EXPENSES INSERTED');location.href='create.html';</script>";
        exit;
    }
} catch (PDOException $e) { echo "Error: ".$e->getMessage(); }
