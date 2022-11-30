<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="registerStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>

    <?php
    session_start();                                // start session
    if (isset($_SESSION['regErr'])) {
        switch($_SESSION['regErr']) {
            case "password":
                echo "Password must be at least 3 characters";
                break;
            case "duplicate":
                echo 'Username is already taken';

                break;
            case "invalid";
                echo 'Username must be between 4 and 15 characters, have at least 1 letter and can only consist of letters, numbers and underscores.';
        }
        session_destroy();                          // end session
    } else {
        echo '<p class="p1">lets go</p>';
        
    }
    ?>
    <div class='mainContainer'>
        <h1 class = "register">Register</h1>

        <form action="userReg.php" method="post" class='user'>
            <div class ="registerUser">
                <div class="text"> 
                    <h3>Username</h3>
                </div>
                <div class="input">
                    <center><input type="text" name="username" id="" placeholder="Enter Username..."></center>
                </div>
            </div>
            <div class ="registerPass">
                <div class="text"> 
                    <h3>Password</h3>
                </div>
                <div class="input">
                    <center><input type="password" name="password" id="" placeholder="Enter Password..."></center>
                </div>
            </div>
           
            <div class="button">
                <center><input type="submit" value="Register"></center>
            </div>
           
        </form>

        <br>
        <!-- Clicking register will send user to home page -->
        <a href="home.php">Click to go to homepage</a>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>