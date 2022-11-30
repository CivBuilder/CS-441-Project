<!--
This file is linked from the register.php page
When a user registers, it goes to the page and executes the code below
if successful registration, send to home.php
creates a 'user' type
-->
<?php

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

// error in username - send back to registration page with error
invalidUsername($username);
duplicateUsername($username, $conn);
invalidPassword($password);

// successfully passed all tests, insert into database
$sql = "INSERT INTO `$dbSub`(`username`, `password`, `type`) VALUES ('$username', '$password', 'user')";

// set username and type for session
if($conn->query($sql)){
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['type'] = 'user';
    header("location:$successLink");
}else{
    echo $conn->error;
}

// check if password is at least 3 characters
function invalidPassword($passwordArg) {
    if (!preg_match('/.{3,}/', $passwordArg)) {
        header("Location: register.php?regErr=  Password must be at least 3 characters.");
        exit();
    }
}

// check if there are duplicate names or if name is allowed (regex)
function invalidUsername($usernameArg) {
    if (!preg_match('/^[a-zA-Z0-9_](?=.*[a-zA-Z])[a-zA-Z0-9_]{3,14}$/', $usernameArg)) {
        header("Location: register.php?regErr= Username must be between 4 and 15 characters, have at least 1 letter and can only consist of letters, numbers and underscores.");
        exit();
    }
}

// check for duplicate username
function duplicateUsername($usernameArg, $conn) {
    $exists = "SELECT * FROM `usertable` WHERE `username` = '$usernameArg'";
    $num = $conn->query($exists);
    if ($num->num_rows == 1) {
        header("Location: register.php?regErr= Username is already taken.");
        exit();
    }
}

?>