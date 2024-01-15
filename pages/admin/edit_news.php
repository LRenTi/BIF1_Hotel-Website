<div class="container-md ">
    <a href="index.php?include=admin&site=newslist" class="btn btn-outline cblue ">Zurück</a>
    <h3 class="mt-3 fw-bold"> <?php echo $news["TITLE"] ?? ""; ?></h3>
    <?php 
        if(isset($_GET["msg"])){
            if ($_GET["msg"] == "success") {
                echo "<p class=\"fw-bold\"style=\"color:green;\">News erfolgreich aktualisiert!</p></br>";
            }
        }
    ?>
    <div class="ms-3">
        <form class="mb-3" action="./php/update_news.php" enctype="multipart/form-data" method="post">
            <label class="fw-bold">Title</label> </br>
            <input type="text" class="form-control mb-2" name="title" value="<?php echo $news["TITLE"] ?? ""; ?>"> </br>
            <label class="fw-bold">Content</label>
            <textarea class="form-control mb-2" name="content" rows="5" cols="50"><?php echo $news["TEXT"] ?? ""; ?></textarea>
            <label class="fw-bold">Datum</label> </br>
            <input type="date" class="mb-2" name="date" value="<?php echo $news["DATE"] ?? ""; ?>"> </br>
            <label class="fw-bold">Bild ändern</label> </br>
            <p class="mt-1 ms-3 mb-0">Aktuelles Bild:</p>
            <img class="ms-3 mt-0 mb-2" src="<?php echo $news["IMAGE"] ?? ""; ?>" width="300px"> </br>
            <p class="mt-1 ms-3 mb-2">Anderes Bild auswählen:</p>
            <input type="file" class=" mt-0 ms-3 mb-2" name="picture" accept="image/jpeg"></br>
            <input type="hidden" name="news_id" value="<?php echo $news["ID"] ?? ""; ?>">
            <div class="text-center">
                <input type="submit" name="submit" class="btn btn-gold mt-2 mb-2 p-1" value="Änderungen Speichern"/>
            </div>
        </form>
    </div>
</div>