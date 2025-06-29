<?php
$servername = getenv("DB_HOST");
$username = getenv("DB_USER");
$password = getenv("DB_PASSWORD");
$database = "login_app";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Secure the query with prepared statements
    $sql = "SELECT * FROM users WHERE username=? AND password=?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error in SQL query: " . $conn->error);
    }

    // Bind parameters and execute
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    
    // Get results
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo "Login successful";
    } else {
        echo "Invalid credentials";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
