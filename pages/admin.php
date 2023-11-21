<!DOCTYPE html>
<html>
    <head>
        <title>Upload</title>
    </head>
    <body>
        <div class="container-md">
            <h1 class="mt-3">File Upload</h1>
            <div class="ms-3">
                <form action="index.php?include=admin" enctype="multipart/form-data" method="post">
                    <input type="file" name="picture" accept="image/jpeg"></br>
                    <input type="submit" class="btn btn-gold mt-2 mb-2 p-1" value="Hochladen"/>
                </form>
            </div>
            
            <?php
            /* Upload picture */
            if(isset($_FILES["picture"]))
            {
                if($_FILES["picture"]["type"] == "image/jpeg")
                {
                    $destination = getcwd(). "/uploads/" . uniqid() . "_" . $_FILES["picture"]["name"];
                    
                    move_uploaded_file($_FILES["picture"]["tmp_name"], $destination);
                    
                    echo("<p> Bild wurde hochgeladen! <p>");
                } 
                else
                {
                    echo "Der Dateityp wird nicht unterstützt.";
                }
            }
            ?>

            <?php
            /* Alle Picture anzeigen im Upload Folder */
            $files = scandir("uploads");

            if ($files !== false) {
                if (count($files) > 2){
                    echo "<h2 class=\"mt-2\" >Alle Uploads</h2>";
                }
                else { echo "<h5 class=\"mt-2\">Keine Uploads vorhande!</h5>";}

                for ($i = 2; $i < count($files); $i++) {
                    $file = $files[$i];
                    if (pathinfo($file, PATHINFO_EXTENSION) == "jpg" || pathinfo($file, PATHINFO_EXTENSION) == "jpeg") {
                        echo '<a href="index.php?include=admin&pic='. $file . '">' . $file . '</a><br>';
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
            ?>
        </div>
    </body>
</html>