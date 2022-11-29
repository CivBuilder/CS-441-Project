<!--
This file is linked from the register.php page
When a user registers, it goes to the page and executes the code below
if successful registration, send to home.php
creates a 'user' type
-->
<?php
session_start();        // access session array for username information
$user  = 'root';                // server username
$pass  = '';                    // server password
$db    = 'newsApp';             // database name
$dbSub = 'usertable';           // username table name
$successLink = 'home.php';      // send to this page if successful
$failLink = 'register.php';     // send back to register page if fail

echo $conn->error;

// connect to db
$conn = mysqli_connect('localhost', $user, $pass, $db);

$username = $_POST['username'];
$password = $_POST['password'];

// check if there are duplicate names or if name is allowed (regex)
function invalidUsername($usernameArg) {

    // regex 
    if (!preg_match('/^[a-zA-Z0-9_](?=.*[a-zA-Z])[a-zA-Z0-9_]{3,14}$/', $usernameArg)) {
        $_SESSION['usernameErr'] = "invalid";
        return true;
    }
    return false;
}

function duplicateUsername($usernameArg, $conn) {
    $exists = "SELECT * FROM `usertable` WHERE `username` = '$usernameArg'";
    $num = $conn->query($exists);
    if ($num->num_rows == 1) {
        $_SESSION['usernameErr'] = "duplicate";
        return true;
    }
    return false;       // no duplicate found
}

// error in username - send back to registration page with error
if (invalidUsername($username) || duplicateUsername($username, $conn)) {
    header("location:$failLink");
    exit();
}

$sql = "INSERT INTO `$dbSub`(`username`, `password`, `type`) VALUES ('$username', '$password', 'user')";

// successful, set username and type. 
if($conn->query($sql)){
    // session_start();
    $_SESSION['username'] = $username;
    $_SESSION['userType'] = 'user';
    header("location:$successLink");
}else{
    echo $conn->error;
}

?>