<?php 
    session_start();
    
    // Redirect to login if user is not logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: /Yt_Playlist/Html/signup_in.php");
        exit;
    }
    $uid = $_SESSION['user_id'];
    $url = $_GET['playlist_url'];

    $conn = new mysqli("localhost", "root", "", "yt_playlist");
    $sql = "INSERT INTO downloaded (Link, uid) VALUES ('$url', '$uid')";
    $conn->query($sql);
    
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/Yt_Playlist/CSS/downloading.css">
        <link rel="icon" type="image/x-icon" href="/Yt_Playlist/Docs/favicon.png">
        <title>Download YouTube Playlist</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <style>
            /* Header container */
            .header {
                background-color: #dacacd;
                border-bottom: 2px solid #ccc;
                padding: 10px 20px 10px 20px;
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
                width: 120px;
                height : auto;
            }
            /* Headline */
            h1 {
                font-family: 'Lora', serif;
                font-size: 5rem;
                font-style : italic;
                font-weight: 700; /* Bold */
                animation: fadeIn 1s ease-in;
                line-height: 1.7;
                color: #34495e;
            }
            /*  Spinning Disk */
            .vinyl {
                position: absolute;
                top: 17%;
                right: 2%;
                width: 100px;
                height: 100px;
                background: url('/Yt_Playlist/Docs/vinyl.png') no-repeat center;
                background-size: cover;
                border-radius: 50%;
                animation: spin 10s linear infinite;
            }

            @keyframes spin {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }

            /* Instructions */
            li {
                font-size: 1.2rem;
                margin : 10px;
                list-style-type : none;
                text-align : left;
                margin-left : 10%;
                opacity: 0;
                animation: fadeIn 1s ease-in-out forwards;
            }
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .instruction li:nth-child(1) { animation-delay: 0.5s; }
            .instruction li:nth-child(2) { animation-delay: 1s; }
            .instruction li:nth-child(3) { animation-delay: 1.5s; }
            .instruction li:nth-child(4) { animation-delay: 2s; }
            .instruction li:nth-child(5) { animation-delay: 2.5s; }
            .instruction li:nth-child(6) { animation-delay: 3s; }
            .instruction li:nth-child(7) { animation-delay: 3.5s; }
            
            ul {
                animation : fadeIn 1s ease-in;
            }
            .inst {
                font-size: 2.2rem;
                font-weight: bold;
                margin : 20px;
                text-align: center;
                white-space: nowrap;
                overflow: hidden;
                color : red;
                animation : blink 1.5s infinite;
            }
            @keyframes blink {
                50% {
                    opacity: 0;
                }
            }
            /* Footer */
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
                <img class="logo" src="/Yt_Playlist/Docs/logo.jpeg" alt="Logo">
                <a href="/Yt_Playlist/Html/dashboard.php">Home</a>
                <a href="/Yt_Playlist/download/templates/input.php">Download Playlist</a>
                <a href="/Yt_Playlist/Html/dashboard.php#sub">Subscription</a>
                <a href="/Yt_Playlist/Html/dashboard.php#contact">Contact Us</a>
                <a href="/Yt_Playlist/Html/logout.php">Logout</a>
                <p class="slogan centered" style="font-family: 'Brush Script MT', cursive; font-size : 30px; margin-left : 165px;">Learn. Connect. Succeed.</p>
            </div>
        </div>
        <div class="container">
            <h1 >Download YouTube Playlist</h1>
            <hr>
            <form id="downloadForm">
                <p>Title : <input type="text" id="title" name="title" placeholder="Playlist Title" required></p>
                <p>Link : <input type="text" id="playlist_url" name="playlist_url" placeholder="Playlist URL" required></p>
                <br>
                <button type="submit" hidden>Download</button>
            </form>

            <div id="status" class="shimmer-text">
                <p id="current">Waiting for download...</p>
                <p id="error" style="color: red;"></p>
            </div>

            <div class="instruction">
                 
            <p class="inst"><strong>Please Follow These Instructions While Downloading : </strong></p>
                <ul>
                    <li><strong>Do Not Refresh or Close the Page</strong> while the process is running. Refreshing or closing the page may interrupt it and cause errors.</li>
                    <li><strong>Do Not Enter Any Input</strong>; no user action is required at this stage. The system is processing your request.</li>
                    <li><strong>Ensure enough Storage</strong>. The download process may require enough space as it downloads every videos in high quality.</li>
                    <li><strong>Ensure a Stable Internet Connection</strong>. A slow or interrupted connection may delay processing.</li>
                    <li><strong>Wait for Confirmation</strong>. Once processing is complete, you will see a confirmation message.</li>
                    <li><strong>Downloaded File</strong>. After successful processing, check the download folder in your system to retrieve your file.</li>
                    <li><strong>If You Face Any Issues</strong>. If the process takes too long or shows an error, try again later or <a href="/Yt_Playlist/Html/dashboard.php#contact">contact</a> support.</li>
                </ul>
            </div>

            <script>
                let formSubmitted = false;
                // Function to get query parameters from URL
                function getQueryParams() {
                    const params = {};
                    const queryString = window.location.search.substring(1);
                    const queries = queryString.split("&");
                    queries.forEach(query => {
                        const [key, value] = query.split("=");
                        params[decodeURIComponent(key)] = decodeURIComponent(value || "");
                    });
                    return params;
                }
                $(document).ready(function () {
                    const params = getQueryParams();

                    if (params.title) $('#title').val(params.title);
                    if (params.playlist_url) $('#playlist_url').val(params.playlist_url);

                    if (!formSubmitted && params.title && params.playlist_url) {
                        $('#current').text("Starting download...");
                        formSubmitted = true; // Prevent further submissions
                        $('#downloadForm').submit();
                    }
                });
                
                $('#downloadForm').on('submit', function (e) {
                    e.preventDefault();
                
                    let title = $('#title').val();
                    let playlist_url = $('#playlist_url').val();
                
                    const youtubePlaylistRegex = /^https:\/\/www\.youtube\.com\/playlist\?list=[a-zA-Z0-9_-]+$/;
                    if (!youtubePlaylistRegex.test(playlist_url)) {
                        $('#error').text("Invalid playlist URL. Please check and try again.");
                        return;
                    }
                
                    $.ajax({
                        url: 'http://127.0.0.1:5000/download',
                        type: 'POST',
                        data: {
                            title: title,
                            playlist_url: playlist_url,
                        },
                        success: function (response) {
                            $('#current').text(response.current || "Download started...");
                            if (response.error) {
                                $('#error').text(response.error);
                            }
                        },
                        error: function () {
                            $('#error').text("Error connecting to the server. Please try again.");
                        }                    
                    });
                });            
            </script>        
            <div class="vinyl"></div>
        </div>
    <footer class="text-center">
        <p style="margin-bottom: 0px; padding : 10px;">&copy; 2025 YouPlayList. All Rights Reserved.</p>
    </footer>
</body>
</html>
