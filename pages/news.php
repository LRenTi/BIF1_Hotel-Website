<!DOCTYPE HTML>
<html>
    <head>
        <title>News</title>
    </head>
    <body>
        <div class="container-md">
            <h1 class="cblue mt-3 fw-bold">Aktuelles</h1>

            <?php
            require("php/mysql.php");

            $stmt = $mysql->prepare("SELECT * FROM NEWS ORDER BY DATE DESC");
            $stmt->execute();
            $news = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($news) == 0)
            {
                echo "<h3 class=\"mt-2\" >Keine News vorhanden!</h3>";
            }

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