<!DOCTYPE html>

<html>
    <head>
        <title>Log in - LA Hotel</title>
    </head>

    <body>
        <div class="container">
            <div class="d-flex justify-content-center">
                <div>
                    <h1 class="font-weight-bold mt-3">Log in</h1>
                    <form style="width: 20rem;" action="" method="post">
                        <label><b>Benutzername:</b></label>
                        <input type="text" class="form-control" placeholder="Benutzername" id="username" name="username" value="<?php if (isset($_POST["username"])) echo $_POST["username"]; ?>" required>

                        <label><b>Passwort:</b></label>
                        <input type="password" class="form-control" placeholder="Passwort" id="password" name="password" required>
                    
                        <button type="submit" class="btn btn-outline cblue mb-3 mt-2">Log in</button>
                        <p>Don't have an account? <a href="index.php?include=register" class="">Register here</a></p>
                    <form>

                    <?php

                        if(isset($_POST["username"]) && isset($_POST["password"]))
                        {
                            if($_POST["username"] == $_POST["password"])
                            {
                                // Login erfolgreich
                                $_SESSION["usernameSession"] = $_POST["username"];
                                header("Refresh:0");
                                header('Location: \index.php?include=home');
                            } 
                            else 
                            {
                                // Login nicht erfolgreich
                                echo ("<p class=\"text-danger\">Wrong username or password!</p>");
                            }
                        }
                        

                    ?>
                </div>
            </div>
        </div>
    </body>

</html>