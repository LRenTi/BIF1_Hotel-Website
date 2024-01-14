<?php

require("php/dbaccess.php");

$sortOption = isset($_GET['sort']) ? $_GET['sort'] : 'start_date';

$stmt = $mysql->prepare("SELECT * FROM BOOKINGS WHERE STATUS = 0 ORDER BY $sortOption ASC");
$stmt->execute();
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php

if (count($bookings) > 0){
    echo "<div class=\"col-12 border border-2 rounded m-3 p-3\">";
    foreach($bookings as $index => $booking){
        echo "<div class=\"\">";
        echo "<div class=\"d-flex m-0\">";
        echo "<table class=\"table table-borderless text-center\">";
            echo "<tr>";
                echo "<th scope=\"col\">Buchungsnr.</th>";
                echo "<th scope=\"col\">Zimmer</th>";
                echo "<th scope=\"col\">Status</th>";
                echo "<th scope=\"col\">Startdatum</th>";
                echo "<th scope=\"col\">Enddatum</th>";
                echo "<th scope=\"col\">Zusatz</th>";
                echo "<th scope=\"col\">Gesamtpreis</th>";
            echo "</tr>";
            echo "<tr>";
                echo "<td><p class=\"m-0 fw-bold\">" . $booking["ID"] . "</p></td>";

                $room = $mysql->prepare("SELECT * FROM ROOMS WHERE ID = :id");
                $room->bindParam(":id", $booking["ROOM_ID"]);
                $room->execute();
                $roomItem = $room->fetch(PDO::FETCH_ASSOC);

                echo "<td><p class=\"m-0 ms-2 cblue\">" . $roomItem["NAME"] . "</p></td>";

                if($booking["STATUS"] == 0){
                    echo "<td><p class=\"fw-bold text-warning\">offen</p></td>";
                }
                if($booking["STATUS"] == 1){
                    echo "<td><p class=\"fw-bold text-success\">bestätigt</p></td>";
                }
                if($booking["STATUS"] == -1){
                    echo "<td><p class=\"text-danger fw-bold\">storniert</p></td>";
                }
                echo "<td><p class=\"m-0 ms-2 cblue\">" . date('d. M. Y', strtotime($booking["START_DATE"])) . " </p></td>";
                echo "<td><p class=\"m-0 ms-2 cblue\">" . date('d. M. Y', strtotime($booking["END_DATE"])) . " </p></td>";
                echo "<td class=\"d-flex justify-content-center\">";
                if($booking["PARKING"] == 1 || $booking["BREAKFAST"] == 1 || $booking["PETS"] == 1){
                    if($booking["PARKING"] == 1){
                        echo "<p class=\"cblue\">P</p>";
                    }
                    if($booking["BREAKFAST"] == 1){
                        echo "<p class=\"ms-1 cblue\">F</p>";
                    }
                    if($booking["PETS"] == 1){
                        echo "<p class=\"ms-1 cblue\">T</p>";
                    }
                }else {
                    echo "<p class=\"cblue\">keine</p>";
                }
                echo "</td>";

                echo "<td><p class=\"m-0 ms-2 cblue\">" . $booking["TOTAL_PRICE"] . ",- €</p></td>";
            echo "</tr>";
        echo "</table>";
        echo "<div class=\"m-0 p-0 d-grid justify-content-center align-items-center\">";
            echo "<a href=\"index.php?include=admin&site=openbookinglist&verify=" . $booking["ID"] . "\" class=\"btn btn-success mb-1\">Bestätigen</a>";
            echo "<a href=\"index.php?include=admin&site=openbookinglist&storno=" . $booking["ID"] . "\" class=\"btn btn-danger \">Stornieren</a>";
        echo "</div>";
        echo "</div>";
        echo "<div class=\"d-flex\">";
        
        echo "</div>";
        echo "</div>";
        if ($index < count($bookings) - 1) {
            echo "<hr>";
        }
    }
echo "</div>";
} 
else {
    echo "<div class=\"col-12 border border-2 rounded m-3 p-3\">";
    echo "<h3 class=\"mt-2 text-center\" >Keine offenen Buchungen vorhanden!</h3>";
    echo "</div>"; 
}

if(isset($_GET["verify"])){
    $stmt = $mysql->prepare("UPDATE BOOKINGS SET STATUS = 1 WHERE ID = :id");
    $stmt->bindParam(":id", $_GET["verify"]);
    $stmt->execute();
    echo "<script>window.location.href = 'index.php?include=admin&site=openbookinglist';</script>";

    exit();
}

if(isset($_GET["storno"])){
    $stmt = $mysql->prepare("UPDATE BOOKINGS SET STATUS = -1 WHERE ID = :id");
    $stmt->bindParam(":id", $_GET["storno"]);
    $stmt->execute();
    echo "<script>window.location.href = 'index.php?include=admin&site=openbookinglist';</script>";
    exit();
}

?>
