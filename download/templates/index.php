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
            .vinyl {
                /* position: absolute;    */
                position : static;
                /* top: 80%;
                right: 10%; */
                margin-left : 80%;
                margin-top : 10%;
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
