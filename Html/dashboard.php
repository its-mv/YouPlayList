<?php
    session_start(); // Start the session

    // Database configuration
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "yt_playlist";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: /Yt_Playlist/Html/signup_in.php");
        exit();
    }

    $uid = $_SESSION['user_id'];
    $email = $_SESSION['user_email'];
    $subq = $conn->query("SELECT sub FROM user WHERE uid = '$uid'");
    $sub = $subq;


    $result = $conn->query("SELECT Fname FROM user WHERE uid = '$uid'");
    $result2 = $conn->query("SELECT Lname FROM user WHERE uid = '$uid'");

    // Check if a login message exists in the session
    if (isset($_SESSION['login_message'])) {
        $message = $_SESSION['login_message'];
        unset($_SESSION['login_message']); // Remove the message after displaying it
    } else {
        $fname = $result->fetch_assoc()['Fname'];
        $lname = $result2->fetch_assoc()['Lname'];
        $message = "Welcome, " . $fname . " " . $lname;
    }

    // Check if user is subscribed or not if sub is 1 then willshow some msg
    if ($sub->fetch_assoc()['sub'] == 1) {
        $time_period = $conn->query("SELECT Duration FROM subscription WHERE uid = '$uid'");
        $sub_msg = "You have subscribed to our service for " . $time_period->fetch_assoc()['Duration'] . " Months.<h6>(From the date of purchase)</h6>";
    } else {
        $sub_msg = "\nYou have not subscribed to our service.";
    }

    // Check if there is a feedback/contact form submission message
    $form_message = '';
    if (isset($_SESSION['form_message'])) {
        $form_message = $_SESSION['form_message'];
        unset($_SESSION['form_message']); // Remove the message after displaying it
    }
    $sqlf = "SELECT namef, msgf FROM feedback ORDER BY time DESC LIMIT 6"; // Fetch latest 6 reviews
    $resultf = $conn->query($sqlf);

    $reviews = "";
    while ($row = $resultf->fetch_assoc()) {
        $reviews .= '<div class="testimonial-card hidden">
                        <p class="user-r">"' . $row['msgf'] . '"</p>
                        <h4 class="user-n">- ' . htmlspecialchars($row['namef']) . '</h4>
                    </div>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/Yt_Playlist/CSS/dashboard.css">   
    <link rel="icon" type="image/x-icon" href="/Yt_Playlist/Docs/favicon.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    <style>
        /* Ensure the body takes full height */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        /* Header container */
        .header {
            background-color: #dacacd;
            border-bottom: 2px solid #ccc;
            padding: 10px 20px 0px 20px;
            font-family: Arial, sans-serif;
            width : 100%;
            justify-content: space-around;
        }
        /* Navigation bar links */
        .nav-bar {
            display: flex;
            gap: 20px;
        }
        .nav-bar a {
            text-decoration: none;
            color: #333;
            font-size: 18px;
            padding: 8px 12px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .nav-bar a:hover {
            background-color: #ddcdcf;
            border-top : 1px;
            border-right : 1px;
            border-left : 1px;
            border-color: #000;
            transform : scale(1.1);
        }
        .slogan:hover {
            transform : scale(1.9);
            transition : 0.5s;
            color : #099;
        }
        .nav-bar a:active {
            background-color: #bbb;
            color: #fff;
        }
        .logo-l {
            width: 100px;
            height : auto;
        }
        /* Section Styling */
        #contact-section {
            text-align: center;
            background-color: #ffffff;
            padding: 20px;
            font-family: Arial, sans-serif;
        }
        .contact-options button,
        .contact-options .email-link {
            background-color: #ffffff   ;
            color: Black;
            border: none;;
            border-radius: 5px;
            padding: 10px 15px;
            margin: 10px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }
        .contact-options button:hover,
        .contact-options .email-link:hover {
            /* color : blue; */
            text-decoration: underline;
            background-color: #f0f0f0;  
        }
        /* Popup Styling */
        .popup {
            display: none; /* Hidden by default */
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            border-radius: 8px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            padding: 20px;
            width: 80%;
            max-width: 400px;
        }
        .popup-content {
            position: relative;
        }
        .popup-content h3 {
            margin-top: 0;
            color: #333;
        }
        .popup-content form label {
            display: block;
            margin: 10px 0 5px;
            color: #333;
        }
        .popup-content form input,
        .popup-content form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        } 
        .popup-content form button {
            margin-top: 10px;
            background-color: #6c757d;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
        }
        .popup-content form button:hover {
            background-color: #5a6268;
        }
        /* Close Button */
        .close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 18px;
            cursor: pointer;
            color: #555;
        }
        /* Notification Popup */
        #notificationPopup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            padding: 20px;
            text-align: center;
        }
        #notificationPopup h4 {
            margin: 0 0 10px;
        }
        #notificationPopup button {
            background-color: #6c757d;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
        }
        #notificationPopup button:hover {
            background-color: #5a6268;
        }
        footer {
            position : relative;
            background-color: #333;
            color : white;
            margin-bottom : 0px;
            padding-bottom: 10px;
            width: 100%;
        }
        /* FAQ Styling */
        .faq-item {
            margin-left : 20%;
        }
        .faq-q {
            font-size : 18px;
            font-weight : bold;
        }
        .faq-a {
            margin-left : 5%;
            font-size : 16px;
        }
        /* User-Feedback */
        #testimonials {
            text-align: center;
            padding: 40px 20px;
        }
        .testimonial-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        .testimonial-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 240px;
            text-align: center;
            transition: transform 0.3s;
        }
        .testimonial-card:hover {
            transform: scale(1.05);
            cursor : default;
        }
        .user-r {
            font-size: 16px;
            color: #333;
            font-style: italic;
            height : 175px;
        }
        .user-n {
            text-align: right;
            font-size: 18px;
            color: #666;
            font-weight: bold;
            margin-top: 10px;
        }
        .load-more-btn {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 1.1em;
            color: #fff;
            background: #28a745;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }
        .load-more-btn:hover {
            background: #218838;
        }
        footer {
            background-color: #333;
            color : white;
            margin-bottom : 0px;
            padding-bottom:0px;
        }
    </style>
</head>
<body>
    <div class="header" id="header">
        <div class="nav-bar">
            <img src="/Yt_Playlist/Docs/logo.jpeg" class="logo-l" alt="Logo" style="width: 120px; height: 45px;">
            <a href="#header">Home</a>
            <!-- <a href="signup_in.php">Login</a> -->
            <a href="/Yt_Playlist/download/templates/input.php">Download Playlist</a>
            <!-- <a href="/Yt_Playlist/download/templates/index.php">Test</a> -->
            <a href="/Yt_Playlist/Html/sub.php">Subscription</a>
            <a href="#contact">Contact Us</a>
            <a onclick="confirmLogout()">Logout</a>
            <p class="slogan centered" style="font-family: 'Brush Script MT', cursive; font-size : 30px; margin-left : 75px;">Learn. Connect. Succeed.</p>
        </div>
    </div>
    <div class="container dashboard-container text-center" style="margin-top : 5px;">
        <div class="welcome-message" style="background-color: #ffffff; border : solid white; color : black">
            <h3>
                <?php 
                    echo htmlspecialchars($message);
                    $id = $_SESSION['user_id'];
                    echo "<p></p>";
                    echo $sub_msg;
                ?>
            </h3>
           
        </div>
        <?php if ($sub == "0") : ?>
            <hr>
            <div id="sub" class="sub">
                <h2>Subscription</h2>
                <p>Subscribe to our service for unlimited access to our content.</p>
                <a href="/Yt_Playlist/Html/sub.php" class="subscribe-button">Subscribe</a>
            </div>
        <?php endif; ?>
        <hr>
        <div id="contact" class="contact">
            <section id="contact-section">
                <h2>Contact Us</h2>
                <div class="contact-options">
                <button id="contactFormBtn">Contact Form</button>
                <button id="feedbackFormBtn">Feedback Form</button>
                <a href="mailto:vadgamameet5@gmail.com" class="email-link">Email Us</a>
                </div>
            </section>
            
            <!-- Contact Form Popup -->
            <div id="contactFormPopup" class="popup">
                <div class="popup-content">
                <span class="close" id="closeContactForm">&times;</span>
                <h3>Contact Form</h3>
                <form action="/Yt_Playlist/php/reply.php" method="post">
                    <input type="hidden" name="form_type" value="contact">
                    <input type="hidden" name="uid" value=$id>
                    <label for="contact-name">Name:</label>
                    <input type="text" id="contact-name" name="contact-name" required>
                    
                    <label for="contact-email">Email:</label>
                    <input type="email" id="contact-email" name="contact-email" required>
                    
                    <label for="contact-message">Message:</label>
                    <textarea id="contact-message" name="contact-message" rows="4" required></textarea>
                    
                    <button type="submit">Submit</button>
                </form>
                </div>
            </div>
            
            <!-- Feedback Form Popup -->
            <div id="feedbackFormPopup" class="popup">
                <div class="popup-content">
                <span class="close" id="closeFeedbackForm">&times;</span>
                <h3>Feedback Form</h3>
                <form action="/Yt_Playlist/php/reply.php" method="post">    
                    <input type="hidden" name="form_type" value="feedback">
                    <input type="hidden" name="uid" value=$id>
                    <label for="feedback-name">Name:</label>
                    <input type="text" id="feedback-name" name="feedback-name" required>
                    
                    <label for="feedback-email">Email:</label>
                    <input type="email" id="feedback-email" name="feedback-email" required>
                    
                    <label for="feedback-message">Feedback:</label>
                    <textarea id="feedback-message" name="feedback-message" rows="4" required></textarea>
                    
                    <button type="submit">Submit</button>
                </form>
                </div>
            </div>
            <!-- Notification Popup -->
            <div id="notificationPopup">
                <h4><?php echo htmlspecialchars($form_message); ?></h4>
                <button onclick="closeNotification()">Close</button>
            </div>
        </div>
        <hr>
        <div class="section">
            <section id="faq">
                <h2>Frequently Asked Questions</h2>
                <br>
                <div class="faq-item text-left">
                    <p class="faq-q">1. How can I subscribe to YouPlayList?</p>
                    <p class="faq-a">You can subscribe by clicking on the <a href="/Yt_Playlist/Html/sub.php">"Subscription"</a> tab and choosing a plan that suits you.</p>
                </div>
                <div class="faq-item text-left">
                    <p class="faq-q">2. Can I download playlists for offline access?</p>
                    <p class="faq-a">Yes! Our premium users can download unlimited playlists and get priority support.</p>
                </div>
                <div class="faq-item text-left">
                    <p class="faq-q">3. How do I contact customer support?</p>
                    <p class="faq-a">You can reach us via the <a href="#contact">"Contact Us"</a> section or email us at <a href="mailto:youplaylist07@gmail.com"> youplaylist07@gmail.com.</a></p>
                </div>
                <div class="faq-item text-left">
                    <p class="faq-q">4. Is there a refund policy?</p>
                    <p class="faq-a">Yes, we offer a 7-day money-back guarantee if you are not satisfied with our service. Please contact us for details.</p>
                </div>
                <hr>
            </section>
            
            <section id="testimonials">
                <h2 class="text-center">What Our Users Say</h2>
                <div class="testimonial-container">
                    <div class="testimonial-card">
                        <p class="user-r">"YouPlayList is an absolute game-changer! I can easily download my entire YouTube playlist in one click, and the quality is fantastic."</p>
                        <h4 class="user-n">- Meet Gajjar</h4>
                    </div>

                    <div class="testimonial-card">
                        <p class="user-r">"As a content creator, I often need background music and reference videos. YouPlayList saves me so much time by letting me download entire playlists effortlessly."</p>
                        <h4 class="user-n">- Sarah Lee</h4>
                    </div>

                    <div class="testimonial-card">
                        <p class="user-r">"Customer support is excellent, and I love how smooth the experience is."</p>
                        <h4 class="user-n">- Michael Smith</h4>
                    </div>

                    <div class="testimonial-card">
                        <p class="user-r">"I’ve tried many playlist downloaders, but nothing beats YouPlayList! The speed is incredible, and the user-friendly interface makes downloading playlists a breeze."</p>
                        <h4 class="user-n">- Sophia Davis</h4>
                    </div>
                    
                    <?php echo $reviews; ?>
                    <!-- Load More Button -->
                    <button id="loadMore" class="load-more-btn">Load More</button>

                </div>
            </section>
            <hr>
        </div>
    </div>
    <footer class="text-center">
        <p style="margin-bottom: 0px; padding : 10px;">&copy; 2025 YouPlayList. All Rights Reserved.</p>
    </footer>
    <script src="/Yt_Playlist/js/contact.js"></script> 
    <script>
        // Show the notification popup if a message exists
        const formMessage = "<?php echo $form_message; ?>";
        if (formMessage) {
            document.getElementById('notificationPopup').style.display = 'block';
        }

        // Close the notification popup
        function closeNotification() {
            document.getElementById('notificationPopup').style.display = 'none';
        }   
        
        // Load reviews
        function loadMoreReviews() {
        let hiddenReviews = document.querySelectorAll(".testimonial-card.hidden");
        
        hiddenReviews.forEach(review => {
            review.classList.remove("hidden");
        });

        // Hide the "Load More" button after revealing the reviews
        document.getElementById("loadMore").style.display = "none";
        }

        document.getElementById("loadMore").addEventListener("click", loadMoreReviews);


        function confirmLogout() {
            // Ask for confirmation
            const userConfirmation = confirm("Are you sure you want to log out?");
            
            // If user clicks "OK", perform logout
            if (userConfirmation) {
            window.location.href = '/Yt_Playlist/Html/signup_in.php'; // Change this to your logout URL or logic
            } else {
            // If user clicks "Cancel", do nothing
            console.log("Logout cancelled");
            }
        }
    </script>
</body>
</html>
