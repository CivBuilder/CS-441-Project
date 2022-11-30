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

    ?>

    <table>
    <th>User ID</th>
    <th>Username</th>
    <th>User Type</th>
    <th>Delete User</th>
    <?php
    foreach($allUsers as $row) {
        echo "<tr><td>", $row[3], "</td>";             // print user ID
        echo "<td>", $row[0], "</td>";      // print user name

        // print user type
        if ($row[2] == "user") {     // user type is set
            echo 
            '<td> <select ',$disabled,' name="userTypeName" id="type"',$row[3],'>
                <option value="userVal">user</option>
                <option value="modVal">mod</option>
            </select> </td>';
            } else if ($row[2] == "mod") {      // mod type is set
                echo 
                '<td> <select ',$disabled,' name="userTypeName" id="type"',$row[3],'>
                    <option value="modVal">mod</option>
                    <option value="userVal">user</option>
                </select> </td>';
            } else if ($row[2] == "admin") {      // mod type is set
                echo 
                '<td> <select disabled name="userTypeName" id="type"',$row[3],'>
                    <option value="adminVal">admin</option>
                </select> </td>';
            }
    
        echo '<td><input type="checkbox" id=user',$row[3],'></td></tr>';        // selection box for delete
    }
    ?>
    </table>

    <!-- save changes button -->
    <form action="adminSaveFunct.php">
        <input type="submit" value="Submit Changes" />
    </form>
    
    <?php
    if (isset($_GET['msg'])) {
        echo '<p style="color: red;">',$_GET['msg'],'</p>';
    }
    ?>

</body>
</html>