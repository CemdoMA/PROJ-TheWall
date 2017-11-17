<?php
session_start();
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <script src="https://use.fontawesome.com/9f9abd6d60.js"></script>
    <script src="https://code.jquery.com/jquery-1.6.2.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>THE WALL</title>
  </head>

  <body>

    <div class="header_image"></div>


  <div class="header">
      <div class="logo">
          <a href="./index.php"><h1><img src="image/hammer.png" style="height: 35px; " >THE WALL</h1></a>
      </div>

      <nav>
          <ul class="topnav" id="myTopnav">
            <?php
            if(isset($_SESSION['username'])){
              echo '
              <li><a href="./index.php">Welkom terug, '. $_SESSION['username'] .'</a></li>
              <li><a href="./index.php">Home</a></li>
              <li><a href="./foto_uploaden.php">Uploaden</a></li>
              <li><a href="./logout.php">Uitloggen</a></li>
              ';
            } else {
              echo '
              <li><a href="./index.php">Home</a></li>
              <li><a href="./inloggen.php">Inloggen</a></li>
              <li><a href="./registreren.php">Registreren</a></li>
              ';
            }
             ?>

              <li class="icon">
                  <span style="font-size:30px;cursor:pointer; color: white; z-index:9;" onclick="openNav()">&#9776; &nbsp;</span>
              </li>

          </ul>

      </nav>

      <div id="mySidenav" class="sidenav">
          <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
          <?php
          if(isset($_SESSION['username'])){
            echo '
            <li><a href="./index.php">Welkom terug, '. $_SESSION['username'] .'</a></li>
            <li><a href="./index.php">Home</a></li>
            <li><a href="./foto_uploaden.php">Uploaden</a></li>
            <li><a href="./logout.php">Uitloggen</a></li>
            ';
          } else {
            echo '
            <li><a href="./index.php">Home</a></li>
            <li><a href="./inloggen.php">Inloggen</a></li>
            <li><a href="./registreren.php">Registreren</a></li>
            ';
          }
           ?>
      </div>

  </div>

    <div class="body-wrap">
  <div class="login">
    <h2><span style="letter-spacing: 3px;">INLOGGEN</span></h2>
    <form method="post" action="index.php">
        <p>Gebruikersnaam:</p>
        <p><input class="logininput" type="text" name="username" placeholder="Vul hier je gebruikersnaam in" required/></p>
        <p>Wachtwoord:</p>
        <p><input class="logininput" type="password" name="password" placeholder="Vul hier je wachtwoord in" minlength=5 required/></p>
        <p><input type="submit" name="submit" value="Inloggen"/></p>
    </form>

  </div>
</div>

    <div class="footer">
        <div class="footer_wrap">
            <div class="colom">
                <a href="./index.php" target="_blank">Home</a>
                <p><a href="./foto_uploaden.php" target="_blank">Uploaden</a>
                <p><a href="./inloggen.php" target="_blank">Inloggen</a>
                <p><a href="./registreren.php" target="_blank">Registreren</a>
            </div>
            <div class="colom">
                <a href="https://nl-nl.facebook.com/" target="_blank">Facebook</a>
                <p><a href="https://www.instagram.com/?hl=nl" target="_blank">Instagram</a>
                <p><a href="https://twitter.com/?lang=nl" target="_blank">Twitter</a>
                <p><a href="https://www.snapchat.com/l/nl-nl/" target="_blank">Snapchat</a>
            </div>
            <div class="colom">
                <a href="https://www.ma-web.nl/" target="_blank">MediaCollege</a>
                <p><a href="https://www.google.nl/maps/place/Mediacollege+Amsterdam+hoofdgebouw/@52.391117,4.8447474,14.5z/data=!4m13!1m7!3m6!1s0x47c5e28849730d2f:0x9ce34c63c2f1c5ed!2sContactweg+36,+1014+AN+Amsterdam!3b1!8m2!3d52.3910379!4d4.8569872!3m4!1s0x47c5e28849730d2f:0x5dffd675d740eddb!8m2!3d52.3910379!4d4.8569872?hl=nl" target="_blank">Contactweg 36 1060 JA</a>
                <p><a href="https://www.ma-web.nl/opleidingen/opleidingsoverzicht/mediadeveloper/" target="_blank">Media Developer</a>
            </div>
            <div class="colom">
                <a href="./index.php"><h1><img src="image/hammer.png" style="height: 35px">THE WALL</h1></a>
            </div>
        </div>
    </div>




<script src="script/script.js"></script>
<script src="script/script2.js"></script>
</body>
</html>



<?php


?>
