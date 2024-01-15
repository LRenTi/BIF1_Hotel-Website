<!DOCTYPE html>
<html>
    <head>
        <title>Willkommen im L&A Hotel!</title>
    </head>
<body>
  <section class="d-flex justify-content-center bghome overlay" style="background-image: url(content/pictures/StockHoteldark50.png); min-height:100vh;">
    <div class="overlay"></div>
    <div>
      <?php
      // unterscheidet zwischen eingeloggt und nicht eingeloggt
        if(!isset($_SESSION["usernameSession"]))
        {
            echo("<h2 class=\"display-1 text-center t\">Herzlich Willkommen </br> im L&A Hotel!</h2>");
        }
        if(isset($_SION["usernameSession"]))
        {
            echo("<h2 class=\"display-1 text-center text-white\">Herzlich Willkommen</br>" . $_SESSION["usernameSession"] . "</br>im L&A Hotel!</h2>");
        }
      ?>
    </div>
  </section>
</body>
</html>