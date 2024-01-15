<!DOCTYPE html>
<head>
    <title>Registrierung</title>
</head>

<body>

    <?php
    $msg = "";
    // Wenn der submit button gedrückt wurde
    if(isset($_POST["submit"])){
        require("php/dbaccess.php");
        $stmt = $mysql->prepare("SELECT * FROM ACCOUNTS WHERE USERNAME = :user"); // Username überprüfen
        $stmt->bindPARAM(":user", $_POST["username"]);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count == 0){
            // Username ist noch nicht vergeben
            if($_POST["pw"] == $_POST["pw2"]){
                $role = 1; // Standardrolle 1 = User; 2 = Admin; -1 = gesperrt
                // User anlegen
                $stmt = $mysql->prepare("INSERT INTO ACCOUNTS (USERNAME, EMAIL, ANREDE, VORNAME, NACHNAME, TELEFON, PASSWORD, ROLE) VALUES (:user, :mail, :anrede, :vorname, :nachname, :telefonnummer, :pw, :role)");
                $stmt->bindPARAM(":user", $_POST["username"]);
                $stmt->bindPARAM(":mail", $_POST["mail"]);
                $stmt->bindPARAM(":anrede", $_POST["anrede"]);
                $stmt->bindPARAM(":vorname", $_POST["Vorname"]);
                $stmt->bindPARAM(":nachname", $_POST["Nachname"]);
                $stmt->bindPARAM(":telefonnummer", $_POST["telephone"]);    
                $stmt->bindPARAM(":role", $role );            
                $hash = password_hash($_POST["pw"], PASSWORD_BCRYPT);
                $stmt->bindPARAM(":pw", $hash);
                $stmt->execute();
                $msg = "<p style=\"color:green;\">Registrierung erfolgreich!</p>";
            } 
            else { $msg = "<p style=\"color:green;\">Passwörter stimmen nicht überein"; }
        } 
    else { $msg = "Username bereits vergeben";}
    }
    ?>

    <section class="bg-grad-rb">
        <div class="container d-flex justify-content-center pt-3 pb-3">
            
            <div class="card p-3 text-center border-white">
                <h1 class="fw-bold mt-2 mb-3">Registrierung</h1>
                <?php echo $msg ?>
                <form method="post">
                        <div class="d-flex flex-column justify-content-center align-items-center">
                                <input type="text" class="text-center form-control mb-3" style="width: 15rem;"placeholder="Benutzername" name="username" required>
                                <input type="email" class="text-center form-control mb-3" style="width: 15rem;"placeholder="Email" name="mail" required>                            
                                <select class="text-center form-control mb-3" style="width: 7.5rem;" placeholder="Anrede" id="anrede" name="anrede" required>
                                    <option id="male">Herr</option>
                                    <option id="female">Frau</option>
                                    <option id="divers">ohne Anrede</option>
                                </select>
                                <input type="text" class="text-center form-control mb-3" style="width: 15rem;" placeholder="Vorname" name="Vorname" required>
                                <input type="text" class="text-center form-control mb-3"style="width: 15rem;" placeholder="Nachname" name="Nachname" required>
                                <input type="telephone" class="text-center form-control mb-3" style="width: 15rem;" placeholder="Telefonnummer" name="telephone" required>
                                <input type="password" class="text-center form-control mb-3" style="width: 15rem;"  placeholder="Passwort" name="pw" required>
                                <input type="password" class="text-center form-control mb-3" style="width: 15rem;"  placeholder="Passwort wiederholen" name="pw2" required>
                                <button type="submit" class="btn btn-blue" style="width: 15rem;" name="submit">Registrieren</button>
                                <p class="mt-3">Haben sie schon einen Account? <a href="index.php?include=login">Login hier</a></p>
                        </div>
                </form>
            </div>
        </div>
    </section>
    </body>
</html>
