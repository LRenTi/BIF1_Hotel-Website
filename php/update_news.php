<?php
require("mysql.php");

if(isset($_POST["submit"])){
    $stmt = $mysql->prepare("UPDATE NEWS SET TITLE = :title, TEXT = :content, DATE = :date, IMAGE = :image WHERE ID = :id");
    $stmt->bindParam(":title", $_POST["title"]);
    $stmt->bindParam(":content", $_POST["content"]);
    $stmt->bindParam(":date", $_POST["date"]);
    $stmt->bindParam(":id", $_POST["news_id"]);

    $id = $_POST["news_id"];

    $sel = $mysql->prepare("SELECT * FROM NEWS WHERE ID = :newsid");
    $sel->bindParam(':newsid', $_POST["news_id"]);
    $sel->execute();
    $selnews = $sel->fetch(PDO::FETCH_ASSOC);

    $image = $selnews["IMAGE"];

    $resizedDestination = "";
    
    /* Upload picture */
    if(isset($_FILES["picture"]) && $_FILES["picture"]["type"] == "image/jpeg")
    {
        // Überprüfen Sie, ob es einen Fehler beim Hochladen der Datei gab
        if ($_FILES["picture"]["error"] !== UPLOAD_ERR_OK) {
            die("Es gab einen Fehler beim Hochladen der Datei: " . $_FILES["picture"]["error"]);
        }
    
        $destination = $_SERVER['DOCUMENT_ROOT'] . "/Hotel/uploads/" . uniqid() . "_" . $_FILES["picture"]["name"];
        
        // Überprüfen Sie, ob das Verzeichnis existiert und schreibbar ist
        if (!is_dir(dirname($destination)) || !is_writable(dirname($destination))) {
            die("Das Verzeichnis für den Upload existiert nicht oder ist nicht schreibbar: " . dirname($destination));
        }
        
        if(move_uploaded_file($_FILES["picture"]["tmp_name"], $destination)){
            // Resize image
            $resizedDestination = "../uploads/" . "resized_" . uniqid() . "_" . $_FILES["picture"]["name"];
            $sourceImage = imagecreatefromjpeg($destination);
            $resizedImage = imagecreatetruecolor(720, 480);
            imagecopyresized($resizedImage, $sourceImage, 0, 0, 0, 0, 720, 480, imagesx($sourceImage), imagesy($sourceImage));
            imagejpeg($resizedImage, $resizedDestination);
            imagedestroy($sourceImage);
            imagedestroy($resizedImage);
            unlink($destination);
        }
    }
    
    if(isset($_FILES["picture"]) && $_FILES["picture"]["size"] > 0){
        // Delete old image
        $oldImage = "../" . $image;
        var_dump($oldImage);
        if(file_exists($oldImage)){
            unlink($oldImage);
        }

        $finalDestination = substr($resizedDestination, 3);
        //var_dump($finalDestination);
        $stmt->bindParam(":image", $finalDestination);
    } else {
        $stmt->bindParam(":image", $image);
    }
    
    $stmt->execute();
    header("Location: ../index.php?include=admin&site=newslist&newsid=" . $id . "&msg=success");
}
?>