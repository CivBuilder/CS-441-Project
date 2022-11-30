<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Shallot</title>
</head>
<body>

    <h1>The Shallot</h1>
    <h2>Fake News Only</h2>
    <a href="index.php">Click to login</a>
    <br>
    <button>Admin Portal</button>
    <a href="admin.php">Click to go to admin portal (WIP)</a>
    
    <br><br>
    <?php
    session_start();

    echo  "Username: ";
    echo $_SESSION['username'];
    
    ?>
    <hr>
</body>
</html>