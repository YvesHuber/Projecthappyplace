<!DOCTYPE html>
<html>

<head>
    <title>OpenLayers Demo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/Assets/style.css">
    <style type="text/css">
        html,
        body,
        #basicMap {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
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


        function login() {

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

    if ($lat1 && $long1 != 0) {
        $cords = "INSERT INTO places (id,name,latitude, longitude)
    VALUES ('$nextID','$ort1','$lat1','$long1')";
        $result2 = $conn->query($cords);
        $placeID = $conn->insert_id; // function will now return the ID instead of true.
    }
    $vorname = $_GET['vorname'];
    $nachname = $_GET['nachname'];
    $NameQuery = "INSERT INTO apprentices(prename,lastname,place_id)
    VALUES ('$vorname','$nachname','$nextID')";

    $result3 = $conn->query($NameQuery);
    echo mysqli_error($NameQuery);

    ?>
</head>

<body>
    <form method="get">
        <label for="vorname"></label>
        <input type="text" id="vorname" name="vorname" required placeholder="Vorname"><br><br>
        <label for="nachname"></label>
        <input type="text" id="nachname" name="nachname" required placeholder="Nachname"><br><br>
        <label for="oname"></label>
        <input type="text" id="oname" name="oname" required placeholder="Ort"><br><br>
        <label for="fname"></label>
        <input type="text" id="fname" name="fname" required placeholder="Latitude"><br><br>
        <label for="lname"></label>
        <input type="text" id="lname" name="lname" required placeholder="Longitude"><br><br>
        <input type="submit" value="Submit">

    </form>
    <p><a href="/Assets/login.html">LOGIN</a></p>



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