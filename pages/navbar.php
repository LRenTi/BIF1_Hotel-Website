<!DOCTYPE html>
<html>
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
                if (!isset($_SESSION["usernameSession"])) {
                    echo "<a type=\"button\" class=\"btn btn-outline me-2\" href=\"index.php?include=register\">Register</a>";
                    echo "<a type=\"button\" class=\"btn btn-outline me-2\" href=\"index.php?include=login\">Login</a>";
                } else {
                    require_once(__DIR__ . "/../php/mysql.php");
                    $username = $_SESSION["usernameSession"];
                    $stmt = $mysql->prepare("SELECT * FROM ACCOUNTS WHERE USERNAME = :username");
                    $stmt->bindParam(':username', $username);
                    $stmt->execute();
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                    echo "<div class=\"d-flex align-items-center text-white fw-bold\">";
                    if ($user["ANREDE"] == "Herr") {
                        echo "<a class=\"nav-point text-white\"> Herr " . $user["NACHNAME"] . "</a>";
                    } else if ($user["ANREDE"] == "Frau") {
                        echo "<a class=\"nav-point text-white\"> Frau " . $user["NACHNAME"] . "</a>";
                    } else {
                        echo "<a class=\"nav-point text-white\">" . $user["VORNAME"] . " " . $user["NACHNAME"] . "</a>";
                    }
                    echo "</div>";
                }
                ?>
                <a type="button" class="btn btn-gold" href="">Jetzt Buchen!</a>
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
                    if (!isset($_SESSION["usernameSession"])) {
                        echo "<a type=\"button\" class=\"btn btn-outline cblue me-2\" href=\"index.php?include=login\">Login</a>";
                        echo "<a type=\"button\" class=\"btn btn-outline cblue me-2\" href=\"index.php?include=register\">Register</a>";
                    }
                    ?>
                </div>
                <ul class="navbar-nav">
                    <li><a href="index.php" class="nav-point px-2">Home</a></li>
                    <li><a href="index.php?include=news" class="nav-point px-2 ">News</a></li>
                    <li><a href="index.php?include=faqs" class="nav-point px-2">FAQs</a></li>
                    <li><a href="index.php?include=impressum" class="nav-point px-2 ">Impressum</a></li>
                    <?php

                    ?>
                </ul>
                <?php
                if (isset($_SESSION["usernameSession"])) {
                    echo "<div class=\"d-flex d-sm-none justify-content-center\">";
                    if ($_SESSION["usernameSession"] == "admin") {
                        echo "<a type=\"button\" class=\"btn btn-red cblue ms-2\" href=\"index.php?include=admin\">Admin</a></li>";
                    }
                    echo "<a type=\"button\" class=\"btn btn-outline cblue ms-2\" href=\"index.php?include=profile\">Profil</a>";
                    echo "<a type=\"button\" class=\"btn btn-outline cblue ms-2\" href=\"php\logout.php\">Logout</a>";
                    echo "</div>";
                }
                ?>
            </div>
            <?php
            if (isset($_SESSION["usernameSession"])) {
                echo "<div class=\"d-none d-sm-flex justify-content-end\">";
                if ($_SESSION["usernameSession"] == "admin") {
                    echo "<a type=\"button\" class=\"btn btn-red cblue ms-2\" href=\"index.php?include=admin\">Admin</a></li>";
                }
                echo "<a type=\"button\" class=\"btn btn-outline cblue ms-2\" href=\"index.php?include=profile\">Profil</a>";
                echo "<a type=\"button\" class=\"btn btn-outline cblue ms-2\" href=\"php\logout.php\">Logout</a>";
                echo "</div>";
            }
            ?>
        </div>
    </nav>
    <hr class="solid m-0 p-0">
</body>
</html>