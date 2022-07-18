<?php
require_once("../include/db.php");
require_once("../include/dataFetcher.php");
require_once("../include/dataParser.php");


session_start();
if(!isset($_SESSION['userid'])){
    header("Location: login/index.php");
}

/* button section for parse and fetch data */
if(isset($_POST['fetch'])){
    dataFetcher::fetchData();
}if(isset($_POST['parse'])){
    dataParser::getEvents();
}

$query = "select email from newsletter where is_confirmed='1'";
$result = db::getInstance()->get_result($query);

$message = "";

##################################### do not edit/write above this line #####################################

/* check if update is available */
$config = parse_ini_file('../include/config.ini.php');
$versionOnline = $config['version_url'];
$currentVersion = file_get_contents("../include/version.vs");
$versionOnline = file_get_contents($versionOnline);

if($versionOnline != $currentVersion){
    $message = "<div class=\"info\"><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>Es ist ein neues Update des Newsletters vorhanden. Bitte Updaten. Neue Version: <b><i>" . $versionOnline . "</i></b> - Aktuelle Version: <b><i>" . $currentVersion . "</i></b><span class=\"identifier\"><right> - ID: updateNotifier</right></span></div>";
}
?>

<!DOCTYPE HTML>
<!--
	Hyperspace by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
    <title>UlmerWinkel - Newsletter | AdminPage</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link href="assets/css/lightbox.css" rel="stylesheet">
    <link href="assets/css/alertBox.css" rel="stylesheet">
    <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>

    <!-- Scripts -->
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/lightbox.js"></script>
    <script type="text/javascript" src="assets/js/lightbox-plus-jquery.js"></script>
    <script type="text/javascript" src="assets/js/lightbox-plus-jquery.min.js.js"></script>
    <script type="text/javascript" src="assets/js/jQuery.js"></script>
    <script type="text/javascript" src="assets/js/info.js"></script>

</head>
<body class="is-preload">

<!-- Header -->
<header id="header">
    <a href="ulmer-winkel.de" class="title">Ulmer Winkel - Newsletter</a>
    <nav>
        <ul>
            <li><a href="">Home</a></li>
            <li><a href="index.php" class="active">Start</a></li>
            <li><a href="login/index.php?logout">Logout</a></li>
        </ul>
    </nav>
</header>

<!-- Wrapper -->
<div id="wrapper">

    <!-- Main -->
    <section id="main" class="wrapper">
        <div class="inner">
            <h1 class="major">Start</h1>
            <p><?php echo $message; ?></p>
            <p>Herzlich Willkommen auf der Admin-Page vom Ulmer-Winkel Newsletter. Hier haben Sie verschiedenste Möglichkeiten, das Newslettersystem zu administrieren.</p><br>
            <center>
                <button type="" class="button"><a href="newsletter.php">Newsletter verwalten</a></button><br><br>
                <button type="" class="button"><a href="users.php">Userverwaltung</a></button><br><br>
                <form method="post" action="">
                    <button type="" class="button" name="fetch">Daten manuell holen</button><br><br>
                    <button type="" class="button" name="parse">Newsletter manuell senden</button>
                </form>
            </center>
        </div>
    </section>
</div>

<!-- Footer -->
<footer id="footer" class="wrapper alt">
    <div class="inner">
        <ul class="menu">
            <li>&copy; Ulmer-Winkel. All rights reserved.</li><li><a href="../../impressum.php">Impressum</a></li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li><li><div align="right">Version <a href="https://github.com/Locus43/UlmerWinkel/releases"><?php echo $currentVersion; ?></a></div></li>
        </ul>
    </div>
</footer>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.scrollex.min.js"></script>
<script src="assets/js/jquery.scrolly.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>
<script>
    clearform();
    function clearform(){
        document.getElementById("subject").value="";
        document.getElementById("mailText").value="";
    }
</script>

</body>
</html>