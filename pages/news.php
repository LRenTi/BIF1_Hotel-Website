<!DOCTYPE HTML>
<html>
    <head>
        <title>News</title>
    </head>
    <body>
        <div class="container-md text-center">
            <h1 class="text-center mt-3 fw-bold">News</h1>

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
            ?>
        </div>
    </body>
</html>