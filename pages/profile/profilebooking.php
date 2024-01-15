<!DOCTYPE html>
<html>
    <body>
        <div class="mt-2 ms-4 min-vh-100">
                <h3>Deine Buchungen</h3>
                <div class="m-0 p-0 fw-bold d-flex justify-content-center align-items-center">
                    <p class="m-0 p-0 me-2 cblue">Sortieren nach:</p>
                    <a href="index.php?include=profile&site=booking&sort=start_date" class="btn btn-outline cblue me-2">Startdatum</a>
                    <a href="index.php?include=profile&site=booking&sort=end_date" class="btn btn-outline cblue me-2">Enddatum</a>
                    <a href="index.php?include=profile&site=booking&sort=status" class="btn btn-outline cblue me-2">Status</a>
                    <a href="index.php?include=profile&site=booking&sort=total_price" class="btn btn-outline cblue me-2">Preis</a>
                    <p class="m-0 p-0 cblue ">aufsteigend</p>
                </div>

                <?php

                require("php/dbaccess.php");

                $sortOption = isset($_GET['sort']) ? $_GET['sort'] : 'start_date';

                $stmt = $mysql->prepare("SELECT * FROM BOOKINGS WHERE USER_ID = :userid ORDER BY $sortOption ASC");
                $stmt->bindParam(":userid", $_SESSION["userIDSession"]);
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
                                echo "<th scope=\"col\">Buchungsdatum</th>";
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
                                echo "<td><p class=\"m-0 ms-2 cblue\">" . date('d. M. Y', strtotime($booking["TIMESTAMP"])) . " </p></td>";
                            echo "</tr>";
                        echo "</table>";
                        echo "</div>";
                        // Wird angezeigt wenn Buchung offen ist und storniert werden kann
                        if($booking["STATUS"] == 0){
                            echo "<div class=\"d-flex justify-content-end align-items-center\">";
                                echo "<a href=\"index.php?include=profile&site=booking&cancel=" . $booking["ID"] . "\" class=\"btn btn-outline-danger ms-3 mb-3\">Buchung stornieren</a>";
                            echo "</div>";
                            }
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

// Wenn der User eine Buchung stornieren möchte
if(isset($_GET["cancel"])){
    $stmt = $mysql->prepare("UPDATE BOOKINGS SET STATUS = -1 WHERE ID = :id");
    $stmt->bindParam(":id", $_GET["cancel"]);
    $stmt->execute();
    header("Location: index.php?include=profile&site=booking");
}

?>