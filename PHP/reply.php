<?php
// reply.php
session_start(); // Start the session

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "yt_playlist";

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /Yt_Playlist/Html/signup_in.php");
    exit();
}

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['form_type'])) {
    $formType = $_POST['form_type'];
    $uid = $_SESSION['user_id'];
    $name = mysqli_real_escape_string($conn, $_POST["{$formType}-name"]);
    $email = mysqli_real_escape_string($conn, $_POST["{$formType}-email"]);
    $message = mysqli_real_escape_string($conn, $_POST["{$formType}-message"]);
    $table = $formType === 'contact' ? 'contact' : 'feedback';
    $columnPrefix = $formType === 'contact' ? 'c' : 'f';

    $sql = "INSERT INTO $table (name{$columnPrefix}, email{$columnPrefix}, msg{$columnPrefix}, uid) 
            VALUES ('$name', '$email', '$message', '$uid')";
    $result = $conn->query("SELECT Fname FROM user WHERE uid = '$uid'");
    $result2 = $conn->query("SELECT Lname FROM user WHERE uid = '$uid'");

    if ($conn->query($sql) === TRUE) {
        $_SESSION['form_message'] = ucfirst($formType) . " form submitted successfully!";
        $fname = $result->fetch_assoc()['Fname'];
        $lname = $result2->fetch_assoc()['Lname'];
        $login_message = "Welcome, " . $fname . " " . $lname;
        $_SESSION['login_message'] = $login_message;
    } else {
        $_SESSION['form_message'] = "Error submitting " . ucfirst($formType) . " form: " . $conn->error;
    }
}

$conn->close();
header("Location: /Yt_Playlist/Html/dashboard.php");
exit;

?>
