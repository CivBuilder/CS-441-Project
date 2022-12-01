<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Shallot</title>
</head>

<body>
    <!-- header -->
    <div style='text-align:center'>
        <h1>The Shallot</h1>
        <h2>Fake News Only</h2>
    </div>

    <a href="home.php">Return home</a>

    <?php
    session_start();
    $username = $_SESSION['username'];
    $type = $_SESSION['type'];
    $user = 'root';
    $pass = '';
    $db = 'newsApp';

    $articleTitle = $_GET['article'];

    // below variables come from form post
    $conn =  mysqli_connect('localhost', $user, $pass, $db);
    // check connection
    if (!$conn) {
        echo 'Connection failed' . mysqli_connect_error();
    }
    // getting the project's information
    $sql =  "SELECT `title`, `username`, `category`, `content` FROM `newstable` WHERE `title` = '$articleTitle'";
    $res = mysqli_query($conn, $sql);

    // make an array
    $articleInfo = mysqli_fetch_all($res);

    foreach ($articleInfo as $row) {
        echo "<h1>", $row[0], "</h1>";
        echo "<h2>Written by: ", $row[1], "</h2>";
        echo "<h3>Category: ", $row[2], "</h3><hr>";
        echo "<p>", $row[3], "</p><br>";
    }
    ?>
</body>

</html>