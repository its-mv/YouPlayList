<?php
    session_start();

    $email = $_SESSION['user_email'];
    $uid = $_SESSION['user_id'];
    // $email = "vadgamameet5@gmail.com";
    // $uid = "3";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/Yt_Playlist/Docs/favicon.png">
    <title>Subscription Plans</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .sticker-badge {
            position: absolute; /* Allows positioning the sticker on the card */
            top: -12px; /* Distance from the top of the card */
            right: 65%; /* Distance from the right edge of the card */
            transform: translateX(50%); /* Fine-tune alignment for center placement */
            font-size: 12px; /* Adjust the sticker font size */
            background-color: #ff5733; /* Sticker background color */
            color: white; /* Sticker text color */
            padding: 5px 10px; /* Adds space inside the sticker */
            border-radius: 5px; /* Rounded corners for the sticker */
            font-weight: bold; /* Makes the text stand out */
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2); /* Adds a subtle shadow for a raised effect */
            transform: rotate(-20deg); /* Gives the sticker a slanted, dynamic appearance */
            transform : translate
            z-index: 10; /* Ensures the sticker is above other elements on the card */
        }
        .sticker-badge.popular {
            background-color: #28a745; /* Green color for "popular" sticker */
        }
        .sticker-badge.suitable {
            background-color: #ffc107; /* Yellow color for "suitable" sticker */
        }
        .plan-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .plan-card:hover {
            transform: scale(1.05);
        }
        .price {
            font-size: 2rem;
            font-weight: bold;
            color: #007bff;
        }
        .features {
            list-style: none;
            padding: 0;
        }
        .features li {
            margin: 10px 0;
            font-size: 1rem;
        }
        .btn-subscribe {
            font-size: 1.1rem;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .section-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-top: 40px;
        }
        #amail {
            color : white;
            text-decoration : none;
        }
        #amail:hover {
            text-decoration : underline;
        }
        a {
            color : black;
            text-decoration: underline;
        }
        #faqs {
            color : black;
            text-decoration: underline;
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
            padding: 8px 12px 8px 12px;
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
            width: 120px;
            height : auto;
        }
        footer {
            background-color: #333;
            color : white;
            margin-bottom : 0px;
            padding-bottom : 0px;
        }
    </style>
