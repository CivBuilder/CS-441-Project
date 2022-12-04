<?php

// php file that logs users in from index page

echo "username: $_POST[username] , password: $_POST[password] ";
// connect to db
$user = 'root';
$pass = '';
$db = 'newsApp';

$conn =  mysqli_connect('localhost', $user, $pass, $db);

$username = $_POST['username'];
$password = $_POST['password'];
$newPassword = $_POST['newPassword'];

// check connection
if (!$conn) {
	echo 'Connection failed' . mysqli_connect_error();
}
// get data
// create query
$sql =  "Select * from usertable  where username = '$username' AND password = '$password'";
$result = mysqli_query($conn, $sql);

// fetch  the rows as an array
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

if(sizeof($users)==1){      // username and password is validated

    // check if new password is valid
    invalidPassword($newPassword);

    // successful password if passed validation
    $sql = "UPDATE `usertable` SET `password`='$newPassword' WHERE `username` = '$username'";
    mysqli_query($conn, $sql);
    
    header("Location: changePassword.php?msg= Password change successful!");

}else{      // username and password invalid
    $size = sizeof($users);
    header("Location: changePassword.php?msg= Check Username/Password");
}

// check if password is at least 3 characters
function invalidPassword($passwordArg) {
    if (!preg_match('/.{3,}/', $passwordArg)) {
        header("Location: changePassword.php?msg=  Password must be at least 3 characters.");
        exit();
    }
}
?>