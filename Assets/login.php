<?php
ini_set('user_agent', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36');
$servername = "localhost";
$sqlusername = "root";
$sqlpassword = "";
$dbname = "happyplace";

// Create connection
$conn = new mysqli($servername, $sqlusername, $sqlpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$admin = False;
if (isset($_POST['but_submit'])) {

    $uname = mysqli_real_escape_string($conn, $_POST['txt_uname']);
    $password = mysqli_real_escape_string($conn, $_POST['txt_pwd']);

    if ($uname == "" || $password == "") {
        header('location: login.html');
    }

    if ($uname != "" && $password != "") {

        $myusername = mysqli_real_escape_string($conn, $_POST['txt_uname']);
        $mypassword = mysqli_real_escape_string($conn, $_POST['txt_pwd']);
        $verifacation = "SELECT username FROM user WHERE username = '$myusername' AND password = '$mypassword';";
        $result = mysqli_query($conn, $verifacation);
        if (mysqli_num_rows($result)) {
            echo "Acess granted";
            $admin = true;
            header("Location: userreg.php");
        } else {
            print $verifacation;
            die(mysqli_error($conn));
            echo "Something went wrong :-(";
            header("Location: login.html");
        }
    }
}