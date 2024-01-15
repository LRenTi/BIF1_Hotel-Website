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

                // Wenn kein GET Parameter gesetzt ist dann wird nach Startdatum sortiert
                $sortOption = isset($_GET['sort']) ? $_GET['sort'] : 'start_date';

                // Wenn GET Parameter gesetzt ist dann wird nach dem GET Parameter sortiert
                $stmt = $mysql->prepare("SELECT * FROM BOOKINGS WHERE USER_ID = :userid ORDER BY $sortOption ASC");
                $stmt->bindParam(":userid", $_SESSION["userIDSession"]);
                $stmt->execute();
                $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

                ?>

                <?php

                // Wenn Buchungen vorhanden sind dann werden diese angezeigt
                if (count($bookings) > 0){
                    echo "<div class=\"col-12 border border-2 rounded m-3 p-3\">";
                    // Schleife um alle Buchungen auszugeben jeweils in diesem Format
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

                                // Daten des gebuchten Zimmers holen
                                $room = $mysql->prepare("SELECT * FROM ROOMS WHERE ID = :id");
                                $room->bindParam(":id", $booking["ROOM_ID"]);
                                $room->execute();
                                $roomItem = $room->fetch(PDO::FETCH_ASSOC);

                                echo "<td><p class=\"m-0 ms-2 cblue\">" . $roomItem["NAME"] . "</p></td>";

                                // Status der Buchung anzeigen
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
                                
                                // Zusatzleistungen anzeigen
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
                        echo "<div class=\"d-flex\">";
                        
                        echo "</div>";
                        echo "</div>";
                        // Wenn nicht die letzte Buchung dann wird ein Trennstrich angezeigt
                        if ($index < count($bookings) - 1) {
                            echo "<hr>";
                        }
                    }
                echo "</div>";
                } 
                else { // Wenn keine Buchungen vorhanden sind
                    echo "<div class=\"col-12 border border-2 rounded m-3 p-3\">";
                    echo "<h3 class=\"mt-2\" >Keine Buchungen vorhanden!</h3>";
                    echo "</div>"; 
                }

                ?>
        </div>
    </body>
</html>