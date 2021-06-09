<?php
require_once("../include/db.php");

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
    <title>UlmerWinkel - Newsletter | AdminPage</title>
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
    <a href="https://ulmerwinkel.evangelische-kirche-elchingen.de" class="title">Ulmer Winkel - Newsletter</a>
    <nav>
        <ul>
            <li><a href="">Home</a></li>
            <li><a href="index.php" class="active">Newsletter</a></li>
        </ul>
    </nav>
</header>

<!-- Wrapper -->
<div id="wrapper">

    <!-- Main -->
    <section id="main" class="wrapper">
        <div class="inner">
            <h1 class="major">Newsletter</h1>
            <p>Herzlich Willkommen auf der Admin-Page vom Ulmer-Winkel Newsletter. Hier können Sie einen neuen Newsletter verfassen und entweder an alle senden, oder aber auch an einzelne Personen. Wählen Sie hierzu bitte die
                entsprechende Option im Drop-Down Menü.
                </p>
            <p>
                <form action="bakeCake.php">
                    <p>Hier können Sie den Newsletter verfassen. HTML-Tags werden unterstützt. Eine entsprechende Liste gibt es <a href="https://www.mediaevent.de/html/html5-tags.html">hier.</a></p>
                    <hr>
                    <select name="emailOption">
                        <option value="all">Alle</option>
                        <?php
                            for($i = 0; $i < count($result); $i++){
                              echo "<option value='" . $result[$i][0] . "'>" . $result[$i][0] . "</option>";
                             }
                        ?>
                    </select>
                    <br>
                    <br>
                    <input type="text" id="subject" name="subject" placeholder="Betreff" required>
                    <br>
                    <textarea id="mailText" name="mailText" placeholder="Newsletter" required></textarea>
                    <hr>
                    <button type="submit" class="button">Abschicken</button>
                </form>
            </p>
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
            <li>&copy; Evangelische Kirchengemeinde Elchingen. All rights reserved.</li><li><a href="/kirche/impressum.php">Impressum</a></li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li><li><div align="right">Version <?php echo $characters->version; ?></div></li>
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