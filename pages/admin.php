<!DOCTYPE html>
<html>
    <head>
        <title>Upload</title>
    </head>

    <body>
        <div class="container-md">
            <h1 class="mt-3">File Upload</h1>

            <form action="index.php?include=admin" enctype="multipart/form-data" method="post">
                <input type="file" name="picture" accept="image/jpeg"></br>
                <input type="submit" class="btn btn-outline cblue mt-2 mb-2" value="Hochladen"/>
            </form>
            
            <?php
            if(isset($_FILES["picture"]))
            {
                if($_FILES["picture"]["type"] == "image/jpeg")
                {
                    $destination = getcwd(). "/uploads/" . uniqid() . "_" . $_FILES["picture"]["name"];

                    var_dump($destination);
                    
                    move_uploaded_file($_FILES["picture"]["tmp_name"], $destination);
                    
                    echo("Bild wurde hochgeladen!");
                } 
                else
                {
                    echo "Der Dateityp wird nicht unterstützt.";
                }
            }
            ?>

            <h2>All Uploads</h2>

            <?php
            $files = scandir("uploads");

            if ($files !== false) {
                foreach ($files as $file) {
                    if (pathinfo($file, PATHINFO_EXTENSION) == "jpg" || pathinfo($file, PATHINFO_EXTENSION) == "jpeg") {
                        echo '<a href="index.php?include=admin&pic='. $file . '">' . $file . '</a><br>';
                    } else {
                        echo $file . "<br>";
                    }
                }
            } else {
                echo "Failed to retrieve the list of files.";
            }

            if(isset($_GET["pic"]))
            {

                if (in_array($_GET["pic"], $files))
                {
                    echo('<h3 >Selected Image</h3>');
                    echo '<img src="uploads/' . $_GET["pic"] . '" alt="Bild" width="auto" height="200" class="rounded border mb-3">';
                }
            }
            ?>
        </div>
    </body>
</html>