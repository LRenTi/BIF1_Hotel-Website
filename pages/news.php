<!DOCTYPE HTML>
<html>
    <head>
        <title>News</title>
    </head>
    <body>
        <div class="container-md">
            
            <?php
                // News aus der Datenbank holen und anzeigen
                require("php/dbaccess.php");
                $stmt = $mysql->prepare("SELECT * FROM NEWS ORDER BY DATE DESC");
                $stmt->execute();
                $news = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Wenn keine News vorhanden sind
                if (count($news) == 0)
                {
                    echo "<h3 class=\"mt-2\" >Keine News vorhanden!</h3>";
                }
                else { // Wenn News vorhanden sind
                    echo "<h1 class=\"cblue mt-3 fw-bold\">Aktuelles</h1>";
                }

                // Schleife um alle News auszugeben jeweils in diesem Format
                foreach($news as $newsItem)
                {
                    echo "<div class=\"col-12 border border-2 rounded m-3 p-3\">";
                        echo "<div class=\"d-flex\">";
                            echo "<img class=\"m-3 rounded\" src=\"" . $newsItem["IMAGE"] . "\" width=\"300px\">";
                            echo "<div>";
                                echo "<h2 class=\"mt-2 mb-0 pb-0 fw-bold cblue\" >" . $newsItem["TITLE"] . "</h2>";
                                echo "<p class=\"cblue fw-bold m-0 p-0 ms-3\">" . date('d. M. Y', strtotime($newsItem["DATE"])) . "</p>";
                                echo "<p class=\"cblue ms-3 me-3\">" . $newsItem["TEXT"] . "</p>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                }
            ?>
        </div>
    </body>
</html>