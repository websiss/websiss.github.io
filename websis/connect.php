<?php
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Database connection
$conn = new mysqli('localhost', 'root', '', 'registration');

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO registration (name, email, password, confirm) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $hashed_password, $confirm);
    $execval = $stmt->execute();

    if ($execval) {
        echo "Registration successful...";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
