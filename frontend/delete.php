<?php
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
  $year  = test_input($_POST["year"]);
  $month = test_input($_POST["month"]);

  $stmt = $conn->prepare("DELETE FROM expense WHERE year = :year AND month = :month");
  $ok = $stmt->execute([':year'=>$year, ':month'=>$month]);

  if ($ok) {
    echo "<script>alert('RECORD DELETED!');location.href='delete.php';</script>";
  } else {
    echo "<script>alert('Error deleting record');location.href='delete.php';</script>";
  }
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create Page</title>
  <link rel="stylesheet" href="general.css" />
  <link rel="stylesheet" href="create.css" />
  <link rel="stylesheet" href="display.css" />
</head>
<body>
  <div class="header">
    <a href="mainpage.php"><button class="headerbutton"> &#8592  Home Page</button></a>
  </div>
  <form action="delete.php" method="post">
    <div class="wrapper">
      <div class="login">
        <div class="some">
          <input type="text" placeholder="Year" name="year">
          <input type="text" placeholder="Month" name="month">
        </div>
        <button class="cta" type="submit" name="login">
          <span class="hover-underline-animation"> SUBMIT </span>
          <svg id="arrow-horizontal" xmlns="http://www.w3.org/2000/svg" width="30" height="10" viewBox="0 0 46 16">
            <path id="Path_10" d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z" transform="translate(30)"></path>
          </svg>
        </button>
      </div>
    </div>
  </form>
</body>
</html>
