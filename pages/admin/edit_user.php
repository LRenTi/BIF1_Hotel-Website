<?php
    // Holt sich die Account-Daten aus der Datenbank über die übergebene ID
    require_once(__DIR__ . "/../../php/dbaccess.php");
    $id = $_GET["profile"];
    $stmt = $mysql->prepare("SELECT * FROM ACCOUNTS WHERE ID = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);


?>
<h3 class="mt-3">User bearbeiten: <?php echo $user["USERNAME"] ?></h3>
<div class="container-md d-flex justify-content-center row mt-2">
    <div class="col">
        <?php
            // Wenn MSG gesetzt ist dann wird eine Nachricht ausgegeben
            if(isset($_GET["msg"]))
            {

                if ($_GET["msg"] == "profilesuccess")
                {
                    echo "<p style=\"color:green\">Profil erfolgreich aktualisiert!</p>";
                } 
            }
            ?>
        <form method="post" action="./php/update_profile.php"> <!-- // Hier wird die Seite aufgerufen die das Profil aktualisiert -->
            <label><b>Benutzername</b></label>
            <input type="text" class="text-center form-control mb-3" style="width: 15rem;" placeholder="Benutzername" id="username" value="<?php echo $user["USERNAME"]; ?>" name="username" required>
            <label><b>Anrede</b></label>
            <select class="text-center form-control mb-3" style="width: 15rem;" placeholder="Anrede" id="anrede" name="anrede" value="<?php echo $user["ANREDE"]; ?>"required>
                <?php
                    if($user["ANREDE"] == "Herr"){
                        echo "<option id=\"male\" selected>Herr</option>";
                        echo "<option id=\"female\">Frau</option>";
                        echo "<option id=\"divers\">ohne Anrede</option>";
                    } else if($user["ANREDE"] == "Frau"){
                        echo "<option id=\"female\" selected>Frau</option>";
                        echo "<option id=\"male\">Herr</option>";
                        echo "<option id=\"divers\">ohne Anrede</option>";
                    } else {
                        echo "<option id=\"divers\" selected>ohne Anrede</option>";
                        echo "<option id=\"male\">Herr</option>";
                        echo "<option id=\"female\">Frau</option>";
                    }
                ?>
            </select>
            <label><b>Vorname</b></label>
            <input type="text" class="text-center form-control mb-3" style="width: 15rem;" placeholder="Vorname" value="<?php echo $user["VORNAME"]; ?>" name="Vorname" required>
            <label><b>Nachname</b></label>
            <input type="text" class="text-center form-control mb-3" style="width: 15rem;" placeholder="Nachname" value="<?php echo $user["NACHNAME"]; ?>" name="Nachname" required>
            <label><b>Email</b></label>
            <input type="text" class="text-center form-control mb-3" style="width: 15rem;" placeholder="Email" id="email" name="email" value="<?php echo $user["EMAIL"]; ?>" required>
            <label><b>Telefonnummer</b></label>
            <input type="telephone" class="text-center form-control mb-3" style="width: 15rem;" placeholder="Telefonnummer" id="telephone" name="telephone" value="<?php echo $user["TELEFON"]; ?>" required>
            <input type="hidden" name="user_id" value="<?php echo $user["ID"] ?? ""; ?>">
            <button type="submit" class="btn btn-outline cblue mb-3 mt-2" name="submit">Aktualisieren</button>
        </form>
    </div>
    <div class="col">
            <?php
                if(isset($_GET["msg"])){
                    if ($_GET["msg"] == "pwsuccess") {
                        echo "<p style=\"color:green\">Passwort erfolgreich aktualisiert!</p>";
                    }
                    if ($_GET["msg"] == "pwdiverge") {
                        echo "<p style=\"color:red\">Passwörter stimmen nicht überein!</p>";
                    }
                }
            ?>
            <form method="post" action="./php/admin_update_password.php">
                <label><b>Neues Passwort</b></label>
                <input type="password" class="text-center form-control mb-3" style="width: 15rem;" placeholder="Neues Passwort" id="newpw" name="newpw" required>
                <label><b>Neues Passwort wiederholen</b></label>
                <input type="password" class="text-center form-control mb-3" style="width: 15rem;" placeholder="Neues Passwort wiederholen" id="newpw2" name="newpw2" required>
                <input type="hidden" name="user_id" value="<?php echo $user["ID"] ?? ""; ?>">
                <button type="submit" class="btn btn-outline cblue mb-3 mt-2" name="submit">Passwort ändern</button>
            </form>
    </div>
</div>