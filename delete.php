<?php
// Database connection parameters
$servername = "localhost:3306";
$username = "sanjithr";
$password = "2004";
$dbname = "sanjithr";

// Create connection
$conn = new PDO(
  "mysql:host=$servername;dbname=$dbname",
  $username,
  $password
);

// Check connection
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

// Fetch the current values from the database
$stmt = $conn->prepare("DELETE FROM expense WHERE year = :year AND month = :month");
$stmt->bindParam(':year', $year);
$stmt->bindParam(':month', $month);
$stmt->execute();

if ($stmt->execute()) {
  echo "<script type='text/javascript'>alert('RECORD DELETED!'); window.location.href = 'delete.php';</script>";
} else {
  echo "<script type='text/javascript'>alert('Error deleting record'); window.location.href = 'delete.php';</script>";
}
exit;

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Page</title>
    <link rel="stylesheet" href="general.css">
    <link rel="stylesheet" href="create.css">
    <link rel="stylesheet" href="display.css">
</head>
<body>
    <div class="header">
        <a href="mainpage.php">
            <button class="headerbutton"> &#8592  Home Page</button>
        </a>
    </div>
    <form action="delete.php" method="post">
    <div class="wrapper">
    <div class="login">
        <div class="some">
          <input type="text" placeholder="Year" name="year" >
          <input type="text" placeholder="Month" name="month" >
        </div>

        <button class="cta" type="submit" name="login">
            <span class="hover-underline-animation"> SUBMIT </span>
            <svg
              id="arrow-horizontal"
              xmlns="http://www.w3.org/2000/svg"
              width="30"
              height="10"
              viewBox="0 0 46 16"
            >
              <path
                id="Path_10"
                data-name="Path 10"
                d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z"
                transform="translate(30)"
              ></path>
            </svg>
          </button>
      
    </div>
    </form>
</body>
</html>