<?php

// Start session
session_start();

// Database connection
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = '';     // Replace with your database password
$dbname = "yt_playlist"; // Replace with your database name

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$signup_message = ""; // To store success or error message
$login_message = "";  // To store login message

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        // Sign in functionality
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check if the user exists
        $check_query = "SELECT * FROM user WHERE Email = ?";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if ($result->num_rows > 0) {
            // User exists, check password
            $user = $result->fetch_assoc();
            // if (password_verify($password, $user['Pass'])) {
            if ($user['Names'] === $password) {
                // Password is correct, log the user in (set session)
                session_start();
                $_SESSION['user_id'] = $user['Uid']; // Assuming UserID is a field in the database
                $_SESSION['user_email'] = $user['Email'];
                $login_message = "Login successful! Welcome, " . $user['Fname'] . " " . $user['Lname'];
                $_SESSION['login_message'] = $login_message;
                header("Location: dashboard.php"); // Redirect to the dashboard or home page
                exit();
            } else {
                $login_message = "Error: Incorrect password.";
            }
        } else {
            $login_message = "Error: No user found with that email.";
        }
        $check_stmt->close();
    } else {
        // Sign up functionality
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['nemail'];
        $password = $_POST['npassword'];
        $Names = $password;
        $subscription = 0; // Checkbox for subscription

        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Check for duplicate email
        $check_query = "SELECT * FROM user WHERE Email = ?";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if ($result->num_rows > 0) {
            // Email already exists
            $signup_message = "Error: Email already registered!";
        } else {
            // Insert the user into the database
            $sql = "INSERT INTO user(Fname, Lname, Email, Pass, Sub, Names) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssis", $fname, $lname, $email, $hashed_password, $subscription, $Names);

            if ($stmt->execute()) {
                $signup_message = "Signup successful!";
            } else {
                $signup_message = "Error: " . $stmt->error;
            }
            $stmt->close();
        }

        $check_stmt->close();
    }
}

$conn->close();
?>
