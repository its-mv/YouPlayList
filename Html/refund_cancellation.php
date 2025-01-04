<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancellation & Refund Policy</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <style>
        p {
            font-size: 14px;
        }
        
        .back-btn {
            margin: 20px 0;
            display: flex;
            justify-content: center;
        }

        h1, h3 {
            text-align: center;
        }

        hr {
            border: 1px solid #dee2e6;
        }
        
        .top-btn {
            position: absolute; /* Allows positioning the sticker on the card */
            top: 0px; /* Distance from the top of the card */
            transform: translateX(50%); /* Fine-tune alignment for center placement */
            font-size: 12px; /* Adjust the sticker font size */
            padding: 5px 10px; /* Adds space inside the sticker */
            border-radius: 5px; /* Rounded corners for the sticker */
            font-weight: bold; /* Makes the text stand out */
            z-index: 10; /* Ensures the sticker is above other elements on the card */
        }
        footer {
            background-color: #333;
            color : white;
            margin-bottom : 0px;
            padding-bottom : 0px;
        }
    </style>
    <script>
        <?php
            session_start();
            $email = $_SESSION['user_email'];
            $uid = $_SESSION['user_id'];
            $sub = $_SESSION['sub'];
            $msg = "";

            if ($sub == "0") {
                $msg; // Redirect to subscribe.php
            }
            else {
                $msg ="Contact : +91 8866788811";
            }
        ?>
    </script>
</head>
<body>
    <div class="container my-5">
        <div class="back-btn top-btn">
            <button class="btn btn-primary">
                <a href="/Yt_Playlist/Html/sub.php" class="text-white" style="text-decoration: none;">Back</a>
            </button>
        </div>
        <!-- Cancellation Policy -->
        <section id="cancellation-policy">
            <h1>Cancellation Policy</h1>
            <hr>
            <h6>Subscription Cancellation</h6>
            <p>You can cancel your subscription at any time by contacting our support team via email or phone. Cancellation will take effect at the end of your current billing cycle, and you will retain access to subscription benefits until the cycle ends. Partial refunds are not provided for cancellations made during an active billing cycle.</p>

            <h6>Midway Cancellation</h6>
            <p>If you cancel in between the end of the current billing cycle, a prorated refund will be issued based on usage.</p>
            
            <h6>Contact for Cancellation</h6>
            <p>Email: <a href="mailto:youplaylist07@gmail.com">youplaylist07@gmail.com</a></p>
            <p><?php echo $msg; ?></p>
        </section>

        <hr>

        <!-- Refund Policy -->
        <section id="refund-policy">
            <h1>Refund Policy</h1>
            <hr>
            <h6>Eligibility for Refund</h6>
            <p>Full refunds are provided only if you cancel within <strong>7 days</strong> of subscription purchase and have <strong>not accessed any subscription content</strong>. If any content is accessed, a prorated refund may be issued based on usage.</p>
            
            <h6>Non-Refundable Items</h6>
            <p>Taxes, transaction fees, and one-time setup fees (if applicable) are non-refundable. Refunds are not applicable to gift subscriptions, promotional discounts, or special offers.</p>
            
            <h6>Refund Process</h6>
            <p>Refund requests must be submitted via email to <a href="mailto:youplaylist07@gmail.com">support@yourcompany.com</a> within <strong>30 days</strong> of purchase. Approved refunds will be processed within <strong>7-10 business days</strong> to the original payment method.</p>
            
            <h6>Exceptions</h6>
            <p>Refunds will not be granted if the account is found in violation of our <a href="/terms-of-service" target="_blank">terms of service</a>. Refund requests due to technical issues will be considered only if the issue is reported and unresolved by our team.</p>
            
            <h6>Refund Contact Information</h6>
            <p>Email: <a href="mailto:youplaylist07@gmail.com">youplaylist07@gmail.com</a></p>
            <p><?php echo $msg; ?></p>
        </section>

        <!-- Back Button -->
        <div class="back-btn">
            <button class="btn btn-primary">
                <a href="/Yt_Playlist/Html/sub.php" class="text-white" style="text-decoration: none;">Back</a>
            </button>
        </div>
    </div>

    <footer class="text-center mt-5">
        <p>&copy; 2025 YouPlayList. All rights reserved. | <a href="#cancellation-policy">Cancellation Policy</a> | <a href="#refund-policy">Refund Policy</a></p>
    </footer>
</body>
</html>
