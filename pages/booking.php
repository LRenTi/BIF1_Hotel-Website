<?php
    require("php/mysql.php");
    $stmt = $mysql->prepare("SELECT * FROM ROOMS");
    $stmt->execute();
    $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container-md">
    <h1 class="mt-3 text-center">Zimmer buchen</h1>
    <form>
        <div class="d-flex justify-content-center">
            <div class="text-center fw-bold me-2">
                <label>Startdatum</label>
                <input type="date" name="startdate" id="startdate" style="width: 15rem;" class="form-control" required>
            </div>
            <div class="text-center fw-bold">
                <label>Enddatum</label>
                <input type="date" name="enddate" id="enddate" style="width: 15rem;" class="form-control" required>
            </div>
        </div>
        <?php

            foreach($rooms as $index => $roomItem){
                echo "<div class=\"row mt-2 p-3 border border-2 rounded\">";
                    echo "<h3>" . $roomItem["NAME"] . "</h3>";
                    echo "<div class=\"col col-4\">";
                        echo "<img src=\"" . $roomItem["IMAGE"] . "\" alt=\"" . $roomItem["NAME"] . "\" class=\"img-fluid rounded\" width=\"320px\">";
                    echo "</div>";
                    echo "<div class=\"col col-4 vr\">";
                    echo "<h4>Preis/Nacht: " . $roomItem["PRICE"] . ",- €</h4>";
                    echo "<div class=\"d-grid gap-1\">";
                        echo "<div>";
                            echo "<input type=\"checkbox\" name=\"breakfast\" id=\"breakfast\" class=\"form-check-input\">";
                            echo "<label class=\"ms-1 fw-bold\">Frühstück</label>
                                <p class=\"ms-4\">Aufpreis: 10,- €</p>";
                        echo "</div>";
                        echo "<div>";
                            echo "<input type=\"checkbox\" name=\"pets\" id=\"pets\" class=\"form-check-input\">";
                            echo "<label class=\"ms-1 fw-bold\">Tiere</label>
                                <p class=\"ms-4\">Aufpreis: 10,- €</p>";
                        echo "</div>";
                        echo "<div>";
                            echo "<input type=\"checkbox\" name=\"parking\" id=\"parking\" class=\"form-check-input\">";
                            echo "<label class=\"ms-1 fw-bold\">Parkplatz</label>
                                <p class=\"ms-4 p-0\">Aufpreis: 10,- €</p>";
                        echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class=\"col col-4 vr\">";
                        echo "<div class=\"mt-5\">";
                                echo "<div class=\"align-self-end\"><button type=\"submit\" class=\"btn btn-outline cblue mb-3 mt-2\" name=\"submit\">Verfügbarkeit überprüfen</button></div>";
                        echo "</div>"; 
                    echo "</div>";
                echo "</div>";
            }

        ?>
    </form>
</div>