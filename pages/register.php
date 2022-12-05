<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Shallot</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
</head>

<body>
    <div class="mainContainer">
        <h1 class="login">Registration</h1>


        <form action="userReg.php" method="post" class="user">
            <div class="searchUser">
                <div class="text">
                    <h3>Username</h3>
                </div>
                <div class="input">
                    <center><input type="text" name="username" id="" placeholder="Enter Username..."></center>
                </div>
            </div>
            <div class="searchPassword">
                <div class="text">
                    <h3>Password</h3>
                </div>
                <div class="input">
                    <center><input type="password" name="password" id="" class="searchPassword" placeholder="Enter Password..."></center>
                </div>
            </div>
            <div class="button">
                <center><input type="submit" value="Register"></center>
            </div>
        </form>

        <div class="button2">
            <form action="login.php">
                <center><input type="submit" value="Login"></center>
            </form>
        </div>

        <div class="button2">
            <form action="changePassword.php">
                <center><input type="submit" value="Change Password"></center>
            </form>
        </div>
        <?php
        // if error checking username and password
        if (isset($_GET['err'])) {
            echo '<p style="color: red;">', $_GET['err'], '</p>';
        }
        ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>