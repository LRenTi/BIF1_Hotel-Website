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
        
        // Resize image
        $resizedDestination = getcwd(). "/uploads/thumbnails/" . "resized_" .uniqid() . "_" . $_FILES["picture"]["name"];
        $sourceImage = imagecreatefromjpeg($destination);
        $resizedImage = imagecreatetruecolor(720, 480);
        imagecopyresized($resizedImage, $sourceImage, 0, 0, 0, 0, 720, 480, imagesx($sourceImage), imagesy($sourceImage));
        imagejpeg($resizedImage, $resizedDestination);
        imagedestroy($sourceImage);
        imagedestroy($resizedImage);
        
        echo("<p> Bild wurde erfolgreich auf 720x480 Pixel umgeändert! <p>");
    } 
    else
    {
        echo "Der Dateityp wird nicht unterstützt.";
    }
}
?>
    