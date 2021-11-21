<?php
require_once ("../../include/db.php");

session_start();

if(isset($_GET['login'])){
    $userName = $_POST['username'];
    $password = $_POST['password'];

    $query = "select * from users where email = $userName";
    $result = db::get_result($query);
    $user = $result;

    if($user !== false && password_verify($password, $user['password'])){
        $_SESSION['userid'] = $user['id'];
        die('Login erfolgreich. Sie werden nun zum internen Bereich weitergeleitet');
        header('../index.php');
        die();
    }else{
        $error = "Emailadresse oder Passwort waren ungültig!";
    }
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
            <p>Bitte melden Sie sich an, um den internen Bereich nutzen zu können.</p>
            <p>
            <form action="?login=1" method="post">
                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Username" name="username" id="username" required>
                <label for="password"><b>Passwort</b></label>
                <input type="password" placeholder="Passwort" name="password" id="password" required>
                <input type="submit" value="Login">
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
            <li>&copy; Jan Wehrheim. All rights reserved.</li><li><a href="">Impressum</a></li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li><li><div align="right">Version <?php echo $characters->version; ?></div></li>
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
