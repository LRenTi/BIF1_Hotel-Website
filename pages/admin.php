<?php
    if($_SESSION["usernameSession"] != "admin")
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
                <a type="button" class="btn btn-gold" href="index.php?include=admin&site=newscreate">News erstellen</a>
                <a type="button" class="btn btn-gold" href="index.php?include=admin&site=">???</a>
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
                    }
                    /*
                    else {
                        include("admin/.php");
                    }*/

            ?>
        </div>
    </body>
</html>

