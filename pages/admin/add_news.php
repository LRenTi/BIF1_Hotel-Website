<?php
$msg = "";
/* Upload picture */
if(isset($_FILES["picture"]))
{
    if($_FILES["picture"]["type"] == "image/jpeg")
    {
        $destination = getcwd(). "/uploads/" . uniqid() . "_" . $_FILES["picture"]["name"];
        
        move_uploaded_file($_FILES["picture"]["tmp_name"], $destination);
        
        // Resize image
        $resizedDestination = "uploads/" . "resized_" . uniqid() . "_" . $_FILES["picture"]["name"];
        $sourceImage = imagecreatefromjpeg($destination);
        $resizedImage = imagecreatetruecolor(720, 480);
        imagecopyresized($resizedImage, $sourceImage, 0, 0, 0, 0, 720, 480, imagesx($sourceImage), imagesy($sourceImage));
        imagejpeg($resizedImage, $resizedDestination);
        imagedestroy($sourceImage);
        imagedestroy($resizedImage);
        unlink($destination);
    } 
    else
    {
        echo "Der Dateityp wird nicht unterstützt.";
        exit();
    }
}

/* Create news */
if(isset($_POST["submit"])){
    require("./php/mysql.php");
    echo $mysql->error;

    $stmt = $mysql->prepare("INSERT INTO NEWS (TITLE, TEXT, DATE, IMAGE) VALUES (:title, :content, :date, :picture)");
    echo $mysql->error;
    $stmt->bindParam(":title", $_POST["title"]);
    $stmt->bindParam(":content", $_POST["content"]);
    $stmt->bindParam(":date", $_POST["date"]);
    $stmt->bindParam(":picture", $resizedDestination);
    $stmt->execute();
    $msg = "<p class=\"fw-bold text-center\"style=\"color:green;\">News erfolgreich erstellt!</p></br>";
}
?>
<div class="container-md">
    <h2 class="mt-3 text-center">News erstellen</h2>
    <?php echo $msg; ?>
    <div class="ms-3">
        <form class="mb-3" action="index.php?include=admin&site=newscreate" enctype="multipart/form-data" method="post">
            <label class="fw-bold">Title</label> </br>
            <input type="text" class="form-control mb-2" name="title" required> </br>
            <label class="fw-bold">Content</label>
            <textarea class="form-control mb-2" name="content" rows="5" cols="50" required></textarea>
            <label class="fw-bold">Datum</label> </br>
            <input type="date" class="mb-2" name="date" required> </br>
            <label class="fw-bold">Bild hochladen</label> </br>
            <input type="file" class="mb-2" name="picture" accept="image/jpeg" required></br>
            <div class="text-center">
                <input type="submit" name="submit" class="btn btn-gold mt-2 mb-2 p-1" value="Erstellen"/>
            </div>
        </form>
    </div>
</div>
