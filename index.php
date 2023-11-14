<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="stylesheet.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>
    <header>
        <!-- Logo -->
        <div class="bc-blue">
            <div class="d-flex container">
                <div class="d-flex pt-3 pb-3 justify-content-start">
                    <img class="img-fluid" alt="Logo" src="content\logo\LogoHotel.svg" width="100">
                    <h5 class="font-weight-bold text-white d-flex align-self-center" style="font-size:50px;">Hotel</h5>
                </div>
                <!--Menu Start-->
                <div class="d-flex flex-grow-1 align-items-end justify-content-end">
                    <ul class="nav col-12 col-lg-auto ms-lg-auto mb-2 ms-2 mr-3">
                        <li><a href="index.php" class="nav-point px-2">Home</a></li>
                        <li><a href="index.php?faqs=true" class="nav-point px-2">FAQs</a></li>
                        <li><a href="index.php?impressum=true" class="nav-point px-2 ">Impressum</a></li>
                    </ul>
                    <!--Menu Ends-->
                    <!--Login/Register Start-->
                    <div class="text-end mb-2 d-none d-lg-block">
                        <a href="index.php?register=true" type="button" class="btn btn-outline">Register</a>
                        <a type="button" class="btn btn-white" data-bs-toggle="modal" data-bs-target="#Login">Login</a>
                    </div>
                </div>
            </div>
                <!--Login/Register Ends-->
            </div>
        </div>
        <!-- Modal Start -->
        <div class="modal fade" id="Login" tabindex="-1" aria-labelledby="Loginlabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="LoginLabel">Login</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <label for="benutzername">Benutzername:</label>
                            <input type="benutzername" class="form-control" id="name" name="benutzername" required>
                            <label for="passwort">Passwort:</label>
                            <input type="password" class="form-control" id="passwort" name="passwort" required>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-blue">Login</button>
                    </div>
                </div>
            </div>
        </div>
        <!--Modal ende -->        
    </header>
    <main>
        <?php
		if(isset($_GET["impressum"]) && $_GET["impressum"])
			{
				include("pages/impressum.php");
			}
        else if(isset($_GET["faqs"]) && $_GET["faqs"])
        {
            include("pages/faqs.php");
        }
        else if(isset($_GET["register"]) && $_GET["register"])
        {
            include("pages/register.php");
        }
        else 
            {
            include('pages/home.php');
            }
        ?>
    </main>
    <footer class="bc-blue text-white text-center mb-0">
        <p>&copy; 2023 L&A Hotel. Alle Rechte vorbehalten.</p>
    </footer>
</html>
