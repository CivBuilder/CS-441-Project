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

    // set status of article
    if ($type == 'user') {
        $status = 'pending';
    }
    else {
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
    <div style='text-align:center'>
        <h1>The Shallot</h1>
        <h2>Fake News Only</h2>
        <hr>
        <h2>Submit an Article to The Shallot</h2>
    </div>

    <!-- form, get info on article from user -->
    <form action="postArticle.php" method="post">
        Title: <input type="text" name="articleTitle" id=""><br>
        Category:<br>
            <input type="radio" id="sports" name="articleCategory" value="sports">
            <label for="sports">Sports</label><br>
            <input type="radio" id="business" name="articleCategory" value="business">
            <label for="business">Business</label><br>
            <input type="radio" id="technology" name="articleCategory" value="technology">
            <label for="technology">Technology</label><br>
            <input type="radio" id="politics" name="articleCategory" value="politics">
            <label for="politics">Politics</label><br>
        <br>
        Body: <input type="text" name="articleBody" id=""><br><br>
        <input type='hidden' name='author' value='<?php echo $author?>'>
        <input type='hidden' name='status' value='<?php echo $status?>'>
        <!-- submit to db -->
        <input type="submit" value="Submit Article">
    </form>
</body>

</html>