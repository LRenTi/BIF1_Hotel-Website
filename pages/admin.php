<?php
    if($_SESSION["roleSession"] != 2)
    {
        header("Location: index.php?include=login");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin</title>
    </head>
    <body>
        <div class="container-md">
            <h1 class="text-center mt-3 fw-bold">Adminsection</h1>

            <div>
            <a type="button" class="btn btn-gold" href="index.php?include=admin&site=">offene Buchungen</a>
                <a type="button" class="btn btn-gold" href="index.php?include=admin&site=">Buchungsverwaltung</a>
                <a type="button" class="btn btn-gold" href="index.php?include=admin&site=userlist">Userverwaltung</a>
                <a type="button" class="btn btn-gold" href="index.php?include=admin&site=newscreate">News erstellen</a>
                <a type="button" class="btn btn-gold" href="index.php?include=admin&site=newslist">News bearbeiten</a>
            </div>

            <?php

                if (!isset($_GET["site"]) && isset($_COOKIE["siteCookie"]))
                {
                    $_GET["site"] = $_COOKIE["siteCookie"];
                }
                    if(isset($_GET["site"]))
                    {
                        if ($_GET["site"] == "newscreate")
                        {
                            include("admin/add_news.php");
                        }
                        if ($_GET["site"] == "newslist")
                        {
                            include("admin/list_news.php");
                        }
                        if ($_GET["site"] == "userlist")
                        {
                            include("admin/list_user.php");
                        }
                    }
                    /*
                    else {
                        include("admin/.php"); // offene Buchungen
                    }*/

            ?>
        </div>
    </body>
</html>

