<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Shallot</title>
</head>

<body>
    <?php
    session_start();
    $username = $_SESSION['username'];
    $type = $_SESSION['type'];
    $user = 'root';
    $pass = '';
    $db = 'newsApp';

    // connect to db
    $conn =  mysqli_connect('localhost', $user, $pass, $db);

    // check connection
    if (!$conn) {
        echo 'Connection failed' . mysqli_connect_error();
    }
    ?>
    <a href="index.php">Click to logout</a>
    <br>
    <button>Admin Portal</button>
    <a href="admin.php">Click to go to admin portal (WIP)</a>
    <div style='text-align:center'>
        <h1>The Shallot</h1>
        <h2>Fake News Only</h2>
        <hr>
        <?php echo "<h2> Welcome $username! </h2>"; ?>

        <form action="searchContent.php" method="post">
            Search for
            <select name="searchType" id="searchType">
                <option value="category">Category</option>
                <option value="article">Article</option>
            </select>
            by name:
            <input type="text" name="searchContent" id="">
            <input type="submit" value="Search">
        </form>
    </div>

    <div>
        <h3>Dashboard</h3>
        <a href="submitArticle.php">Submit Article</a>
    </div>
</body>

</html>