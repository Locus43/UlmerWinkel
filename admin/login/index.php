<?php
require_once ("../../include/db.php");

session_start();


$message = "";

if(isset($_GET['login'])){
    $userName = $_POST['username'];
    $password = $_POST['password'];

    $query = "select * from users where username = '" . $userName . "'";
    $result = db::getInstance()->get_result($query);

    if($result !== false && password_verify($password, $result[0][2]) && $result[0][3] == "1"){
        $_SESSION['userid'] = $result[0][0];
        //die('Login erfolgreich. Sie werden nun zum internen Bereich weitergeleitet');
        $message = "<div class=\"info\"><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>Der Login war erfolgreich. Sie werden weitergeleitet.<span class=\"identifier\"><right> - ID: userIdentifier</right></span></div>";
        header('Location: ../index.php');
    }else{
        $message = "<div class=\"alert\"><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>Die Emailadresse und/oder das Passwort waren inkorrekt. Bitte erneut versuchen.<span class=\"identifier\"><right> - ID: userIdentifier</right></span></div>";
    }
}if(isset($_SESSION['userid'])){
    $message = "<div class=\"info\"><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>Sie sind bereits angemeldet.<span class=\"identifier\"><right> - ID: userIdentifier</right></span></div>";
}if(isset($_GET['logout'])){
    session_destroy();
    $message = "<div class=\"info\"><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>Sie haben sich erfolgreich ausgeloggt.<span class=\"identifier\"><right> - ID: userIdentifier</right></span></div>";
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
    <a href="https://ulmerwinkel.evangelische-kirche-elchingen.de" class="title">Ulmer Winkel - Admin Bereich</a>
    <nav>
        <ul>
            <li><a href="">Home</a></li>
            <li><a href="index.php" class="active">Login</a></li>
        </ul>
    </nav>
</header>

<!-- Wrapper -->
<div id="wrapper">

    <!-- Main -->
    <section id="main" class="wrapper">
        <div class="inner">
            <h1 class="major">Login</h1>
            <p>Bitte melden Sie sich an, um den internen Bereich nutzen zu können.</p><br>
            <?php
                echo $message;
                $message = "";
            ?>
            <p>
            <form action="?login=1" method="post">
                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Username" name="username" id="username" required>
                <label for="password"><b>Passwort</b></label>
                <input type="password" placeholder="Passwort" name="password" id="password" required><br>
                <input type="submit" value="Login">
            </form>
            </p>
        </div>
    </section>
</div>

<?php
$currentVersion = file_get_contents("../include/version.vs");
?>

<!-- Footer -->
<footer id="footer" class="wrapper alt">
    <div class="inner">
        <ul class="menu">
            <li>&copy; Jan Wehrheim. All rights reserved.</li><li><a href="">Impressum</a></li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li><li><div align="right">Version <?php echo $currentVersion; ?></div></li>
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

</body>
</html>
 