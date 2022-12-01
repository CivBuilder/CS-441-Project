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

    // below variables come from form post
    $conn =  mysqli_connect('localhost', $user, $pass, $db);
    $searchType = $_POST['searchType'];
    $searchContent = $_POST['searchContent'];

    // if searching for article and textbox had content
    if (isset($_POST['searchContent'])) {
        $title = $_POST['searchContent'];
    }


    ?>
    <!-- header -->
    <div style='text-align:center'>
        <h1>The Shallot</h1>
        <h2>Fake News Only</h2>
        <hr>
        <h1>Search Results</h2>
    </div>
    <?php
    if ($searchType == 'category') {
    ?>
        <h2>Subscribe to Categories:</h2>
        <form action="subscribe.php" method="post">
            <input type="checkbox" id="sports" name="sportsCategory" value="sports">
            <label for="sports"> Sports</label><br>
            <input type="checkbox" id="business" name="businessCategory" value="business">
            <label for="business"> Business</label><br>
            <input type="checkbox" id="technology" name="technologyCategory" value="technology">
            <label for="technology"> Technology</label><br>
            <input type="checkbox" id="politics" name="politicsCategory" value="politics">
            <label for="politics"> Politics</label><br><br>
            <input type="submit" value="Subscribe">
        </form>
        <?php
    }
    // searching for articles
    else {
        // get articles
        $sql = "SELECT `title`, `username`, `category` FROM `newstable` WHERE `title` LIKE '%$title%'";
        $articles = mysqli_query($conn, $sql);
        $articlesArray = mysqli_fetch_all($articles, MYSQLI_ASSOC);
        if (empty($articlesArray)) {
            echo "<h2>No articles found that match search term.</h2>";
        } else {
        ?>
            <table>
                <tr>
                    <td> <b> Article Name</b></td>
                    <td> <b> Author</b></td>
                    <td> <b> Category</b></td>
                </tr>
            <?php
            foreach ($articlesArray as $row) {
                echo '<tr><td> <a href="readArticle.php?article=', $row['title'],'">' , $row['title'],"</a></td><td>", $row['username'], "</td><td>", $row['category'], "</td></tr>";
            }
        }
            ?>
            </table>
        <?php

    }

        ?>
</body>

</html>