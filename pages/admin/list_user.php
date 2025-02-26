<div class="container-md">
    <?php
    // Wenn kein Admin dann redirect
    if($_SESSION["roleSession"] != 2)
    {
        header("Location: index.php?include=login");
    }

    if (isset($_GET["profile"]))
    {
        // Wenn GET Parameter gesetzt ist dann holt er sich die Accounts-Daten aus der Datenbank
        $profileid = $_GET["profile"];
        require_once("php/dbaccess.php");
        $stmt = $mysql->prepare("SELECT * FROM ACCOUNTS WHERE ID = :profileid");
        $stmt->bindParam(':profileid', $profileid);
        $stmt->execute();
        $profile = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // und included die Seite zum bearbeiten mit den Account-Daten
        include ("edit_user.php");
    }

    if (isset($_GET["booking"]))
    {
        $bookingid = $_GET["booking"];
        require_once("php/dbaccess.php");
        $stmt = $mysql->prepare("SELECT * FROM ACCOUNTS WHERE ID = :bookingid");
        $stmt->bindParam(':bookingid', $bookingid);
        $stmt->execute();
        $booking = $stmt->fetch(PDO::FETCH_ASSOC);

        include ("userbooking.php");
    }


    ?><h2 class="mt-3 fw-bold text-center">Userverwaltung</h2><?php

    require("php/dbaccess.php");

    // Holt sich alle Accounts aus der Datenbank
    $stmt = $mysql->prepare("SELECT * FROM ACCOUNTS ORDER BY ID ASC");
    $stmt->execute();
    $acc = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Wenn keine Accounts vorhanden sind dann wird das ausgegeben
    if (count($acc) == 0)
    {
        echo "<h3 class=\"mt-2\" >Keine Accounts vorhanden!</h3>";
        exit(); // Beendet das Script
    }

    echo "<div class=\"col-12 border border-2 rounded m-3 p-3\">";

    // Schleife um alle Accounts auszugeben jeweils in diesem Format
    foreach($acc as $index => $accItem)
    {
        echo "<div class=\"\">";
        echo "<div class=\"d-flex m-0 \">";
        echo "<p class=\"m-0 fw-bold\">" . $accItem["ID"] . "</p>";
        echo "<p class=\"m-0 ms-2 cblue\">" . $accItem["USERNAME"] . " </p>";

        // Anzeige ändert sich je nach Rolle
        if($accItem["ROLE"] == 2)
        {
            echo "<p class=\"m-0 ms-2 text-danger fw-bold\">Admin</p>";
        }
        if($accItem["ROLE"] == -1)
        {
            echo "<p class=\"ms-2 text-danger m-0 p-0\">(Deaktiviert)</p>";
        }
        echo "</div>";
        echo "<div class=\"d-flex\">";
        if($accItem["ROLE"] != -1){
            echo "<a class=\"nav-point m-0 p-0 ms-3\" href=\"index.php?include=admin&site=userlist&booking=" . $accItem["ID"] . "\">Buchungen</a>";
            echo "<a class=\"nav-point m-0 p-0 ms-2\" href=\"index.php?include=admin&site=userlist&profile=" . $accItem["ID"] . "\">Profil</a>";
        }
        if($accItem["ROLE"] == 1){
            echo "<a class=\"nav-point m-0 p-0 ms-2 text-danger\" href=\"index.php?include=admin&site=userlist&deactivate=" . $accItem["ID"] . "\">deaktivieren</a>";
        }
        if($accItem["ROLE"] == -1){
            echo "<a class=\"nav-point m-0 p-0 ms-2 text-success\" href=\"index.php?include=admin&site=userlist&activate=" . $accItem["ID"] . "\">aktivieren</a>";
        }
            
        echo "</div>";
        echo "</div>";
        // Wenn nicht der letzte Account dann wird eine Linie angezeigt
        if ($index < count($acc) - 1) {
            echo "<hr>";
        }
    }
    echo "</div>";

    // Wenn GET Parameter gesetzt ist dann deaktiviert er den Account
    if (isset($_GET["deactivate"]))
    {
        $deactivateId = $_GET["deactivate"];
        $stmt = $mysql->prepare("UPDATE ACCOUNTS SET ROLE = -1 WHERE ID = :id");
        $stmt->bindParam(':id', $deactivateId);
        $stmt->execute();
        echo "<script>window.location.href = 'index.php?include=admin&site=userlist';</script>";
    }

    // Wenn GET Parameter gesetzt ist dann aktiviert er den Account
    if (isset($_GET["activate"]))
    {
        $activateId = $_GET["activate"];
        $stmt = $mysql->prepare("UPDATE ACCOUNTS SET ROLE = 1 WHERE ID = :id");
        $stmt->bindParam(':id', $activateId);
        $stmt->execute();
        echo "<script>window.location.href = 'index.php?include=admin&site=userlist';</script>";
    }

    ?>
</div>