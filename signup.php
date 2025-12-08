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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = test_input($_POST["id"]);
        $name = test_input($_POST["name"]);
        $username = test_input($_POST["username"]);
        $email = test_input($_POST["email"]);
        $password = test_input($_POST["password"]);

        // Insert user data into the database
        $stmt = $conn->prepare("INSERT INTO users (id, name, username, email, password) VALUES (:id, :name, :username, :email, :password)");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);

        $stmt->execute();

        // Redirect to the login page or any other relevant page
        header("location: index.html");
        exit; // Important: stop further execution
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
