<?php
// Logout script
    session_start();
    session_destroy();
    echo "Logged out successfully";
    header('location:\index.php?include=home');
?>