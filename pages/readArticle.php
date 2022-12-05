<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Shallot</title>
    <link rel="stylesheet" href="readArtStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="mainContainer">
        <div class="header">
            <center><img src="./photos/logoShallot.png" alt=""></center>
        </div>
        <form action="home.php" class="home">
            <div class="button">
                <input type="submit" value="<- Take Me Home Tonight">
            </div>
        </form>

        <div class="article">
            <?php
            session_start();
            if (!isset($_SESSION['username'])) {
                header("Location:index.php");
            }
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
                echo "<h2>Category: ", $row[2], "</h2><hr>";
                echo "<p>", $row[3], "</p><br>";
            }
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>