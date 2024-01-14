<div class="container-md">
    <h2 class="mt-3 text-center">News bearbeiten</h2>

    <?php
    if (isset($_GET["newsid"]))
    {
        $newsid = $_GET["newsid"];
        require_once("php/dbaccess.php");
        $stmt = $mysql->prepare("SELECT * FROM NEWS WHERE ID = :newsid");
        $stmt->bindParam(':newsid', $newsid);
        $stmt->execute();
        $news = $stmt->fetch(PDO::FETCH_ASSOC);

        include ("edit_news.php");
    }

    require("php/dbaccess.php");

    $stmt = $mysql->prepare("SELECT * FROM NEWS ORDER BY DATE DESC");
    $stmt->execute();
    $news = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($news) == 0)
    {
        echo "<h3 class=\"mt-2\" >Keine News vorhanden!</h3>";
        exit();
    }


    
    echo "<div class=\"col-12 border border-2 rounded m-3 p-3\">";
    foreach($news as $index => $newsItem)
    {
        echo "<div class=\"\">";
        echo "<div class=\"d-flex m-0\">";
        echo "<p class=\"fw-bold m-0\">" . $newsItem["TITLE"] . " </p>";
        echo "<p class=\"m-0 ms-2\">" . date('d.m.Y', strtotime($newsItem["DATE"])) . "</p>";
        echo "</div>";
        echo "<div class=\"d-flex\">";
        echo "<a class=\"nav-point m-0 p-0 ms-3\" href=\"index.php?include=admin&site=newslist&newsid=" . $newsItem["ID"] . "\">bearbeiten</a>";
        echo "<a class=\"nav-point m-0 p-0 ms-2 text-danger\" href=\"index.php?include=admin&site=newslist&delete=" . $newsItem["ID"] . "\" onclick=\"return confirm('Bist du dir sicher, dass die News löschen möchtest? " . $newsItem["TITLE"] . "');\">löschen</a>";
        echo "</div>";
        echo "</div>";
        if ($index < count($news) - 1) {
            echo "<hr>";
        }
    }
    echo "</div>";

    if (isset($_GET["delete"]))
    {
        $deleteNewsId = $_GET["delete"];
        $sel = $mysql->prepare("SELECT * FROM NEWS WHERE ID = :id");
        $sel->bindParam(':id', $deleteNewsId);
        $sel->execute();
        $news = $sel->fetch(PDO::FETCH_ASSOC);
        $image = $news["IMAGE"];
        unlink($image);
        $stmt = $mysql->prepare("DELETE FROM NEWS WHERE ID = :id");
        $stmt->bindParam(':id', $deleteNewsId);
        $stmt->execute();

        echo "<script>alert('News erfolgreich gelöscht!');</script>";
        echo "<script>window.location.href = 'index.php?include=admin&site=newslist';</script>";
    }
    ?>
</div>