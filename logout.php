<?php
    session_start();
    session_unset();
    session_destroy();
    header("location:http://localhost/OnlineBidding/index.php?msg="."Successfully logged out");
?>