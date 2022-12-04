<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="changePass.css">
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div class='mainContainer'>
        <h1 class='change'>Change Password</h1>

        <form action="changePasswordfunct.php" method="post" class ='user'>
            <div class ="userChange">
                <div class="text"> 
                    <h3>Username</h3>
                </div>
                <div class="input">
                    <center><input type="text" name="username" id="" placeholder="Enter Username..."></center>
                </div>
            </div>
            <div class ="userOld">
                <div class="text"> 
                    <h3>Old Password</h3>
                </div>
                <div class="input">
                <center><input type="password" name="password" id="" placeholder="Enter Old Password..."></center>
                </div>
            </div>
            <div class ="userNew">
                <div class="text"> 
                    <h3>New Password</h3>
                </div>
                <div class="input">
                <center><input type="password" name="newPassword" id="" placeholder="Enter New Password..."></center>
                </div>
            </div>

            <div class="btn">
                <center><input type="submit" value="Change Password"></center>
            </div>
            
        </form>
        <form action="index.php" class = "button">
            <div class="btn">
                <center><input type="submit" value="Back to Login"></center>
            </div>
        </form>
        <?php
            if(isset($_GET['msg'])){
                echo '<p style="color: red;" class ="p1">',$_GET['msg'],'</p>';
            }
        ?>
    </div>
    
   
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>