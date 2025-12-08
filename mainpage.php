<?php
// Database connection parameters
$servername = "localhost:3306";
$username = "sanjithr";
$password = "2004";
$dbname = "sanjithr";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get data for the last two months
$sql = "SELECT month, budget, expenses, savings 
        FROM expense 
        ORDER BY 
          year DESC,
          CASE 
            WHEN month = 'June' THEN 1
            WHEN month = 'May' THEN 2
            WHEN month = 'April' THEN 3
            WHEN month = 'March' THEN 4
            ELSE 5  -- Handle other months if they exist
          END
        LIMIT 2";
$result = $conn->query($sql);
// Initialize variables for current and last month data
$currentMonth = [];
$lastMonth = [];

if ($result->num_rows > 0) {
    // Fetch the data
    $currentMonth = $result->fetch_assoc();
    if ($result->num_rows > 1) {
        $lastMonth = $result->fetch_assoc();
    }
} else {
    echo ("No data found");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="mainpage.css">
    <link rel="stylesheet" href="general.css">
</head>
<body>
    <div class="page1">
      <div class="header">
        <a href="create.html">
            <button class="headerbutton">Insert</button>
        </a>
        <a href="update.html">
            <button class="headerbutton">Update</button>
        </a>
        <a href="display.php">
            <button class="headerbutton">Display</button>
        </a>
        <a href="delete.php">
            <button class="headerbutton">Delete</button>
        </a>
        <a href="delete.php">
            <button class="headerbutton">About Us</button>
        </a>
    
        <a href="index.html">
            <button class="headerbutton"> &#8592 Sign Out</button>
        </a>
        
      </div>

      <h1>HOME PAGE</h1>

        <div class="wrapper">
            <div class="current">
                    <?php if (!empty($currentMonth)): ?>
                    <p><span class="bld">Month: </span> <?php echo htmlspecialchars($currentMonth['month']); ?></p>
                    <p><span class="bld">Budget: </span> <?php echo htmlspecialchars($currentMonth['budget']); ?>&#8377;</p>
                    <p><span class="bld">Expense: </span> <?php echo htmlspecialchars($currentMonth['expenses']); ?>&#8377;</p>
                    <p><span class="bld">Savings: </span> <?php echo htmlspecialchars($currentMonth['savings']); ?>&#8377;</p>
                <?php else: ?>
                    <p class="err">No data available for the current month.</p>
                <?php endif; ?>
            </div>
            <div class="last">
                <?php if (!empty($lastMonth)): ?>
                    <p><span class="bld">Month: </span><?php echo htmlspecialchars($lastMonth['month']); ?></p>
                    <p><span class="bld">Budget: </span><?php echo htmlspecialchars($lastMonth['budget']); ?>&#8377;</p>
                    <p><span class="bld">Expense: </span><?php echo htmlspecialchars($lastMonth['expenses']); ?>&#8377;</p>
                    <p><span class="bld">Savings: </span><?php echo htmlspecialchars($lastMonth['savings']); ?>&#8377;</p>
                <?php else: ?>
                    <p class="err">No data available for the last month.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="about">
        <h2>ABOUT US</h2>
    </div>
</body>
</html>