<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Shallot</title>
    <link rel="stylesheet" href="submitArticleStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <?php
    session_start();
    $username = $_SESSION['username'];
    $type = $_SESSION['type'];
    $user = 'root';
    $pass = '';
    $db = 'newsApp';

    // set status of article
    if ($type == 'user') {
        $status = 'pending';
    } else {
        $status = 'approved';
    }

    // rename user to author for readability
    $author = $username;

    // connect to db
    $conn =  mysqli_connect('localhost', $user, $pass, $db);

    // check connection
    if (!$conn) {
        echo 'Connection failed' . mysqli_connect_error();
    }
    ?>
    <!-- header -->
    <div class="mainContainer">

        <div class="logo">
            <center><img src="photos/logoShallot.png" alt=""></center>
        </div>
        <hr>
        <form action="postArticle.php" method="post" class="article">

            <a href="home.php">
                <button id="cancelButton">Country Roads...</button>
            </a>

            <div class="text">
                <center>
                    <h4>Title*</h4>
                </center>
            </div>
            <div class="input">
                <center><input type="text" name="articleTitle" placeholder="You have to put something"></center>
            </div>

            <div class="textCat">
                <Center>
                    <h4>Category*</h4>
                </Center>
            </div>
            <center>

                <input type="radio" id="sports" name="articleCategory" value="sports">
                <label for="sports">Sports</label>

                <input type="radio" id="business" name="articleCategory" value="business">
                <label for="business" style="max-width: 100px;">Business</label>

                <input type="radio" id="technology" name="articleCategory" value="technology">
                <label for="technology">Technology</label>

                <input type="radio" id="politics" name="articleCategory" value="politics">
                <label for="politics">Politics</label>
            </center>
            <div class="form-group">
                <div class="text">
                    <center>
                        <h4>Write Article*</h4>
                    </center>
                </div>
                <center><textarea name="articleBody" class="form-control" rows="7" style="max-width: 700px;" placeholder="What did Elon do this time?"></textarea></center>
                <input type='hidden' name='author' value='<?php echo $author ?>'>
                <input type='hidden' name='status' value='<?php echo $status ?>'>
            </div>
            <div class="button">
                <center><input type="submit" value="Submit Article"></center>
            </div>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>