<?php

// php file that logs users in from index page

// echo "username: $_POST[username] , password: $_POST[password] ";
// connect to db
$user = 'root';
$pass = '';
$db = 'newsApp';

$conn =  mysqli_connect('localhost', $user, $pass, $db);

// check connection
if (!$conn) {
	echo 'Connection failed' . mysqli_connect_error();
}

header("Location: admin.php?msg= Changes Saved!");
// // get data
// // create query
// $sql =  "Select * from usertable  where username = '$_POST[username]' AND password = '$_POST[password]' ";
// $result = mysqli_query($conn, $sql);

// // fetch  the rows as an array
// $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

// //print_r($users);
// if(sizeof($users)==1){

//     // get the user's type and username
//     $userType = $users[0]['type'];
//     $userName = $users[0]['username'];

//     // set the session
//     session_start();
//     $_SESSION['username'] = $userName;
//     $_SESSION['type'] = $userType;

//     echo $userName;

//     header("Location: home.php");

// }else{
//     echo'User was not found!';
//     header("Location: index.php?err= Check Username/Password");

// }

?>