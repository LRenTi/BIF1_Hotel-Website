<?php
    if($_SESSION["roleSession"] != 2)
    {
        header("Location: index.php?include=login");
    }
?>
    <head>
        <title>Admin</title>
    </head>
    <body>
        <div class="container-md min-vh-100">
            <h1 class="text-center mt-3 fw-bold">Adminsection</h1>

            <div class="d-flex justify-content-center align-items-center">
                <a type="button" class="btn btn-gold me-1" href="index.php?include=admin&site=openbookinglist">offene Buchungen</a>
                <a type="button" class="btn btn-gold me-1" href="index.php?include=admin&site=">Buchungsverwaltung</a>
                <a type="button" class="btn btn-gold me-1" href="index.php?include=admin&site=userlist">Userverwaltung</a>
                <a type="button" class="btn btn-gold me-1" href="index.php?include=admin&site=newscreate">News erstellen</a>
                <a type="button" class="btn btn-gold me-1" href="index.php?include=admin&site=newslist">News bearbeiten</a>
            </div>

            <?php
                // Wenn oben ein link geklickt wird dann wird der GET Parameter "site" gesetzt und die passende seite included
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
                        if ($_GET["site"] == "openbookinglist")
                        {
                            include("admin/list_open_bookings.php");
                        }
                    }

                    else { // Wenn kein GET Parameter gesetzt ist
                        include("admin/list_open_bookings.php");
                    }

            ?>
        </div>
    </body>
</html>

