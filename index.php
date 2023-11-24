<?php
    session_start();
    setcookie("includeCookie", time()+3600);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="stylesheet.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    </head>

    <?php
        include("pages/navbar.php");
    ?>

    <body>

        <?php

        if (!isset($_GET["includepart"]) && isset($_COOKIE["includepartCookie"]))
        {
            $_GET["includepart"] = $_COOKIE["includepartCookie"];
        }

			if(isset($_GET["include"]))
			{

                if ($_GET["include"] == "home")
				{
					include("pages/home.php");
				} 
				if ($_GET["include"] == "impressum")
				{
					include("pages/impressum.php");
				} 
				else if ($_GET["include"] == "faqs")
				{
					include("pages/faqs.php");
				}
                else if ($_GET["include"] == "login")
				{
					include("pages/login.php");
				}
                else if ($_GET["include"] == "register")
				{
					include("pages/register.php");
				}
                else if ($_GET["include"] == "profile")
				{
					include("pages/profile.php");
				}
                else if ($_GET["include"] == "admin")
				{
					include("pages/admin.php");
				}
			}
            
            else {
                include('pages/home.php');
                }

    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

<?php
    include("pages/footer.php");
?>

</html>
