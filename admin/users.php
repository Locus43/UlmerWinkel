<?php
require_once("../include/db.php");

session_start();
if(!isset($_SESSION['userid'])){
    header("Location: login/index.php");
}

$query = "select email from newsletter where is_confirmed='1'";
$result = db::getInstance()->get_result($query);

?>

<!DOCTYPE HTML>
<!--
	Hyperspace by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
    <title>UlmerWinkel - AdminPage | Nutzerverwaltung</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link href="assets/css/lightbox.css" rel="stylesheet">
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
    <a href="ulmer-winkel.de" class="title">Ulmer Winkel - Nutzerverwaltung</a>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="" class="active">Start</a></li>
            <li><a href="login/index.php?logout">Logout</a></li>
        </ul>
    </nav>
</header>

<!-- Wrapper -->
<div id="wrapper">

    <!-- Main -->
    <section id="main" class="wrapper">
        <div class="inner">
            <h1 class="major">Nutzerverwaltung</h1>
            <p>Hier können Sie neue Nutzer anlegen, bearbeiten, oder löschen.</p><br>
        </div>
    </section>
</div>

<?php
$url = 'http://wehrheim.eu:30/info.json';
$data = file_get_contents($url);
$characters = json_decode($data);
?>

<!-- Footer -->
<footer id="footer" class="wrapper alt">
    <div class="inner">
        <ul class="menu">
            <li>&copy; Ulmer-Winkel. All rights reserved.</li><li><a href="../../impressum.php">Impressum</a></li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li><li><div align="right">Version <?php echo $characters->version; ?></div></li>
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