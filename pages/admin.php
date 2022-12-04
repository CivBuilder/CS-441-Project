<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Admin Portal</title>
</head>

<body>
    <div class="mainContainer">
        <?php
    
        // get table of users
        $user  = 'root';                // server username
        $pass  = '';                    // server password
        $db    = 'newsApp';             // database name

        // connect to db
        $conn = mysqli_connect('localhost', $user, $pass, $db);

        // check connection
        if (!$conn) {
            echo 'Connection failed' . mysqli_connect_error();
        }



        session_start();
        if (!isset($_SESSION['username'])) {
            header("Location:index.php");
        }

        $type = $_SESSION['type'];
        // $_SESSION['type'] = "admin";    // debug, manually set to admin :)
        $disabled = 'disabled';
        if (isset($_SESSION['type']) && $type !== "user") {
            if ($_SESSION['type'] == "admin") {
                $disabled = '';
            }
        }

        // print out changes messages
        if (isset($_GET['changes'])) {
            echo '<p style="color: red;">', $_GET['changes'], '</p>';
        }

        ?>
        <h1 class="title">Admin Portal</h1>
        <?php if ($type === "user") {
            echo "<h2 id='userError' style='text-align:center'>Oops you don't belong here...</h2>";
        } else {
        ?>
            <div class="subContainer">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Manage Users</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Manage Articles</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">


                    <!-- MANAGE USERS -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">User ID</th>
                                <th scope="col">Username</th>
                                <th scope="col">User Type</th>
                                <?php
                                if ($_SESSION['type'] == "admin") {
                                echo
                                '<th scope="col">Remove User</th>';
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php
                            $sql = "SELECT * FROM `usertable` ORDER BY `usertable`.`type` ASC";
                            $sqlResult = mysqli_query($conn, $sql);
                            $allUsers = mysqli_fetch_all($sqlResult);

                                foreach ($allUsers as $row) {
                                    echo "<tr><td>", $row[3], "</td>";             // print user ID
                                    echo "<td>", $row[0], "</td>";      // print user name

                                    // print user type
                                    if ($row[2] == "user") {                // user type is set
                                        echo
                                        '<td>
                    <form method="post">
                        <select ', $disabled, ' name="userTypeName', $row[3], '" onchange="this.form.submit();">
                            <option value="user">user</option>
                            <option value="mod">mod</option>
                        </select>
                    </form>
                    </td>';
                                    } else if ($row[2] == "mod") {      // mod type is set
                                        echo
                                        '<td> 
                    <form name="typeForm" method="post">
                        <select ', $disabled, ' name="userTypeName', $row[3], '" onchange="this.form.submit();">
                            <option value="mod">mod</option>
                            <option value="user">user</option>
                        </select> 
                    </form>
                    </td>';
                                } else if ($row[2] == "admin") {      // admin type is set
                                    echo
                                    '<td>
                    <select disabled name="userTypeName', $row[3], '">
                        <option value="admin">admin</option>
                    </select>
                    </td>';
                                    }


                                if ($row[2] != "admin" && $_SESSION['type'] == "admin") {       // can only remove non-admin
                                    echo '<td>
                <form method="post" class = "button">
                    <input type="submit" onclick="return confirm(',"'Are you sure you want to Remove this user?'",')" name="deleteUser', $row[3], '" value="Remove">
                </form></td>';        // press to delete
                                    }
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php

                        // make any changes to user types
                        foreach ($allUsers as $row) {
                            if (isset($_POST["userTypeName$row[3]"])) {     // change user type
                                $newType = $_POST["userTypeName$row[3]"];
                                $sql = "UPDATE `usertable` SET `type`='$newType' WHERE `id` = $row[3]";
                                mysqli_query($conn, $sql);
                                echo "<meta http-equiv='refresh' content='0'>"; // reload the page
                            }

                            if (isset($_POST["deleteUser$row[3]"])) {       // delete user
                                $sql = "DELETE FROM `usertable` WHERE `id` = $row[3]";
                                mysqli_query($conn, $sql);
                                echo "<meta http-equiv='refresh' content='0'>"; // reload the page 
                            }
                        }
                        ?>
                    </div>
                    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                        <!-- MANAGE ARTICLES -->

                        <!-- to do:
                    add functions to change status and delete articles 
                    add for loop to check -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Article ID</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Decline / Remove</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">

                                <?php

                                $disabled = '';

                                $sql = "SELECT `title`,`category`,`username`,`status`,`id` FROM `newstable` ORDER BY `newstable`.`id` DESC";
                                $sqlResult = mysqli_query($conn, $sql);
                                $allArticles = mysqli_fetch_all($sqlResult);

                                foreach ($allArticles as $row) {
                                    echo "<tr><td>", $row[4], "</td>";   // print article ID
                                    echo "<td>", $row[0], "</td>";       // title
                                    echo "<td>", $row[2], "</td>";       // author
                                    echo "<td>", $row[1], "</td>";       // category
                                    $deleteButton = "Remove";

                                    // print user type
                                    if ($row[3] == "pending") {                // pending article
                                        echo
                                        '<td>
                    <form method="post">
                        <select ', $disabled, ' name="statusName', $row[4], '" onchange="this.form.submit();">
                            <option value="pending">pending</option>
                            <option value="approved">approved</option>
                        </select>
                    </form>
                    </td>';
                                        $deleteButton = "Decline";
                                    } else {                                // approved article
                                        echo
                                        '<td> 
                    <form name="typeForm" method="post">
                        <select disabled name="statusName', $row[4], '" onchange="this.form.submit();">
                            <option value="approved">approved</option>
                        </select> 
                    </form>
                    </td>';
                                    }

                                    // press to decline
                                    echo '<td>                           
                <form method="post" class ="remove">
                    <input type="submit" onclick="return confirm(',"'Are you sure you want to Remove this Article?'",')" name="deleteArticle', $row[4], '" value="', $deleteButton, '">
                </form></td>';
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        


                        <?php
                        // approve or delete articles
                        foreach ($allArticles as $row) {
                            if (isset($_POST["statusName$row[4]"])) {     // approve article
                                $sql = "UPDATE `newstable` SET `status`='approved' WHERE `id` = $row[4]";
                                mysqli_query($conn, $sql);
                                echo "<meta http-equiv='refresh' content='0'>"; // reload the page
                            }

                            if (isset($_POST["deleteArticle$row[4]"])) {       // decline or remove article
                                $sql = "DELETE FROM `newstable` WHERE `id` = $row[4]";
                                mysqli_query($conn, $sql);
                                echo "<meta http-equiv='refresh' content='0'>"; // reload the page 
                            }
                        }
                        ?>
                    </div>
                </div>


            </div>
        <?php } ?>
        <form action="home.php" class="homeBtn">
            <center><input type="submit" value="Homepage"></center>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>