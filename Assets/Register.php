<?php include('server.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>CRUD: CReate, Update, Delete PHP MySQL</title>
</head>

<body>
    <?php if (isset($_SESSION['message'])) : ?>
        <div class="msg">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?>
    <form method="post" action="server.php">
        <div class="input-group">
            <label>prename</label>
            <input type="text" name="prename" value="">
        </div>
        <div class="input-group">
            <label>name</label>
            <input type="text" name="lastname" value="">
        </div>
        <div class="input-group">
            <label>Ort</label>
            <input type="text" name="Ort" value="">
        </div>
        <div class="input-group">
            <label>Latitude</label>
            <input type="text" name="Latitude" value="">
        </div>
        <div class="input-group">
            <label>Longitude</label>
            <input type="text" name="Longitude" value="">
        </div>
        <div class="input-group">
            <button class="btn" type="submit" name="save">Save</button>
        </div>
    </form>
    <?php $results = mysqli_query($db, "SELECT * FROM info"); ?>

    <table>
        <thead>
            <tr>
                <th>prename</th>
                <th>name</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>

        <?php while ($row = mysqli_fetch_array($results)) { ?>
            <tr>
                <td><?php echo $row['prename']; ?></td>
                <td><?php echo $row['lastname']; ?></td>
                <td>
                    <a href="Register.php?edit=<?php echo $row['id']; ?>" class="edit_btn">Edit</a>
                </td>
                <td>
                    <a href="server.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <form>
</body>

</html>