<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Service & Privacy Policy</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <style>
        p {
            font-size : 14px;
        }
        
        .back-btn {
            margin: 20px 0;
            display: flex;
            justify-content: center;
        }
        .top-btn {
            position: absolute; /* Allows positioning the sticker on the card */
            top: 10px; /* Distance from the top of the card */
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
            padding-bottom:0px;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="back-btn top-btn">
            <button class="btn btn-primary">
                <a href="/Yt_Playlist/Html/dashboard.php" class="text-white" style="text-decoration: none;">Back</a>
            </button>
        </div>
        <section id="terms-of-service">
            <h1 class="text-center">Terms of Service</h1>
            <hr>
            <h6>1. Introduction</h2>
            <p>Welcome to YouPlayList. By using our services, you agree to these Terms of Service. Please read them carefully.</p>

            <h6>2. User Responsibilities</h2>
            <p>Users are expected to use this website responsibly and lawfully. Misuse, including hacking, uploading malicious content, or engaging in unlawful activities, is strictly prohibited.</p>

            <h6>3. Intellectual Property</h2>
            <p>All website content, including text, images, and code, is the property of YouPlayList. Unauthorized use or duplication is prohibited.</p>

            <h6>4. Disclaimer of Liability</h2>
            <p>We are not responsible for any damages resulting from the use of our services. Use the platform at your own risk.</p>

            <h6>5. Modifications to Terms</h2>
            <p>We reserve the right to update these Terms of Service at any time. Changes will be communicated on this page.</p>

            <h6>6. Governing Law</h2>
            <p>These Terms of Service are governed by the laws of India.</p>
        </section>

        <hr>

        <section id="privacy-policy">
            <h1 class="text-center">Privacy Policy</h1>
            <hr>
            <h6>1. Information We Collect</h2>
            <p>We collect personal information (e.g., name, email) and non-personal information (e.g., browser type, IP address).</p>

            <h6>2. How We Use Information</h2>
            <p>Data is used to improve user experience, provide support, and enhance website functionality.</p>

            <h6>3. Data Sharing</h2>
            <p>We do not sell user data. Information may be shared with third-party services for analytics or legal compliance.</p>

            <h6>4. Cookies</h2>
            <p>We use cookies to track website performance and enhance user experience. You can disable cookies in your browser settings.</p>

            <h6>5. Data Security</h2>
            <p>We implement industry-standard security measures to protect your data from unauthorized access.</p>

            <h6>6. User Rights</h2>
            <p>You have the right to request data deletion or opt out of data collection. Contact us at [Support Email] for assistance.</p>

            <h6>7. Changes to Policy</h2>
            <p>We reserve the right to update this Privacy Policy at any time. Updates will be communicated on this page.</p>
        </section>
         <!-- Back Button -->
         <div class="back-btn">
            <button class="btn btn-primary">
                <a href="/Yt_Playlist/Html/dashboard.php" class="text-white" style="text-decoration: none;">Back</a>
            </button>
        </div>
    </div>

    <footer class="text-center mt-5">
        <p>&copy; 2025 YouPlayList. All rights reserved. | <a href="#terms-of-service">Terms of Service</a> | <a href="#privacy-policy">Privacy Policy</a></p>
    </footer>
</body>
</html>
