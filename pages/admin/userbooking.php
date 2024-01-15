<!DOCTYPE html>
<html>
    <body>
        <div class="mt-2 ms-4 min-vh-100">
                <div class="m-0 p-0 fw-bold d-flex justify-content-center align-items-center">
                    <p class="m-0 p-0 me-2 cblue">Sortieren nach:</p>
                    <a href="index.php?include=admin&site=userlist&booking=<?php echo $_GET['booking']; ?>&sort=start_date" class="btn btn-outline cblue me-2">Startdatum</a>
                    <a href="index.php?include=admin&site=userlist&booking=<?php echo $_GET['booking']; ?>&sort=end_date" class="btn btn-outline cblue me-2">Enddatum</a>
                    <a href="index.php?include=admin&site=userlist&booking=<?php echo $_GET['booking']; ?>&sort=status" class="btn btn-outline cblue me-2">Status</a>
                    <a href="index.php?include=admin&site=userlist&booking=<?php echo $_GET['booking']; ?>&sort=total_price" class="btn btn-outline cblue me-2">Preis</a>
                    <a href="index.php?include=admin&site=userlist&booking=<?php echo $_GET['booking']; ?>&sort=id" class="btn btn-outline cblue me-2">ID</a>
                    <a href="index.php?include=admin&site=userlist&booking=<?php echo $_GET['booking']; ?>&sort=timestamp" class="btn btn-outline cblue me-2">Buchungsdatum</a>
                    <p class="m-0 p-0 cblue ">absteigend</p>
                </div>
                <?php

                require("php/dbaccess.php");

                // Wenn kein GET Parameter gesetzt ist dann wird nach Startdatum sortiert
                $sortOption = isset($_GET['sort']) ? $_GET['sort'] : 'start_date';

                $stmt = $mysql->prepare("SELECT * FROM BOOKINGS WHERE USER_ID = :userid ORDER BY $sortOption DESC");
                $stmt->bindParam(":userid", $_GET["booking"]);
                $stmt->execute();
                $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $user = $mysql->prepare("SELECT * FROM ACCOUNTS WHERE ID = :id");
                $user->bindParam(":id", $_GET["booking"]);
                $user->execute();
                $userItem = $user->fetch(PDO::FETCH_ASSOC);

                echo "<a href=\"index.php?include=admin&site=userlist\" class=\"btn btn-outline cblue me-2\">Zurück</a>";
                echo "<div class=\"m-0 p-0 fw-bold d-flex justify-content-center align-items-center\">";
                echo "<h3 class=\"fw-bold\">Buchungen von: " . $userItem["USERNAME"] . "</h3>";
                echo "</div>";
                // Wenn Buchungen vorhanden sind dann werden diese angezeigt
                if (count($bookings) > 0) {
                    echo "<div class=\"col-12 border border-2 rounded m-3 p-3\">";
                    foreach ($bookings as $index => $booking) {
                       
                        $room = $mysql->prepare("SELECT * FROM ROOMS WHERE ID = :id");
                        $room->bindParam(":id", $booking["ROOM_ID"]);
                        $room->execute();
                        $roomItem = $room->fetch(PDO::FETCH_ASSOC);

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
                        echo "<th scope=\"col\">Buchungsdatum</th>";
                        
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td><p class=\"m-0 fw-bold\">" . $booking["ID"] . "</p></td>";
                        echo "<td><p class=\"m-0 ms-2 cblue\">" . $roomItem["NAME"] . "</p></td>";

                        if ($booking["STATUS"] == 0) {
                            echo "<td><p class=\"fw-bold text-warning\">offen</p></td>";
                        }
                        if ($booking["STATUS"] == 1) {
                            echo "<td><p class=\"fw-bold text-success\">bestätigt</p></td>";
                        }
                        if ($booking["STATUS"] == -1) {
                            echo "<td><p class=\"text-danger fw-bold\">storniert</p></td>";
                        }
                        echo "<td><p class=\"m-0 ms-2 cblue\">" . date('d. M. Y', strtotime($booking["START_DATE"])) . " </p></td>";
                        echo "<td><p class=\"m-0 ms-2 cblue\">" . date('d. M. Y', strtotime($booking["END_DATE"])) . " </p></td>";
                        echo "<td class=\"d-flex justify-content-center\">";
                        if ($booking["PARKING"] == 1 || $booking["BREAKFAST"] == 1 || $booking["PETS"] == 1) {
                            if ($booking["PARKING"] == 1) {
                                echo "<p class=\"cblue\">P</p>";
                            }
                            if ($booking["BREAKFAST"] == 1) {
                                echo "<p class=\"ms-1 cblue\">F</p>";
                            }
                            if ($booking["PETS"] == 1) {
                                echo "<p class=\"ms-1 cblue\">T</p>";
                            }
                        } else {
                            echo "<p class=\"cblue\">keine</p>";
                        }
                        echo "</td>";

                        echo "<td><p class=\"m-0 ms-2 cblue\">" . $booking["TOTAL_PRICE"] . ",- €</p></td>";
                        echo "<td><p class=\"m-0 ms-2 cblue\">" . date('d. M. Y', strtotime($booking["TIMESTAMP"])) . " </p></td>";
                        echo "</tr>";
                        echo "</table>";
                        echo "</div>";
                        echo "<div class=\"m-0 p-0 fw-bold d-flex justify-content-end align-items-center\">";
                        echo "<p class=\"fw-bold m-0 p-0 me-2\">Status ändern:</p>";
                        if ($booking["STATUS"] == 0) {
                        echo "<a href=\"index.php?include=admin&site=bookinglist&succes= " . $booking["ID"] . "\" class=\"btn btn-success cblue me-2 fw-bold\">Bestätigen</a>";
                        echo "<a href=\"index.php?include=admin&site=bookinglist&storno= " . $booking["ID"] . "\" class=\"btn btn-danger cblue me-2 fw-bold\">Stornieren</a>";
                        }
                        if ($booking["STATUS"] == 1) {
                        echo "<a href=\"index.php?include=admin&site=bookinglist&storno= " . $booking["ID"] . "\" class=\"btn btn-danger cblue me-2 fw-bold\">Stornieren</a>";
                        }
                        if ($booking["STATUS"] == -1) {
                        echo "<a href=\"index.php?include=admin&site=bookinglist&succes= " . $booking["ID"] . "\" class=\"btn btn-success cblue me-2 fw-bold\">Bestätigen</a>";
                        }

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
                    echo "<h3 class=\"mt-2\" >Keine Buchungen vorhanden!</h3>";
                    echo "</div>"; 
                }

                ?>
        </div>
    </body>
</html>


<?php


// Wenn Buchung bestätigt wird
if (isset($_GET["succes"])) {
    $stmt = $mysql->prepare("UPDATE BOOKINGS SET STATUS = 1 WHERE ID = :id");
    $stmt->bindParam(":id", $_GET["succes"]);
    $stmt->execute();
    echo "<script>window.location.href = 'index.php?include=admin&site=bookinglist';</script>";

    exit();
}

// Wenn Buchung storniert wird
if (isset($_GET["storno"])) {
    $stmt = $mysql->prepare("UPDATE BOOKINGS SET STATUS = -1 WHERE ID = :id");
    $stmt->bindParam(":id", $_GET["storno"]);
    $stmt->execute();
    echo "<script>window.location.href = 'index.php?include=admin&site=bookinglist';</script>";

    exit();
}

?>

