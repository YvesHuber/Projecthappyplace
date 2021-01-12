<!DOCTYPE html>
<html>

<head>
    <title>OpenLayers Demo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Assets/style.css">
    <style type="text/css">
        html,
        body,
        #basicMap {
            width: 75%;
            height: 75%;
            margin: 0;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/build/ol.js"></script>
    <script>
        function add_map_point(lng, lat) {
            var layer = new ol.layer.Vector({
                source: new ol.source.Vector({
                    features: [
                        new ol.Feature({
                            geometry: new ol.geom.Point(ol.proj.fromLonLat([lng, lat]))
                        })
                    ]
                })
            });
            map.addLayer(layer);
        }


        function init() {
            return new ol.Map({
                target: 'basicMap',
                layers: [
                    new ol.layer.Tile({
                        source: new ol.source.OSM()
                    })
                ],
                view: new ol.View({
                    center: ol.proj.fromLonLat([8.510, 47.36]),
                    zoom: 4
                })
            });
        }

    </script>
    <?php
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

    $lat = "SELECT name,latitude, longitude FROM places";
    $resultla = $conn->query($lat);

    $highestQuery = "SELECT * FROM places ORDER BY id DESC LIMIT 0, 1";
    $resultHigh = $conn->query($highestQuery);
    while ($row = $resultHigh->fetch_assoc()) {
        $idH = $row["id"];
    }
    $nextID = $idH + 1;
    $ort1 = $_GET['oname'];
    $lat1 = $_GET['fname'];
    $long1 = $_GET['lname'];

    if ($lat1 && $long1 != 0){
    $cords = "INSERT INTO places (id,name,latitude, longitude)
    VALUES ('$nextID','$ort1','$lat1','$long1')";
    }
    $vorname = $_GET['vorname'];
    $nachname = $_GET['nachname'];
    $NameQuery = "INSERT INTO apprentices(prename,lastname,place_id)
    VALUES ('$vorname','$nachname','$nextID')";
    $result3 = $conn->query($NameQuery);


    $result2 = $conn->query($cords);

    ?>
</head>

<body>
    <form method="get">
        <label for="vorname">Vorname:</label>
        <input type="text" id="vorname" name="vorname" required><br><br>
        <label for="nachname">Nachname:</label>
        <input type="text" id="nachname" name="nachname" required><br><br>
        <label for="oname">Ort:</label>
        <input type="text" id="oname" name="oname" required><br><br>
        <label for="fname">Lat:</label>
        <input type="text" id="fname" name="fname" required><br><br>
        <label for="lname">long:</label>
        <input type="text" id="lname" name="lname" required><br><br>
        <input type="submit" value="Submit">

    </form>

    <form action="Register.php" method="post">
        <ul>
            <li>
                <label for="login">Benutzer</label>
                <input id="login" name="login">
            </li>
            <li>
                <label for="pass">Passwort</label>
                <input id="pass" name="pass" type="password">
            </li>
            <li>
                <button>anmelden</button>
            </li>
        </ul>
    </form>

    <div id="basicMap"></div>
    <script>
        var map = init();

        <?php
        while ($row = $resultla->fetch_assoc()) {
            $name = $row["name"];
            echo "add_map_point(" . $row["longitude"] . "," . $row["latitude"] . ")\n";
        }
        ?>
    </script>

    </div>
</body>

</html>