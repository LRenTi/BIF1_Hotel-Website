<?php
require_once(__DIR__ . "/../php/mysql.php");
$username = $_SESSION["usernameSession"];
$stmt = $mysql->prepare("SELECT * FROM ACCOUNTS WHERE USERNAME = :username");
$stmt->bindParam(':username', $username);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dein Profil</title>
</head>
<body>
    <div class="container-md">
        <h1 class="font-weight-bold mt-3">
            Profil - <?php echo $username; ?>
        </h1>
        <h2>Deine Daten ändern</h2>
        <form method="post" action="./php/update_profile.php">
            <label><b>Benutzername</b></label>
            <input type="text" class="text-center form-control mb-3" style="width: 15rem;" placeholder="Benutzername" id="username" value="<?php echo $user["USERNAME"]; ?>" name="username" required>
            <label><b>Vorname</b></label>
            <input type="text" class="text-center form-control mb-3" style="width: 15rem;" placeholder="Vorname" value="<?php echo $user["VORNAME"]; ?>" name="Vorname" required>
            <label><b>Nachname</b></label>
            <input type="text" class="text-center form-control mb-3" style="width: 15rem;" placeholder="Nachname" value="<?php echo $user["NACHNAME"]; ?>" name="Nachname" required>
            <label><b>Email</b></label>
            <input type="text" class="text-center form-control mb-3" style="width: 15rem;" placeholder="Email" id="email" name="email" value="<?php echo $user["EMAIL"]; ?>" required>
            <label><b>Telefonnummer</b></label>
            <input type="telephone" class="text-center form-control mb-3" style="width: 15rem;" placeholder="Telefonnummer" id="telephone" name="telephone" value="<?php echo $user["TELEFON"]; ?>" required>
            <button type="submit" class="btn btn-outline cblue mb-3 mt-2" name="submit">Aktualisieren</button>
        </form>
    </div>
</body>
</html>