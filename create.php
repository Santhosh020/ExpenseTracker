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
        $budget = test_input($_POST["budget"]);
        $rent = test_input($_POST["rent"]);
        $transport = test_input($_POST["transport"]);
        $groceries = test_input($_POST["groceries"]);
        $food = test_input($_POST["food"]);
        $shopping = test_input($_POST["shopping"]);
        $other = test_input($_POST["other"]);
        
        // Calculate expense
        $expenses = $rent + $transport + $groceries + $food + $shopping + $other;
        
        // Calculate savings
        $savings = $budget - $expenses;
        
        // Insert data into the database
        $stmt = $conn->prepare("INSERT INTO expense (year, month, budget, rent, transport, groceries, food, shopping, other, expenses, savings) 
                                VALUES (:year, :month, :budget, :rent, :transport, :groceries, :food, :shopping, :other, :expenses, :savings)");
        
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':month', $month);
        $stmt->bindParam(':budget', $budget);
        $stmt->bindParam(':rent', $rent);
        $stmt->bindParam(':transport', $transport);
        $stmt->bindParam(':groceries', $groceries);
        $stmt->bindParam(':food', $food);
        $stmt->bindParam(':shopping', $shopping);
        $stmt->bindParam(':other', $other);
        $stmt->bindParam(':expenses', $expenses);
        $stmt->bindParam(':savings', $savings);
        
        
        // Redirect to the desired page after successful insertion
        if ($stmt->execute()) {
            echo "<script type='text/javascript'>alert('EXPENSES INSERTED'); window.location.href = 'create.html';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Error inserting record'); window.location.href = 'create.html';</script>";
        }
        exit;
    }


} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
