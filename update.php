<?php
try {
    $servername = "localhost:3306";
    $dbname = "sanjithr";
    $username = "sanjithr";
    $password = "2004";

    $conn = new PDO(
        "mysql:host=$servername;dbname=$dbname",
        $username,
        $password
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      $year = test_input($_POST["year"]);
    $month = test_input($_POST["month"]);
    $rent = (int)test_input($_POST["rent"]);
    $transport = (int)test_input($_POST["transport"]);
    $groceries = (int)test_input($_POST["groceries"]);
    $food = (int)test_input($_POST["food"]);
    $shopping = (int)test_input($_POST["shopping"]);
    $other = (int)test_input($_POST["other"]);
    
    // Fetch the current values from the database
    $stmt = $conn->prepare("SELECT budget, rent, transport, groceries, food, shopping, other, expenses FROM expense WHERE year = :year AND month = :month");
    $stmt->bindParam(':year', $year);
    $stmt->bindParam(':month', $month);
    $stmt->execute();
    $current = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($current) {
        // Add the new values to the current values
        $budget = $current['budget'];
        $new_rent = (int)$current['rent'] + $rent;
        $new_transport = (int)$current['transport'] + $transport;
        $new_groceries = (int)$current['groceries'] + $groceries;
        $new_food = (int)$current['food'] + $food;
        $new_shopping = (int)$current['shopping'] + $shopping;
        $new_other = (int)$current['other'] + $other;
        $expenses = (int)$current['expenses'];
        
        // Calculate the new expense and savings
        $new_expenses = $new_rent + $new_transport + $new_groceries + $new_food + $new_shopping + $new_other ;
        $new_savings = $budget - $new_expenses;
        
        // Update the record in the database
        $update_stmt = $conn->prepare("UPDATE expense SET rent = :rent, transport = :transport, groceries = :groceries, food = :food, shopping = :shopping, other = :other, expenses = :expenses, savings = :savings WHERE year = :year AND month = :month");
        $update_stmt->bindParam(':rent', $new_rent);
        $update_stmt->bindParam(':transport', $new_transport);
        $update_stmt->bindParam(':groceries', $new_groceries);
        $update_stmt->bindParam(':food', $new_food);
        $update_stmt->bindParam(':shopping', $new_shopping);
        $update_stmt->bindParam(':other', $new_other);
        $update_stmt->bindParam(':expenses', $new_expenses);
        $update_stmt->bindParam(':savings', $new_savings);
        $update_stmt->bindParam(':year', $year);
        $update_stmt->bindParam(':month', $month);
        
        // Redirect to the desired page after successful update
        if ($update_stmt->execute()) {
          echo "<script type='text/javascript'>alert('EXPENSES UPDATED'); window.location.href = 'update.html';</script>";
        } else {
          echo "<script type='text/javascript'>alert('Error updating record'); window.location.href = 'update.html';</script>";
        }
        exit;
    }
    }


} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
