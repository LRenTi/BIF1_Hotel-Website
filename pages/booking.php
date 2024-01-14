<?php
    require("php/dbaccess.php");
    $stmt = $mysql->prepare("SELECT * FROM ROOMS");
    $stmt->execute();
    $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container-md">
    <h1 class="mt-3 text-center">Zimmer buchen</h1>
    <form method="POST">
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
                echo "<div class=\"row mt-2 mb-2 p-3 border border-2 rounded\">";
                    echo "<h3>" . $roomItem["NAME"] . "</h3>";
                    echo "<div class=\"col col-4\">";
                        echo "<img src=\"" . $roomItem["IMAGE"] . "\" alt=\"" . $roomItem["NAME"] . "\" class=\"img-fluid rounded\" width=\"320px\">";
                    echo "</div>";
                    echo "<div class=\"col col-4 vr\">";
                    echo "<h4>Preis/Nacht: " . $roomItem["PRICE"] . ",- €</h4>";
                    echo "<div class=\"d-grid gap-1\">";
                        echo "<div>";
                            echo "<input type=\"checkbox\" name=\"breakfast\" id=\"breakfast\" class=\"form-check-input\" value=\"true\">";
                            echo "<label class=\"ms-1 fw-bold\">Frühstück</label>
                                <p class=\"ms-4\">Aufpreis: 10,- €</p>";
                        echo "</div>";
                        echo "<div>";
                            echo "<input type=\"checkbox\" name=\"pets\" id=\"pets\" class=\"form-check-input\" value=\"true\">";
                            echo "<label class=\"ms-1 fw-bold\">Tiere</label>
                                <p class=\"ms-4\">Aufpreis: 10,- €</p>";
                        echo "</div>";
                        echo "<div>";
                            echo "<input type=\"checkbox\" name=\"parking\" id=\"parking\" class=\"form-check-input\" value=\"true\">";
                            echo "<label class=\"ms-1 fw-bold\">Parkplatz</label>
                                <p class=\"ms-4 p-0\">Aufpreis: 10,- €</p>";
                        echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class=\"col col-4 vr d-flex align-items-end justify-content-end\">";
                        echo "<div class=\"d-flex mt-5\">";
                            if(isset($_SESSION["usernameSession"])){
                                echo 
                                "<div class=\"align-self-end\">
                                <button type=\"submit\" value=\"" . $roomItem["ID"] . "\" class=\"btn btn-outline cblue mb-3 mt-2\" name=\"roomid\">Buchen</button>
                                </div>";
                            }else{ // Login fehlt
                                echo "<p>Bitte loggen Sie sich ein, um ein Zimmer zu buchen.</p>";
                                echo "<div class=\"align-self-end\"><a href=\"index.php?include=login\" class=\"btn btn-outline cblue mb-3 mt-2\">Login</a></div>";
                            }
                            echo "</div>"; 
                    echo "</div>";
                echo "</div>";
            }

        ?>
    </form>
</div>

<?php
if(isset($_POST["roomid"])){
    $stmt = $mysql->prepare("SELECT * FROM ROOMS WHERE ID = :id");
    $stmt->bindParam(":id", $_POST["roomid"]);
    $stmt->execute();
    $room = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $mysql->prepare("SELECT * FROM BOOKINGS WHERE ROOM_ID = :id AND STATUS != -1");
    $stmt->bindParam(":id", $_POST["roomid"]);
    $stmt->execute();
    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $startdate = strtotime($_POST["startdate"]);
    $enddate = strtotime($_POST["enddate"]);

    $available = true;

    if($startdate >= $enddate){
        $available = false;
    }

    foreach($bookings as $index => $booking){
        $bookingStart = strtotime($booking["START_DATE"]); // Modify column name to START_DATE
        $bookingEnd = strtotime($booking["END_DATE"]); // Modify column name to END_DATE
        
        if($startdate >= $bookingStart && $startdate <= $bookingEnd){
            $available = false;
        }
        if($enddate >= $bookingStart && $enddate <= $bookingEnd){
            $available = false;
        }
    }

    if($available){
        if(isset($_SESSION["userIDSession"])){ // Check if USER_ID is set
            $stmt = $mysql->prepare("INSERT INTO BOOKINGS (USER_ID, ROOM_ID, START_DATE, END_DATE, BREAKFAST, PETS, PARKING, STATUS, TOTAL_PRICE) VALUES (:userid, :roomid, :startdate, :enddate, :breakfast, :pets, :parking, 0, :totalprice)"); // Modify column names to START_DATE and END_DATE
            $stmt->bindParam(":userid", $_SESSION["userIDSession"]);
            $stmt->bindParam(":roomid", $_POST["roomid"]);
            $stmt->bindParam(":startdate", $_POST["startdate"], PDO::PARAM_STR);
            $stmt->bindParam(":enddate", $_POST["enddate"], PDO::PARAM_STR);
            if(isset($_POST["breakfast"])) {
                $breakfast = 1;
                $stmt->bindParam(":breakfast", $breakfast);
            } else {
                $breakfast = 0;
                $stmt->bindParam(":breakfast", $breakfast);
            }
            if(isset($_POST["pets"])) {
                $pets = 1;
                $stmt->bindParam(":pets", $pets);
            } else {
                $pets = 0;
                $stmt->bindParam(":pets", $pets);
            }
            if(isset($_POST["parking"])) {
                $parking = 1;
                $stmt->bindParam(":parking", $parking);
            } else {
                $parking = 0;
                $stmt->bindParam(":parking", $parking);
            }
            $total = $room["PRICE"] * ((strtotime($_POST["enddate"]) - strtotime($_POST["startdate"])) / 86400);
            if($_POST["breakfast"] == "true"){
                $total += 10*((strtotime($_POST["enddate"]) - strtotime($_POST["startdate"])) / 86400);
            }
            if($_POST["pets"] == "true"){
                $total += 10*((strtotime($_POST["enddate"]) - strtotime($_POST["startdate"])) / 86400);
            }
            if($_POST["parking"] == "true"){
                $total += 10*((strtotime($_POST["enddate"]) - strtotime($_POST["startdate"])) / 86400);
            }
            $stmt->bindParam(":totalprice", $total);
            $stmt->execute();

            echo "<script>alert(\"Buchung erfolgreich!\");</script>";
        }else{
            echo "<script>alert(\"Bitte loggen Sie sich ein, um ein Zimmer zu buchen.\");</script>"; // Eingeloggt fehlt
        }
    }else{
        echo "<script>alert(\"Buchung zu diesen Zeitangaben nicht möglich\");</script>";
    }
}


?>