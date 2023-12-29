<!DOCTYPE HTML>
<html>
    <head>
        <title>News</title>
    </head>
    <body>
        <div class="container-md">
            <h1 class="cblue mt-3 fw-bold">Aktuelles</h1>

            <?php
                session_start();
                require("mysql.php");

                // Daten aus dem Formular holen
                $username = $_POST["username"];
                $email = $_POST["email"];
                $vorname = $_POST["Vorname"];
                $nachname = $_POST["Nachname"];
                $telefon = $_POST["telephone"];
                $anrede = $_POST["anrede"];
                // usw. für alle anderen Daten, die Sie aktualisieren möchten

                // SQL-Abfrage vorbereiten
                $stmt = $mysql->prepare("UPDATE ACCOUNTS SET USERNAME = :username, VORNAME = :vorname, NACHNAME = :nachname, EMAIL = :email, TELEFON = :telefon, ANREDE = :anrede WHERE username = :session_username");

                // Parameter binden
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':vorname', $vorname);
                $stmt->bindParam(':nachname', $nachname);
                $stmt->bindParam(':telefon', $telefon);
                $stmt->bindParam(':anrede', $anrede);
                $stmt->bindParam(':session_username', $_SESSION["usernameSession"]);

                // Abfrage ausführen
                $stmt->execute();

                // Aktualisieren Sie die Session-Daten
                $_SESSION["usernameSession"] = $username;

                // Weiterleiten des Benutzers zurück zum Profil
                header("Location: ../index.php?include=profile&site=change&msg=profilesuccess");
                exit();
                ?>
            
            <div class="col-12 border border-2 rounded m-3 pb-0 p-3">
                <div>

                </div>
                <div class="d-flex">
                    <img class="m-3 rounded-circle "src="uploads/thumbnails/resized_65636db06fbf4_0_0.jpg" width="360px">
                    <div>
                        <h2 class="mt-2 mb-0 pb-0 fw-bold cblue" >EXAMPLE NEWS</h2>
                        <p class="cblue fw-bold m-0 p-0 ms-3">DATE</p>
                        <p class="cblue ms-3 me-3">
                            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. 
                            At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. 
                            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. 
                            At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. 
                            At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                            Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet,
                        </p>
                    </div>
                </div>
            </div>

            <?php






            ?>


            <!-- BREAK
            <?php
                echo("<div class=\"row\">");
                    echo("<div class=\"col col-6\">");
                /* Alle Picture anzeigen im Upload Folder */
                $files = scandir("uploads");

                echo "<h2 class=\"mt-2 fw-bold\" >Pictures</h2>";

                if ($files !== false) {
                    if (count($files) > 3){
                        echo "<h3 class=\"mt-2\" >Alle Uploads</h3>";
                    }
                    else { echo "<h5 class=\"mt-2\">Keine Uploads vorhanden!</h5>";}

                    for ($i = 0; $i < count($files); $i++) {
                        $file = $files[$i];
                        if ($file == "." || $file == ".." || $file == "thumbnails") {
                            continue;
                        }
                        else if (pathinfo($file, PATHINFO_EXTENSION) == "jpg" || pathinfo($file, PATHINFO_EXTENSION) == "jpeg") {
                            echo '<a href="index.php?include=news&pic='. $file . '">' . $file . '</a><br>';
                        } else {
                            echo $file . "<br>";
                        }
                    }
                } else {
                    echo "ERROR: Failed to open directory.";
                }

                if(isset($_GET["pic"]))
                {

                    if (in_array($_GET["pic"], $files))
                    {
                        echo('<div class="mt-3 ms-3">');
                        echo('<h3>Selected Image</h3>');
                        echo '<img src="uploads/' . $_GET["pic"] . '" alt="Bild" width="auto" height="200" class="rounded border mb-3">';
                        echo('</div>');
                    }
                }
                    echo("</div>");
                    echo("<div class=\"col col-6\">");
                    
                /* Alle Thumbnails anzeigen im Upload Folder */
                $filesT = scandir("uploads/thumbnails");

                echo "<h2 class=\"mt-2 fw-bold\" >Thumbnails</h2>";

                if ($filesT !== false) {
                    if (count($filesT) > 2){
                        echo "<h3 class=\"mt-2\" >Alle Thumbnails</h3>";
                    }
                    else { echo "<h5 class=\"mt-2\">Keine Thumbnails vorhanden!</h5>";}

                    for ($i = 0; $i < count($filesT); $i++) {
                        $fileT = $filesT[$i];
                        if ($fileT == "." || $fileT == ".." || $fileT == "thumbnails") {
                            continue;
                        }
                        else if (pathinfo($fileT, PATHINFO_EXTENSION) == "jpg" || pathinfo($fileT, PATHINFO_EXTENSION) == "jpeg") {
                            echo '<a href="index.php?include=news&tpic='. $fileT . '">' . $fileT . '</a><br>';
                        } else {
                            echo $fileT . "<br>";
                        }
                    }
                } else {
                    echo "ERROR: Failed to open directory.";
                }

                if(isset($_GET["tpic"]))
                {

                    if (in_array($_GET["tpic"], $filesT))
                    {
                        echo('<div class="mt-3 ms-3">');
                        echo('<h3>Selected Thumbnail (resized)</h3>');
                        echo '<img src="uploads/thumbnails/' . $_GET["tpic"] . '" alt="Bild" width="auto" height="200" class="rounded border mb-3">';
                        echo('</div>');
                    }
                }
                echo("</div>");
            ?> -->
        </div>
    </body>
</html>