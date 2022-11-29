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
    session_start();                                // start session
    if (isset($_SESSION['regErr'])) {
        switch($_SESSION['regErr']) {
            case "password":
                echo 'Password must be at least 3 characters long';
                break;
            case "duplicate":
                echo 'Username is already taken';

                break;
            case "invalid";
                echo 'Username must be between 4 and 15 characters, have at least 1 letter and can only consist of letters, numbers and underscores.';
        }
        session_destroy();                          // end session
    } else {
        echo 'lets go';
        
    }
    ?>

    <h1>Register here</h1>

    <form action="userReg.php" method="post">
        Username: <input type="text" name="username" id=""><br>
        Password: <input type="password" name="password" id=""><br>
        <input type="submit" value="Register">
    </form>
    
    <br>
    <!-- Clicking register will send user to home page -->
    <a href="home.php">Click to go to homepage</a>
</body>
</html>