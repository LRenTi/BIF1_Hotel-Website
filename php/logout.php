<!DOCTYPE html>
<html>
<body>
 
<?php
    session_start();
    session_destroy();
    echo "Logged out successfully";
    header('location:\index.php?include=home');
?>
 
</body>
</html>