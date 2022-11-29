<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
</head>
<body>

    <form action="changePasswordfunct.php" method="post">
        Username: <input type="text" name="username" id=""><br>
        Old Password: <input type="password" name="password" id=""><br>
        New Password: <input type="password" name="newPassword" id=""><br>
        <input type="submit" value="Change Password">
    </form>

    <a href="index.php">Click to return to Login Page</a>
    <br>

</body>
</html>