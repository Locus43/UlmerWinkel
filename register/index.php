<!--ToDo: Check if at least one topic was chosen-->

<!DOCTYPE HTML>
<!--
	Hyperspace by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
    <title>UlmerWinkel - Newsletter</title>
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
            <li><a href="../index.php#contact">Datenschutz</a></li>
        </ul>
    </nav>
</header>

<!-- Wrapper -->
<div id="wrapper">

    <!-- Main -->
    <section id="main" class="wrapper">
        <div class="inner">
            <h1 class="major">Newsletter</h1>
            <p>
                <form action="register.php">
                    <p>Hier können Sie sich für den Newsletter des Ulmer-Winkel anmelden.</p>
                    <hr>
                    <label for="email"><b>Email-Adresse</b></label>
                    <input type="text" placeholder="Email-Adresse" name="email" id="email" required>
                    <hr>
                    <p>Bitte wählen Sie die Themen, zu denen Sie updates erhalten wollen.</p>
                    <input type="checkbox" id="1" name="topic[]" value="1"><label for="1">Gottesdienste</label>

                    <input type="checkbox" id="2" name="topic[]" value="2"><label for="2">Gruppen/Kreise</label>

                    <input type="checkbox" id="3" name="topic[]" value="3"><label for="3">Fortbildungen/Seminare</label>

                    <input type="checkbox" id="4" name="topic[]" value="4"><label for="4">Konzerte/Theater/Musik</label>

                    <input type="checkbox" id="5" name="topic[]" value="5"><label for="5">Freizeiten/Reisen</label>

                    <input type="checkbox" id="6" name="topic[]" value="6"><label for="6">Ausstellungen/Kunst</label>

                    <input type="checkbox" id="7" name="topic[]" value="7"><label for="7">Feste/Feiern</label>

                    <input type="checkbox" id="8" name="topic[]" value="8"><label for="8">Sport/Spiel</label>

                    <input type="checkbox" id="9" name="topic[]" value="9"><label for="9">Sonstiges</label>

                    <input type="checkbox" id="10" name="topic[]" value="10"><label for="10">Fortbildungen/Seminare</label>

                    <hr>
                    <p>Durch klicken auf "Registrieren", bestätigen Sie, dass Sie mit unseren <a href="">Datenschutzbestimmungen</a> einverstanden sind.</p>
                    <button type="submit" class="button">Registrieren</button>
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
        document.getElementById("email").value="";
        document.getElementById("1").checked=false;
        document.getElementById("2").checked=false;
        document.getElementById("3").checked=false;
        document.getElementById("4").checked=false;
        document.getElementById("5").checked=false;
        document.getElementById("6").checked=false;
        document.getElementById("7").checked=false;
        document.getElementById("8").checked=false;
        document.getElementById("9").checked=false;
        document.getElementById("10").checked=false;
    }
</script>

</body>
</html>