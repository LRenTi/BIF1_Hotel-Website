<div class="container-md">
    <h2 class="mt-3 text-center">News bearbeiten</h2>

    <?php
    if (isset($_GET["newsid"]))
    {
        $newsid = $_GET["newsid"];
        require_once("php/mysql.php");
        $stmt = $mysql->prepare("SELECT * FROM NEWS WHERE ID = :newsid");
        $stmt->bindParam(':newsid', $newsid);
        $stmt->execute();
        $news = $stmt->fetch(PDO::FETCH_ASSOC);

        include ("edit_news.php");
    }

    require("php/mysql.php");

    $stmt = $mysql->prepare("SELECT * FROM NEWS ORDER BY DATE DESC");
    $stmt->execute();
    $news = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($news) == 0)
    {
        echo "<h3 class=\"mt-2\" >Keine News vorhanden!</h3>";
        exit();
    }
    
    echo "<div class=\"col-12 border border-2 rounded m-3 p-3\">";
    foreach($news as $newsItem)
    {
        echo "<div class=\"d-flex\">";
        echo "<p>" . $newsItem["TITLE"] . " </p>";
        echo "<p class=\"\">" . date('d.m.Y', strtotime($newsItem["DATE"])) . "</p>";
        echo "<a class=\"\" href=\"index.php?include=admin&site=newslist&newsid=" . $newsItem["ID"] . "\"> bearbeiten </a>";
        echo "</div>";
    }
    echo "</div>";

    ?>
</div>