</head>
<script>
</script>
<body>
    <div class="header" id="header">
        <div class="nav-bar">
            <img src="/Yt_Playlist/Docs/logo.jpeg" class="logo-l" alt="Logo" style="width: 120px; height: 50px;">
            <a href="/Yt_Playlist/Html/dashboard.php#header">Home</a>
            <a href="/Yt_Playlist/download/templates/input.php">Download Playlist</a>
            <!-- <a href="/Yt_Playlist/download/templates/index.php">Test</a> -->
            <a href="#sub">Subscription</a>
            <a href="/Yt_Playlist/Html/dashboard.php#contact">Contact Us</a>
            <a href="/Yt_Playlist/PHP/logout.php">Logout</a>
            <p class="slogan centered" style="font-family: 'Brush Script MT', cursive; font-size : 30px; margin-left : 160px;">Learn. Connect. Succeed.</p>
        </div>
    </div>
    <div class="container text-center my-5">
        <h1 id="sub" class="mb-4">Choose Your Subscription Plan</h1>
        <p class="text-muted mb-5">Get the best features tailored to your needs. Upgrade now!</p>
        
        <!-- Subscription Plans -->
        <div class="row">
            <div class="col-md-3">
                <div class="plan-card p-3">
                    <h3>Basic Plan</h3>
                    <p class="price">&#8377;99 <span class="text-muted">/ Plan</span></p>
                    <p class="price-2">&#8377;99 <span class="text-muted">/ Month</span></p>
                    <ul class="features">
                        <li>Valid for 30 days (1 Month)</li>
                        <li>Unlimited Downloads</li>
                        <li>Email Support</li>
                    </ul>
                    <button class="btn btn-success btn-subscribe">
                        <a id="amail" href="mailto:youplaylist07@gmail.com?subject=Subscription%20Request&body=This%20is%20a%20request%20for%20a%20subscription.%09<?php echo "%0A%0AMy Email is : ".$email."%0AMy User id is : ".$uid."%0AMy Plan is : 1 Month"; ?>">Subscribe Now</a>
                    </button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="plan-card p-3">
                    <h3>Premium Plan</h3>
                    <p class="price">&#8377;269 <span class="text-muted">/ Plan</span></p>
                    <p class="price-2">&#8377;89 <span class="text-muted">/ Month</span></p>
                    <ul class="features">
                        <li>Valid for 90 days (3 Months)</li>
                        <li>Unlimited Downloads</li>
                        <li>Email Support</li>
                    </ul>
                    <button class="btn btn-success btn-subscribe">
                        <a id="amail" href="mailto:youplaylist07@gmail.com?subject=Subscription%20Request&body=This%20is%20a%20request%20for%20a%20subscription.%09<?php echo "%0A%0AMy Email is : ".$email."%0AMy User id is : ".$uid."%0AMy Plan is : 3 Month"; ?>">Subscribe Now</a>
                    </button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="plan-card p-3">
                    <span class="sticker-badge suitable">Most Suitable</span>
                    <h3>Enterprise Plan</h3>
                    <p class="price">&#8377;499 <span class="text-muted">/ Plan</span></p>
                    <p class="price-2">&#8377;83 <span class="text-muted">/ Month</span></p>
                    <ul class="features">
                        <li>Valid for 180 days (6 Months)</li>
                        <li>Unlimited Downloads</li>
                        <li>Email Support</li>
                    </ul>
                    <button class="btn btn-success btn-subscribe">
                        <a id="amail" href="mailto:youplaylist07@gmail.com?subject=Subscription%20Request&body=This%20is%20a%20request%20for%20a%20subscription.%09<?php echo "%0A%0AMy Email is : ".$email."%0AMy User id is : ".$uid."%0AMy Plan is : 6 Month"; ?>">Subscribe Now</a>
                    </button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="plan-card p-3">
                    <h3>Enterprise Plan</h3>
                    <p class="price">&#8377;899 <span class="text-muted">/ Plan</span></p>
                    <p class="price-2">&#8377;75 <span class="text-muted">/ Month</span></p>
                    <ul class="features">
                        <li>Valid for 12 Months (1 Year)</li>
                        <li>Unlimited Downloads</li>
                        <li>Email Support</li>
                    </ul>
                    <button class="btn btn-success btn-subscribe">
                        <a id="amail" href="mailto:youplaylist07@gmail.com?subject=Subscription%20Request&body=This%20is%20a%20request%20for%20a%20subscription.%09<?php echo "%0A%0AMy Email is : ".$email."%0AMy User id is : ".$uid."%0AMy Plan is : 1 Year"; ?>">Subscribe Now</a>
                    </button>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-md-3">
                <div class="plan-card p-3">
                    <h3>Basic Plan</h3>
                    <p class="price">&#8377;149 <span class="text-muted">/ Plan</span></p>
                    <p class="price-2">&#8377;149 <span class="text-muted">/ Month</span></p>
                    <ul class="features">
                        <li>Priority Contact Support</li>
                        <li>Valid for 30 days (1 Month)</li>
                        <li>Unlimited Downloads</li>
                        <li>Email Support</li>
                    </ul>
                    <button class="btn btn-success btn-subscribe">
                        <a id="amail" href="mailto:youplaylist07@gmail.com?subject=Subscription%20Request&body=This%20is%20a%20request%20for%20a%20subscription.%09<?php echo "%0A%0AMy Email is : ".$email."%0AMy User id is : ".$uid."%0AMy Plan is : 1 Month"; ?>">Subscribe Now</a>
                    </button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="plan-card p-3">
                    <h3>Premium Plan</h3>
                    <span class="sticker-badge popular">Most Popular</span>
                    <p class="price">&#8377;339 <span class="text-muted">/ Plan</span></p>
                    <p class="price-2">&#8377;113 <span class="text-muted">/ Month</span></p>
                    <ul class="features">
                        <li>Priority Contact Support</li>
                        <li>Valid for 90 days (3 Months)</li>
                        <li>Unlimited Downloads</li>
                        <li>Email Support</li>
                    </ul>
                    <button class="btn btn-success btn-subscribe">
                        <a id="amail" href="mailto:youplaylist07@gmail.com?subject=Subscription%20Request&body=This%20is%20a%20request%20for%20a%20subscription.%09<?php echo "%0A%0AMy Email is : ".$email."%0AMy User id is : ".$uid."%0AMy Plan is : 3 Month"; ?>">Subscribe Now</a>
                    </button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="plan-card p-3">
                    <h3>Enterprise Plan</h3>
                    <span class="sticker-badge suitable">Most Suitable</span>
                    <p class="price">&#8377;599 <span class="text-muted">/ Plan</span></p>
                    <p class="price-2">&#8377;99 <span class="text-muted">/ Month</span></p>
                    <ul class="features">
                        <li>Priority Contact Support</li>
                        <li>Valid for 180 days (6 Months)</li>
                        <li>Unlimited Downloads</li>
                        <li>Email Support</li>
                    </ul>
                    <button class="btn btn-success btn-subscribe">
                        <a id="amail" href="mailto:youplaylist07@gmail.com?subject=Subscription%20Request&body=This%20is%20a%20request%20for%20a%20subscription.%09<?php echo "%0A%0AMy Email is : ".$email."%0AMy User id is : ".$uid."%0AMy Plan is : 6 Month"; ?>">Subscribe Now</a>
                    </button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="plan-card p-3">
                    <h3>Enterprise Plan</h3>
                    <p class="price">&#8377;1079 <span class="text-muted">/ Plan</span></p>
                    <p class="price-2">&#8377;89 <span class="text-muted">/ Month</span></p>
                    <ul class="features">
                        <li>Priority Contact Support</li>
                        <li>Valid for 12 Months (1 Year)</li>
                        <li>Unlimited Downloads</li>
                        <li>Email Support</li>
                    </ul>
                    <button class="btn btn-success btn-subscribe">
                        <a id="amail" href="mailto:youplaylist07@gmail.com?subject=Subscription%20Request&body=This%20is%20a%20request%20for%20a%20subscription.%09<?php echo "%0A%0AMy Email is : ".$email."%0AMy User id is : ".$uid."%0AMy Plan is : 1 Year"; ?>">Subscribe Now</a>
                    </button>
                </div>
            </div>
        </div>

        <!-- Support and Policies -->
        <div class="section-title text-left">Support and Policies</div>
        <div class="row mt-4">
            <div class="col-md-4">
                <h5>FAQs</h5>
                <hr>
                <div id="faq-section">
                    <div>
                        <button id="faqs" class="btn text-left" data-toggle="collapse" data-target="#faq1">
                            What happens if I cancel?
                        </button>
                        <div id="faq1" class="collapse text-left">
                            <ul>
                                <li>To cancel your subscription, you need to contact our support team.</li> 
                                <li>Please note that you will not receive a 100% refund if you've used subscription content.</li> 
                                <li>Taxes are non-refundable.</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <button id="faqs" class="btn text-left" data-toggle="collapse" data-target="#faq2">
                            Is there a money-back guarantee?
                        </button>
                        <div id="faq2" class="collapse text-left">
                            <ul>
                                <li>Yes, we offer a money-back guarantee under certain conditions.</li>
                                <li>If you've accessed subscription content, you won't be eligible for a full refund.</li>
                                <li>Taxes and additional fees are non-refundable.</li>  
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <h5>Terms and Conditions</h5>
                <hr>
                <p><a href="/Yt_Playlist/Html/Terms.php" target="_blank">View our subscription terms</a></p>
                <p><a href="/Yt_Playlist/Html/refund_cancellation.php" target="_blank">Refund & Cancellation Policy</a></p>
            </div>
            <div class="col-md-4">
                <h5>Support Contact Info</h5>
                <hr>
                <p>Email: <a href="mailto:youplaylist07@gmail.com">youplaylist07@gmail.com</a></p>
                <p>Phone: +123 456 789</p>
            </div>
        </div>
    </div>
    
    <footer class="text-center">
        <p style="margin-bottom: 0px; padding : 10px;">&copy; 2025 YouPlayList. All Rights Reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
