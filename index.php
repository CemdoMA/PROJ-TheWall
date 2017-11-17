<?php session_start(); ?>

<?php
if(isset($_POST['submit'])) {

    require_once ('dbconnect.php');
    $dbc = mysqli_connect(HOST,USER,PASS,DBNAME) or die('Error connect');

    $username = mysqli_real_escape_string($dbc, htmlentities($_POST['username']));
    $password = mysqli_real_escape_string($dbc, htmlentities($_POST['password']));
    $password = hash('sha512', $password);

    if($username && $password) {
    $query = "SELECT * FROM TheWall_users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($dbc, $query) or die("Fout");
    while($row = mysqli_fetch_array($result)) {
      $_SESSION['username'] = $row['username'];
}


if(mysqli_num_rows($result) == 0) {
  header('Location: inloggen.php?gay=rowin');
}


if(mysqli_num_rows($result) > 0) {
  $username = $_SESSION['username'];
  header('Location: index.php');
}


}}
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


        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                <select name="sortmenu" onchange="this.form.submit()">
                    <option value="" selected disabled>Sorteer op...</option>
                    <option value="date_asc">Datum Oplopend{1 - 31)</option>
                    <option value="date_desc">Datum Aflopend{31 - 1}</option>
                    <option value="descr_asc">Beschrijving Oplopend{A - Z}</option>
                    <option value="descr_desc">Beschrijving Aflopend{Z - A}</option>
                    <option value="Random">Random</option>

                </select>
        </form>

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

<div class="textje">
    <h1><b>The Wall</b></h1>
</div>

<div class="body-wrap">

    <div class="container">


        <?php
        $column = 'date';
        $order = 'DESC';
        if (isset($_POST['sortmenu'])){
            switch ($_POST['sortmenu']){
                case 'date_asc':
                    $column = 'date';
                    $order = 'ASC';
                    break;

                case 'date_desc':
                    $column = 'date';
                    $order = 'DESC';
                    break;

                case 'descr_asc':
                    $column = 'description';
                    $order = 'ASC';
                    break;

                case 'descr_desc':
                    $column = 'description';
                    $order = 'DESC';
                    break;

                case 'Random':
                    $column = 'rand()';
                    $order = '';
                    break;
            }
        }
        ?>

        <?php
        require_once ('dbconnect.php');
        $dbc = mysqli_connect(HOST,USER,PASS,DBNAME) or die('Error connect');

        $query = "SELECT * FROM TheWall_database ORDER BY " . $column ." " . $order;
        $result = mysqli_query($dbc,$query);

        while ($row = mysqli_fetch_array($result)) {

            $id = $row['id'];
            $target = $row['target'];
            $date = $row['date'];
            $username = $row['username'];
            $description = $row['description'];

           echo'<a href="#image'. $id .'" class="">';
           echo'<div class="posts">';
           echo'Geüpload door: ' . $username . '<br>' . '<br>' . 'Geüpload op: ' . $date . '<br>' . '<br>';
           echo'<img src="' . $target . '" /><br>';
           echo'<br>' . $description . '<br>' . '<br>' . '</div> </a>';



           echo'<div class="lightbox short-animate" id="image'. $id .'">
              <img class="long-animate" src="'. $target .'"/>
              </div>
              <div id="lightbox-controls" class="short-animate">
              <a id="close-lightbox" class="long-animate" href="#!"></a>
              </div>
              ';
        }


        mysqli_close($dbc);
        ?>




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
require_once('dbconnect.php');
if(isset($_GET['confirm']) || !empty($_GET['confirm']))
{
    $c_code = $_GET['confirm'];

    $dbc = mysqli_connect(HOST, USER, PASS, DBNAME) or die ('ERROR!');
    $query = "SELECT status FROM TheWall_users WHERE confirm='$c_code'";
    $result = mysqli_query($dbc,$query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if(mysqli_num_rows($result) == 1)
    {
        $query = "UPDATE TheWall_users SET status=1 WHERE confirm='$c_code'";
        $result = mysqli_query($dbc,$query);
        header('Location: login.php');
        echo "<script>alert('Account geactiveerd!')</script>";
    } else {
        echo "<script>alert('Deze link is incorrect!')</script>";
    }
}
