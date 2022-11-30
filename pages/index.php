<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
</head>
<body>
    <div class="mainContainer">
        <h1 class="login">Login</h1>


        <form action="login.php" method="post" class="user">
            <div class="searchUser">
                <div class="text">
                    <h3>Username</h3>
                </div>
                <div class ="input">
                    <center><input type="text" name="username" id="" placeholder="Enter Username..."></center>
                </div>
            </div>
            <div class="searchPassword">
                <div class="text" >
                    <h3>Password</h3>
                </div>
                <div class ="input">
                    <center><input type="password" name="password" id="" class="searchPassword" placeholder="Enter Password..."></center>
                </div>
            </div>
                <!--<input type="submit" value="Login">-->
            <div class="button">
                <center><input type="submit" value="Login"></center>
            </div>
        </form>

        <?php

    // if error checking username and password
    if(isset($_GET['err'])){
        echo '<p style="color: red;">',$_GET['err'],'</p>';
    }
    ?>
    <br>
    <a href="register.php">Click to Register</a>
    <br> 
    <a href="changePassword.php">Click to Change Password</a>
        // if error checking username and password
        if(isset($_GET['err'])){
            echo '<p style="color: red;">',$_GET['err'],'</p>';
        }
        ?>
        <div class="button2">
            <form action="register.php">
                <center><input type="submit" value="Register" ></center>
            </form>
               
                <!--<button class="btn btn-primary" type="button" href="register.php">Register</button>-->
            </div>
        <!--<a href="register.php" class = "register">Click to Register</a>-->
        <br>
            
        <br>
        <a href="home.php" class= "home">Click to go to homepage</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>