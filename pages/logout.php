<?php
    session_start();
    session_destroy();
    header("Location: loggedOut.php?err=Logged Out!");

?>