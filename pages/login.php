<?php
    $msg = "";

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
            $msg = "<p class=\"text-danger\">Wrong username or password!</p>";
        }
    }
    

?>

<!DOCTYPE html>

<html>
    <head>
        <title>Log in - LA Hotel</title>
    </head>

    <body>
        <section class="bg-grad-rb">
            <div class="container d-flex justify-content-center pt-5">
                
                <div class="card p-3 text-center border-white">
                    <h1 class="fw-bold mt-2 mb-3">Log in</h1>

                    <form style="width: 20rem;" action="" method="post">
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <input type="text" class="text-center form-control mb-3" style="width: 15rem;" placeholder="Benutzername" id="username" name="username" value="<?php if (isset($_POST["username"])) echo $_POST["username"]; ?>" required>

                            <input type="password" class="text-center form-control" style="width: 15rem;" placeholder="Passwort" id="password" name="password" required>
                        
                            <button type="submit" class="btn btn-outline cblue mb-3 mt-2">Log in</button>
                            <p >Noch keinen Account? <a href="index.php?include=register" class="">Hier registrieren</a></p>
                        </div>
                    <form>
                        <?php
                            echo ($msg);
                        ?>

                </div>
            </div>
        </section>
    </body>

</html>