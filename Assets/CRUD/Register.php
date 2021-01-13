<?php include('php_code.php'); ?>
<?php include('login.php');?>
<?php
    if($admin != true){
        header("Location: login.html");
    }




if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($db, "SELECT * FROM apprentices WHERE id=$id");
    echo mysqli_error($db);
    if (count($record) == 1) {
        $n = mysqli_fetch_array($record);
        $prename = $n['prename'];
        $lastname = $n['lastname'];
        $place_id = $n['place_id'];
    }
}
?>
<!DOCTYPE html>
<html>

<head>
<link rel="shortcut icon" type="image/x-icon" href="../../Assets/marker.png">
<link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
    <title>CRUD</title>
    <link rel="stylesheet" type="text/css" href="../../Assets/style.css">

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


    <?php $results = mysqli_query($db, "SELECT * FROM apprentices");
    echo mysqli_error($db);
    ?>


    <table>
        <thead>
            <tr>
                <th>prename</th>
                <th>lastname</th>
                <th>place_id</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>

        <?php while ($row = mysqli_fetch_array($results)) { ?>
            <tr>
                <td><?php echo $row['prename']; ?></td>
                <td><?php echo $row['lastname']; ?></td>
                <td><?php echo $row['place_id']; ?></td>
                <td>
                    <a href="Register.php?edit=<?php echo $row['id']; ?>" class="edit_btn">Edit</a>
                </td>
                <td>
                    <a href="php_code.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <form method="post" action="php_code.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="input-group">
            <label>prename</label>
            <input type="text" name="prename" value="<?php echo $prename; ?>">
        </div>
        <div class="input-group">
            <label>lastname</label>
            <input type="text" name="lastname" value="<?php echo $lastname; ?>">
        </div>
        <div class="input-group">
            <label>place_id</label>
            <input type="text" name="place_id" value="<?php echo $place_id; ?>">
        </div>
        <div class="input-group">
            <?php if ($update == true) : ?>
                <button class="btn" type="submit" name="update" style="background: #556B2F;">update</button>
            <?php else : ?>
                <button class="btn" type="submit" name="save">Save</button>
            <?php endif ?>
        </div>
    </form>
    <p class="links1"> <a href="../../index.php">back to main page</p>
    <p class="links1"> <a href="../login.html">back to registry</p>
</body>

</html>