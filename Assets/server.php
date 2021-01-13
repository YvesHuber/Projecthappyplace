<?php

$conn = mysqli_connect('localhost', 'root', '', 'happyplace');
session_start();
// initialize variables
$prename = "";
$lastname = "";
$id = 0;
$update = false;

if (isset($_POST['save'])) {

    

    $highestQuery = "SELECT * FROM places ORDER BY id DESC LIMIT 0, 1";
    $resultHigh = $conn->query($highestQuery);
    while ($row = $resultHigh->fetch_assoc()) {
        $idH = $row["id"];
    }
    $nextID = $idH + 1;
    $ort1 = $_GET['Ort'];
    $lat1 = $_GET['Latitude'];
    $long1 = $_GET['Longitude'];

    if ($lat1 && $long1 != 0) {
        $cords = "INSERT INTO places (id,name,latitude, longitude)
    VALUES ('$nextID','$ort1','$lat1','$long1')";
        $result2 = $conn->query($cords);
        $placeID = $conn->insert_id; // function will now return the ID instead of true.
    }
    $vorname = $_GET['prename'];
    $nachname = $_GET['lastname'];
    $NameQuery = "INSERT INTO apprentices(prename,lastname,place_id)
    VALUES ('$vorname','$nachname','$placeID')";

    $result3 = $conn->query($NameQuery);
    echo mysqli_error($NameQuery);

    header('location: Register.php');
}
