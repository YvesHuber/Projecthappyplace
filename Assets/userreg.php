<!DOCTYPE html>
<html>

<head>
    <title>Register useres</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/Assets/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="/Assets/marker.png">
    <style type="text/css">
        html,
        body
        {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
    </style>
    <?php
    include('login.php');
    ini_set('user_agent', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36');
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "happyplace";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if($admin != true){
        header("Location: login.html");
    }

    $lat = "SELECT username, password, FROM user";
    $resultla = $conn->query($lat);

    $usernameuser = $_GET['myuser'];
    $passworduser = $_GET['mypw'];

    if ($usernameuser != "" && $passworduser != ""){
    $cords = "INSERT INTO user (username,password)
    VALUES ('$usernameuser','$passworduser')";
        $result2 = $conn->query($cords);
    }
    ?>
</head>

<body>
    <form method="get">
        <label>Register User</label>
        <br>
        <br>
        <label for="myuser"></label>
        <input type="text" id="myuser" name="myuser" required placeholder="Username"><br><br>
        <label for="mypw"></label>
        <input type="mypw" id="mypw" name="mypw" required placeholder="Password"><br><br>
        <input type="submit" value="Submit">

    </form>
    <p><a href="./CRUD/Register.php">CRUD</a></p>

</body>

</html>