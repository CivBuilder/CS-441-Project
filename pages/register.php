<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>
   
    <?php
    // print out registration error if there is one
    if (isset($_GET['regErr'])) {
        echo '<p style="color: red;">',$_GET['regErr'],'</p>';
    }
    ?>

    <h1>Register here</h1>

    <form action="registerfunct.php" method="post">
        Username: <input type="text" name="username" id=""><br>
        Password: <input type="password" name="password" id=""><br>
        <input type="submit" value="Register">
    </form>
    
    <br>
    <a href="index.php">Click to Login</a>
    <br>
    <a href="changePassword.php">Click to Change Password</a>
</body>
</html>