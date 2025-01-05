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

    // Get the user ID from the session
    $user_id = $_SESSION['user_id'];
    $sub = $conn->query("SELECT sub FROM user WHERE uid = '$user_id'");
    $sub = $sub->fetch_assoc()['sub'];
    $dwn_time = $conn->query("SELECT Did FROM downloaded WHERE uid = '$user_id'");
    $sub_limitq = $conn->query("SELECT S_status FROM subscription WHERE uid = '$user_id'");
    $sub_limit = $sub_limitq->fetch_assoc()['S_status'];
    $msg = "";
    $msgg = "";
    $allow = 0;

    if ($sub == "0") {
        if ($dwn_time->num_rows >= 1) {
            $msgg = '<br>You have not subscribed to our service.<br>You are not able to download as you have exceded the download limit.<br>For more you can just <a href="/Yt_Playlist/Html/sub.php">subscribe</a> to our service and get unlimited access.';
            $allow = 0;
        }
        else {
            $msg = '<br>You are allowed to download 1 playlist for free.';
            $allow = 1;
        }
    }
    else {
        if ($sub_limit == "Active") {
            $msg = '<br>You are allowed to download unlimited playlist.';
            $allow = 1;
        }
        else {
            $msgg = '<br>Your subscription has expired.<br>For more you can just <a href="/Yt_Playlist/Html/sub.php">subscribe</a> to our service and get unlimited access.';
            $allow = 0;
        }
    }

    // Running the app.py file
    // $output = [];
    // $return_var = 0;
    // exec('python C:/xampp/htdocs/Yt_Playlist/download/app.py 2>&1', $output, $return_var);

    // if ($return_var !== 0) {
    //     echo "Error executing script: " . implode("\n", $output);
    // } else {
    //     echo "Script executed successfully!";
    // }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Yt_Playlist/CSS/download.css">
    <link rel="icon" type="image/x-icon" href="/Yt_Playlist/Docs/favicon.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    <title>Playlist Download</title>
    <style>
        * {
            /* background: linear-gradient(to top, #e0f7fa, #ffffff); */
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
            text-align: center;
        }

        .vinyl {
            position: absolute;
            top: 15%;
            right: 10%;
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


        .container {
            /* display: flex; */
            /* justify-content: center;
            align-items: center;  */
            margin-right : 0px;
            padding-right : 0px;
            height: auto;
            width: auto;
            margin: 10px;
            padding: 10px;
            box-sizing: border-box;
            text-align: center;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }


        h1 {
            font-family: 'Lora', serif;
            font-size: 5rem;
            font-style : italic;
            font-weight: 700; /* Bold */
            animation: fadeIn 1s ease-in;
            line-height: 1.7;
            color: #34495e;
        }

        .cust-hr {
            height : 2px;
            /* border : 2px solidrgb(59, 94, 154); */
            background-color : rgb(36, 62, 106);
        }

        form {
            font-family: 'Lora', serif;
            font-size : 2rem;
        }

        label {
            width: auto;
            height : auto;
            margin: 10px;
        }

        input {
            font-size : 16px;
            border-radius: 4px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        input:focus {
            border-color: #1E88E5;
            outline: none;
            box-shadow: 0 0 5px rgba(30, 136, 229, 0.5);
        }

        #playlist_url {
            width: auto;
            height : auto;
            text-wrap: wrap;
        }

        .dwnld {
            margin-top: 20px;
            padding: 10px 20px;
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

        .nav-bar a:active {
            background-color: #bbb;
            color: #fff;
        }

        .logo {
            width: 120px;
            height: 45px;   
        }

        .slogan {
            font-family: 'Brush Script MT', cursive;
        }
        
        .slogan:hover {
            transform : scale(1.9);
            transition : 0.5s;
            color : #099;
        }

        .sub-msg {
            font-family: 'Brush Script MT', cursive;
            font-size : 60px;
            height : 132px;
        }

        .sub-msgg {
            font-family : 'Lora', serif;
            font-size : 30px;
            align-content : center;
            padding-top : 120px;
            margin-bottom : 192px;
        }
        footer {
            background-color: #333;
            color : white;
            margin-bottom : 0px;
            padding-bottom : 0px;
        }

    </style>
</head>
<body> 
    <div class="header text-bottom" id="header" >
        <div class="nav-bar">
            <img class="logo" src="/Yt_Playlist/Docs/logo.jpeg" alt="Logo">
            <a href="/Yt_Playlist/Html/dashboard.php">Home</a>
            <a href="/Yt_Playlist/download/templates/input.php">Download Playlist</a>
            <a href="/Yt_Playlist/Html/dashboard.php#sub">Subscription</a>
            <a href="/Yt_Playlist/Html/dashboard.php#contact">Contact Us</a>
            <a href="/Yt_Playlist/Html/logout.php">Logout</a>
            <p class="slogan centered" style="font-family: 'Brush Script MT', cursive; font-size : 30px; margin-left : 13%;">Learn. Connect. Succeed.</p>
        </div>
    </div>
    <div class="container text-center">
        <?php if($allow == 1) : ?>
            <h1 class="headline">Enter Playlist Details</h1>
            <hr class="cust-hr">
            <form action="/Yt_Playlist/download/templates/index.php" method="get">
                <label for="title" >Playlist Title:</label>
                <input type="text" id="title" name="title" placeholder="Ex., Playlist Name" required>
                <br>
                <label for="playlist_url">Playlist URL:</label>
                <input type="text" id="playlist_url" name="playlist_url" placeholder="Ex., https://youtube.com/playlist?" required>
                <br>
                <button type="submit" class="dwnld btn btn-primary">Proceed to Download</button>
            </form>
            <div class="vinyl"></div>
        <?php endif; ?>
        <?php if($msgg == "") : ?>
            <p class="sub-msg"><?php echo $msg;?></p>
        <?php elseif($msg == "") : ?>
            <p class="sub-msgg"><?php echo $msgg;?></p>
        <?php endif; ?>
    </div>
    <footer class="text-center">
        <p style="margin-bottom: 0px; padding : 10px;">&copy; 2025 YouPlayList. All Rights Reserved.</p>
    </footer>
</body>
</html>
