<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="searchContentStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>The Shallot</title>
</head>

<body>
    <div class="mainContainer">

        <div class="image">
            <center><img src="./photos/logoShallot.png" alt=""></center>
        </div>
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
        <div class ="categories">
            <?php
            if ($searchType == 'category') {
            ?>
                <h2>Subscribe to Categories:</h2>
                <form action="subscribe.php" method="post" class="switch">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="sports" name="sportsCategory" value="sports">
                        <label class="form-check-label" for="sports">Sports</label>
                        
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="business" name="businessCategory" value="business">
                        <label class="form-check-label" for="business">Business</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="technology" name="technologyCategory" value="technology">
                        <label class="form-check-label" for="technology">Technology</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="politics" name="politicsCategory" value="politics">
                        <label class="form-check-label" for="politics">Politics</label>
                    </div>
                    <div class="subButton">
                        <center><input type="submit" value="Subscribe"></center>
                    </div>
                   
                </form>
        </div>
        <form action="home.php" class ="et">
            <div class = "home">
                <center><input type="submit" value="E.T. Phone Home"></center>
            </div>
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
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Article Name</th>
                    <th scope="col">Author</th>
                    <th scope="col">Category</th>
                    </tr>
                </thead>
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
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>