<?php
    $msg = "";
    if(isset($_POST["submit"])){
        require("php/mysql.php");
        $stmt = $mysql->prepare("SELECT * FROM ACCOUNTS WHERE USERNAME = :user");
        $stmt->bindPARAM(":user", $_POST["username"]);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count >= 1){
            $row = $stmt->fetch();
            if(password_verify($_POST["pw"], $row["PASSWORD"])){
                $_SESSION["usernameSession"] = $row["USERNAME"];
                header("Refresh:0");
                header('Location: \index.php?include=home');
            } 
            else { $msg = "<p style=\"color:red\">Passwort und Login stimmen nicht überein!</p>"; }
        }
        else { $msg = "<p style=\"color:red\">Passwort und Login stimmen nicht überein!</p>"; }
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Login - LA Hotel</title>
    </head>

    <body>
        <section class="bg-grad-rb">
            <div class="container d-flex justify-content-center pt-5">
                
                <div class="card p-3 text-center border-white">
                    <h1 class="fw-bold mt-2 mb-3">Login</h1>

                    <form style="width: 20rem;" action="" method="post">
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <input type="text" class="text-center form-control mb-3" style="width: 15rem;" placeholder="Benutzername" id="username" name="username" value="<?php if (isset($_POST["username"])) echo $_POST["username"]; ?>" required>

                            <input type="password" class="text-center form-control" style="width: 15rem;" placeholder="Passwort" id="password" name="pw" required>
                        
                            <button type="submit" class="btn btn-outline cblue mb-3 mt-2" name="submit">Login</button>
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