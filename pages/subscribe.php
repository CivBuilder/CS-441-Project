<?php
session_start();
$username = $_SESSION['username'];
$type = $_SESSION['type'];
$user = 'root';
$pass = '';
$db = 'newsApp';

// below variables come from form post
$conn =  mysqli_connect('localhost', $user, $pass, $db);

// logic handling for checkbox
if(isset($_POST['sportsCategory'])) {
    $sports = 1;
}
else {
    $sports = 0;
}
if(isset($_POST['businessCategory'])) {
    $business = 1;
}
else {
    $business = 0;
}
if(isset($_POST['technologyCategory'])) {
    $technology = 1;
}
else {
    $technology = 0;
}
if(isset($_POST['politicsCategory'])) {
    $politics = 1;
}
else {
    $politics = 0;
}

// sql query
$sql = "UPDATE usertable SET `sports`=$sports, `business`=$business, `technology`=$technology, `politics`=$politics WHERE username='$username'";
// add to db and check
if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
    // go to homepage
    header("Location: home.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
