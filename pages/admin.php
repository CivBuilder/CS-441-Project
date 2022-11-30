<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminStyle.css">
    <title>Admin Portal</title>
</head>
<body>
    <h1>Admin Portal</h1>
    <button>Manage Users (WIP)</button>
    <button>Manage Articles (WIP)</button>
    <br>
    <a href="home.html">Click to go to homepage</a>

    <br><br><br>
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

    $sql = "SELECT * FROM `usertable` ORDER BY `usertable`.`type` ASC";
    $sqlResult = mysqli_query($conn, $sql);
    $allUsers = mysqli_fetch_all($sqlResult);
    $disabled = 'disabled';
    
    session_start();
    $_SESSION['type'] = "admin";    // debug, manually set to admin :)
    
    if ($_SESSION['type'] == "admin") {
        $disabled = '';
    }
    // print out changes messages
    if (isset($_GET['changes'])) {
        echo '<p style="color: red;">',$_GET['changes'],'</p>';
    }
    
    ?>

    <table>
    <caption>Manage Users</caption>
    <th>User ID</th>
    <th>Username</th>
    <th>User Type</th>
    <th>Delete User</th>
    <?php
    foreach($allUsers as $row) {
        echo "<tr><td>", $row[3], "</td>";             // print user ID
        echo "<td>", $row[0], "</td>";      // print user name

        // print user type
        if ($row[2] == "user") {                // user type is set
            echo 
            '<td>
            <form method="post">
                <select ',$disabled,' name="userTypeName',$row[3],'" onchange="this.form.submit();">
                    <option value="user">user</option>
                    <option value="mod">mod</option>
                </select>
            </form>
            </td>';

            } else if ($row[2] == "mod") {      // mod type is set
                echo 
                '<td> 
                <form name="typeForm" method="post">
                    <select ',$disabled,' name="userTypeName',$row[3],'" onchange="this.form.submit();">
                        <option value="mod">mod</option>
                        <option value="user">user</option>
                    </select> 
                </form>
                </td>';
            } else if ($row[2] == "admin") {      // onl type is set
                echo 
                '<td>
                <select disabled name="userTypeName',$row[3],'">
                    <option value="admin">admin</option>
                </select>
                </td>';
            }
        if ($row[2] != "admin") {       // can only remove non-admin
        echo '<td>
        <form method="post">
            <input type="submit" name="deleteUser',$row[3],'" value="Remove">
        </form></td></tr>';        // press to delete
        }
    }
    ?>
    </table>
    <?php

    // make any changes to user types
    foreach($allUsers as $row) {
        if (isset($_POST["userTypeName$row[3]"])) {     // change user type
            // echo "typeform set";
            sleep(2);
            $newType = $_POST["userTypeName$row[3]"];
            $sql = "UPDATE `usertable` SET `type`='$newType' WHERE `id` = $row[3]";
            mysqli_query($conn, $sql);            
            echo "<meta http-equiv='refresh' content='0'>"; // reload the page
        } 

        if (isset($_POST["deleteUser$row[3]"])) {       // delete user
            // echo "User Removed: ", $row[1];
            $sql = "DELETE FROM `usertable` WHERE `id` = $row[3]";
            mysqli_query($conn, $sql);
            // header("Location: admin.php?changes=User Removed: $row[0]" );
            echo "<meta http-equiv='refresh' content='0'>";// reload the page
               
        }   
    }
    ?>

</body>
</html>