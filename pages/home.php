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

    // variables for category subscriptions
    $sports = 0;
    $business = 0;
    $technology = 0;
    $politics = 0;

    // connect to db
    $conn =  mysqli_connect('localhost', $user, $pass, $db);

    // check connection
    if (!$conn) {
        echo 'Connection failed' . mysqli_connect_error();
    }

    $sql =  "SELECT `sports`, `business`, `technology`, `politics` FROM `usertable` WHERE `username` = '$username'";
    $res = mysqli_query($conn, $sql);

    // make an array
    $subscriptions = mysqli_fetch_all($res);
    foreach ($subscriptions as $category) {
        if ($category[0] == 1) {
            $sports = 1;
        }
        if ($category[1] == 1) {
            $business = 1;
        }
        if ($category[2] == 1) {
            $technology = 1;
        }
        if ($category[3] == 1) {
            $politics = 1;
        }
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

    <div>
        <h1 style='text-align:center'><u>Newsfeed</u></h1>
        <?php
        if ($sports == 0 && $business == 0 && $technology == 0 && $politics == 0) {
            echo "<h2 style='text-align:center'>You don't have any subscriptions yet, search for categories and subscribe to your interests</h2>";
        } else {
        ?>
            <table>
                <tr>
                    <td> <b> Article Name</b></td>
                    <td> <b> Author</b></td>
                    <td> <b> Category</b></td>
                </tr>
                <?php
                if ($sports == 1) {
                    $category = 'sports';
                    $sql = "SELECT `title`, `username`, `category` FROM `newstable` WHERE `category` = '$category'";
                    $articles = mysqli_query($conn, $sql);
                    $articlesArray = mysqli_fetch_all($articles, MYSQLI_ASSOC);
                    foreach ($articlesArray as $row) {
                        echo '<tr><td> <a href="readArticle.php?article=', $row['title'], '">', $row['title'], "</a></td><td>", $row['username'], "</td><td>", $row['category'], "</td></tr>";
                    }
                }
                if ($business == 1) {
                    $category = 'business';
                    $sql = "SELECT `title`, `username`, `category` FROM `newstable` WHERE `category` = '$category'";
                    $articles = mysqli_query($conn, $sql);
                    $articlesArray = mysqli_fetch_all($articles, MYSQLI_ASSOC);
                    foreach ($articlesArray as $row) {
                        echo '<tr><td> <a href="readArticle.php?article=', $row['title'], '">', $row['title'], "</a></td><td>", $row['username'], "</td><td>", $row['category'], "</td></tr>";
                    }
                }
                if ($technology == 1) {
                    $category = 'technology';
                    $sql = "SELECT `title`, `username`, `category` FROM `newstable` WHERE `category` = '$category'";
                    $articles = mysqli_query($conn, $sql);
                    $articlesArray = mysqli_fetch_all($articles, MYSQLI_ASSOC);
                    foreach ($articlesArray as $row) {
                        echo '<tr><td> <a href="readArticle.php?article=', $row['title'], '">', $row['title'], "</a></td><td>", $row['username'], "</td><td>", $row['category'], "</td></tr>";
                    }
                }
                if ($politics == 1) {
                    $category = 'politics';
                    $sql = "SELECT `title`, `username`, `category` FROM `newstable` WHERE `category` = '$category'";
                    $articles = mysqli_query($conn, $sql);
                    $articlesArray = mysqli_fetch_all($articles, MYSQLI_ASSOC);
                    foreach ($articlesArray as $row) {
                        echo '<tr><td> <a href="readArticle.php?article=', $row['title'], '">', $row['title'], "</a></td><td>", $row['username'], "</td><td>", $row['category'], "</td></tr>";
                    }
                }
                ?>
            </table>
        <?php
        }
        ?>
    </div>
</body>

</html>