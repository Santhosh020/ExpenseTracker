<?php
// ----- DB connection (XAMPP MySQL on port 3307) -----
$servername = "127.0.0.1";
$username   = "expense_user";      // phpMyAdmin → User accounts
$password   = "ExpensePass123!";   // the password you created
$dbname     = "expense_db";
$port       = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset('utf8mb4');

// ----- Fetch latest two months (proper month ordering) -----
// Assumes `month` column stores full month names like 'March', 'April', etc.
$sql = "
  SELECT year, month, budget, expenses, savings
  FROM expense
  ORDER BY STR_TO_DATE(CONCAT(month,' 1 ', year), '%M %e %Y') DESC
  LIMIT 2
";
$result = $conn->query($sql);

$currentMonth = [];
$lastMonth    = [];

if ($result && $result->num_rows > 0) {
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $currentMonth = $rows[0];
    if (count($rows) > 1) {
        $lastMonth = $rows[1];
    }
} else {
    // no rows — keep arrays empty so the page shows the fallback text
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
