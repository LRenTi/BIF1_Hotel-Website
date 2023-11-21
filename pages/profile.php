<!DOCTYPE html>
<html>
    <head>
        <title>Dein Profil</title>
    </head>
    <?php



    ?>

    <body>
        <div class="container-md">
            <h1 class="font-weight-bold mt-3">
                Profil - <?php echo $_SESSION["usernameSession"]; ?>
            </h1>
            <form>
                <label><b>Benutzername:</b></label>
                <input type="text" class="form-control" placeholder="Benutzername" id="username" value="<?php echo $_SESSION["usernameSession"]; ?>" required>
                <button type="submit" class="btn btn-outline cblue mb-3 mt-2">Speichern</button>
            <form>

        </div>



    </body>

</html>