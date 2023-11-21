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
    <body>
        <div class="bc-blue">
            <!--Header leiste-->
            <div class="d-flex container-md">
                <!-- Logo -->
                <a class="td-none" href="index.php">
                    <div class="d-flex pt-3 pb-3 justify-content-start">
                        <img class="img-fluid" alt="Logo" src="content\logo\LogoHotel.svg" width="100">
                        <h5 class="font-weight-bold text-white d-flex align-self-center" style="font-size:50px;">Hotel</h5>
                    </div>
                </a>
                <!--Upper Start-->
                <div class="navbar d-flex flex-grow-1 justify-content-end align-items-end mb-3 d-none d-sm-flex">
                    <?php
                    if (!isset($_SESSION["usernameSession"])){
                            echo "<a type=\"button\" class=\"btn btn-outline me-2\" href=\"index.php?include=register\">Register</a>";                        
                            echo "<a type=\"button\" class=\"btn btn-outline me-2\" data-bs-toggle=\"modal\" data-bs-target=\"#Login\">Login</a>";
                        }
                    ?>
                    <a type="button" class="btn btn-gold" href="">Jetzt Buchen!</a>
                    </ul>
                </div>
                <!--Upper Ends-->
            </div>
        </div>
        <!-- Nav menu -->
        <nav class="navbar navbar-expand-sm navbar-light bg-lignt">
            <div class="container-md">
                <div class="d-flex d-sm-none justify-content-center">
                    <a type="button" class="btn btn-gold cblue" href="">Jetzt Buchen!</a>       
                </div>
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#n_bar" aria-controls="navbarNavAltMarkup" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="n_bar">
                    <div class="d-flex justify-content-start d-sm-none mt-2 mb-2">
                        <?php
                        if (!isset($_SESSION["usernameSession"])){                        
                            echo "<a type=\"button\" class=\"btn btn-outline cblue me-2\" data-bs-toggle=\"modal\" data-bs-target=\"#Login\">Login</a>";
                            echo "<a type=\"button\" class=\"btn btn-outline cblue me-2\" href=\"index.php?include=register\">Register</a>";
                        }
                        ?>
                    </div>
                    <ul class="navbar-nav">
                        <li><a href="index.php" class="nav-point px-2">Home</a></li>
                        <li><a href="index.php?include=faqs" class="nav-point px-2">FAQs</a></li>
                        <li><a href="index.php?include=impressum" class="nav-point px-2 ">Impressum</a></li>
                        <?php if(isset($_SESSION["usernameSession"])){
                            echo("<li><a href=\"index.php?include=admin\" class=\"nav-point px-2\">Upload</a></li>");}
                        ?>
                    </ul>
                </div>
                <div>
                    <?php
                        if (isset($_SESSION["usernameSession"])){
                            echo "Angemeldet als: " . $_SESSION["usernameSession"];
                        }                        
                        if (isset($_SESSION["usernameSession"])){
                            echo("<a type=\"button\" class=\"btn btn-outline cblue ms-2\" href=\"index.php?include=profile\">Profil</a>");
                        }
                        if (isset($_SESSION["usernameSession"])){
                            echo("<a type=\"button\" class=\"btn btn-outline cblue ms-2\" href=\"php\logout.php\">Logout</a>");
                        }
                    ?>      
                </div>
            </div>
        </nav>
        <hr class="solid m-0 p-0">
        


        <!-- Modal Start -->
    <div class="modal fade" id="Login" tabindex="-1" aria-labelledby="Loginlabel" aria-hidden="true" action="php\login.php">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="LoginLabel">Login</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="php\login.php">
                        <div class="modal-body">
                            <label for="username">Benutzername:</label>
                            <input type="username" class="form-control" id="password" name="username" value="<?php if (isset($_POST["username"])) echo $_POST["username"]; ?>" required>
                            <label for="password">Passwort:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline cblue" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-gold" value="Login" />
                        </div>
                    </form>
                </div>
            </div>
        </div> 
        <!--Modal ende -->   

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



</body>
<body>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
<!--
    <footer class="bc-blue text-white mb-0 navbar navbar-fixed-bottom">
        <p>&copy; 2023 L&A Hotel. Alle Rechte vorbehalten.</p>
    </footer>
-->
</html>
