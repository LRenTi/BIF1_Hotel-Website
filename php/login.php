<!DOCTYPE html>
<html>
    <body>
        <?php
        session_start();

        if(isset($_POST["username"]) && isset($_POST["password"]))
        {
            if($_POST["username"] == $_POST["password"])
            {
                // Login erfolgreich
                $_SESSION["usernameSession"] = $_POST["username"];
                header("Refresh:0");
            } 
            else 
            {
                // Login nicht erfolgreich
                echo "Schleich dich!";
            }
        }
        header('Location: \index.php?include=home');

        ?>
    </body>
</html>