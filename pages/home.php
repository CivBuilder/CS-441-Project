<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Shallot</title>
    <link rel="stylesheet" href="homeStyle.css">
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
    <div class="mainContainer">
        <form action="logout.php" class="log">
            <div class="logout">
                <div class="button">
                    <input type="submit" value="Logout">
                </div>
            </div>
        </form>
        <form action="admin.php" class="admin">
            <div class="portal">
                <div class="button">
                    <input type="submit" value="Admin Portal">
                </div>
            </div>
        </form>
        <div style='text-align:center' class="logo">
            <img src="./photos/logoShallot.png" alt="">
            <hr>
            <?php echo "<h2> Welcome $username! </h2>"; ?>

            <form action="searchContent.php" method="post" class="search">
                Search for
                <!-- condiitonal render for "by name" on dropdown -->
                <script>
                    function render_search() {
                        let value = document.getElementById("searchType").value;

                        if (value === "article") {
                            let byName = document.getElementById("byName");
                            let searchBar = document.getElementById("searchBar");
                            byName.innerHTML = "by name: ";
                            searchBar.style.display = "inline";
                        } else {
                            let byName = document.getElementById("byName");
                            let searchBar = document.getElementById("searchBar");
                            byName.innerHTML = "to subscribe to: ";
                            searchBar.style.display = "none";
                        }

                    }
                </script>
                <select name="searchType" id="searchType" onchange="render_search()">
                    <option value="category">Categories</option>
                    <option value="article">Article</option>
                </select>
                <!-- element for search type -->
                <p id="byName" style="display:inline">to subscribe to </p>
                <!-- search bar if searching by article -->
                <span class="textBox" id="searchBar" style="display:none">
                    <input type="text" name="searchContent">
                </span>
                <span class="textBtn">
                    <input type="submit" value="Search">
                </span>
            </form>
        </div>

        <div class="dash">
            <center>
                <h3>Dashboard</h3>
            </center>
            <form action="submitArticle.php" class="art">
                <center><input type="submit" value="Submit Article"></center>
            </form>
        </div>

        <div class="newsfeed">
            <center>
                <h1>Newsfeed</h1>
            </center>
            <?php
            if ($sports == 0 && $business == 0 && $technology == 0 && $politics == 0) {
                echo "<h2 style='text-align:center'>You don't have any subscriptions yet, search for categories and subscribe to your interests</h2>";
            } else {
            ?>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Article Name</th>
                    <th scope="col">Author</th>
                    <th scope="col">Category</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
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
            </tbody>
        </table>
    <?php
            }
    ?>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>