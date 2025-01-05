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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup/Signin Page</title>
    <link rel="stylesheet" href="/Yt_Playlist/CSS/signup_in.css">
    <link rel="icon" type="image/x-icon" href="/Yt_Playlist/Docs/favicon.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="form-box signin-box centered">
                <h2>Sign In</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <input type="email" name="email" placeholder="Email" required>
                    <input id="password" type="password" name="password" placeholder="Password" required >
                    <!-- An element to toggle between password visibility -->
                    <div class="row">
                        <input class="check text-left col" type="checkbox" onclick="myFunction()" id="showPasswordCheckbox">
                        <label class="col" for="showPasswordCheckbox">Show Password</label>
                    </div>
                    <button type="submit">Sign In</button>
                </form>
                <p>Don't have an account? <span class="toggle" onclick="toggleForms()">Sign Up</span></p>
            </div>
            <div class="form-box signup-box hidden centered">
                <h2>Sign Up</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <input type="text" name="fname" placeholder="First Name" required>
                    <input type="text" name="lname" placeholder="Last Name" required>
                    <input type="email" name="nemail" placeholder="Email" required>
                    <input id="passwords" type="password" name="npassword" placeholder="Password" required>
                    <!-- An element to toggle between password visibility -->
                    <input class="check" type="checkbox" onclick="myFunction2()" id="showPasswordCheckbox" name="showPasswordCheckbox">
                    <label for="showPasswordCheckbox">Show Password</label>
                    <p><input id="Terms" type="checkbox" name="Terms">By this, You're agreeing to <a href="Terms.html">Terms and Conditions</a></p>
                    <button id="signUpButton" type="submit" disabled>Sign Up</button>
                </form>
                <p>Already have an account? <span class="toggle" onclick="toggleForms()">Sign In</span></p>
            </div>
        </div>
        <div class="image-container">
            <img src="/Yt_Playlist/Docs/signup_in.jpg" alt="Image">
        </div>
    </div>
    <script src="/Yt_Playlist/js/signup_in.js"></script>
    <!-- Display pop-up for message -->
    <script>
        <?php if (!empty($signup_message)): ?>
            alert("<?php echo $signup_message; ?>");
        <?php endif; ?>
        <?php if (!empty($login_message)): ?>
            alert("<?php echo $login_message; ?>");
        <?php endif; ?>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
            x.type = "text";
            } else {
            x.type = "password";
            }
        }
        const termsCheckbox = document.getElementById("Terms");
        const signUpButton = document.getElementById("signUpButton");

        termsCheckbox.addEventListener("change", () => {
            signUpButton.disabled = !termsCheckbox.checked; // Show/Hide button based on checkbox
        });
        function myFunction2() {
            var x = document.getElementById("passwords");
            if (x.type === "password") {
            x.type = "text";
            } else {
            x.type = "password";
            }
        }
    </script>
</body>
</html>
