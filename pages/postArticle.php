<?php
session_start();
$username = $_SESSION['username'];
$type = $_SESSION['type'];
$user = 'root';
$pass = '';
$db = 'newsApp';
$dbSub = 'newstable';  // news table name

// below variables come from form post
$conn =  mysqli_connect('localhost', $user, $pass, $db);
$articleTitle = $_POST['articleTitle'];
$articleCategory = $_POST['articleCategory'];
$author = $_POST['author'];
$status = $_POST['status'];
$articleBody = $_POST['articleBody'];

// sql query
$sql = "INSERT INTO `$dbSub` (`title`, `category`, `username`, `status`, `content`) VALUES ('$articleTitle','$articleCategory','$author','$status','$articleBody')";
// add to db and check
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    // go to homepage
    header("Location: home.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
