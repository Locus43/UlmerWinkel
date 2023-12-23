;<?php die();?>
[submit]
submitSubject = "Ulmer-Winkel - Newsletter | Bitte bestätigen Sie Ihre Email-Adresse"
submitText = "
<!DOCTYPE html>
<html lang=\"en\" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset=\"utf-8\"> <!-- utf-8 works for most cases -->
    <meta name=\"viewport\" content=\"width=device-width\"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name=\"x-apple-disable-message-reformatting\">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title>Ulmer-Winkel Newsletter</title> <!-- The title tag shows in email notifications, like Android 4.4. -->
    <style>
        html { background-color: #CCC;}
    </style>
</head>

<body>

<center>
    <div id='email' style='width:900px;'>

        <table role='presentation' cellpadding='15px' border='0' width='100%'>
            <tr>
                <td bgcolor='#FFFFFF'>
                    <h1>Ulmer-Winkel Newsletter</h1>
                    <p>
                        Hallo, <br>
                        vielen Dank für Ihre Registrierung für unseren Newsletter. Um Ihre Email-Adresse zu bestätigen, klicken Sie bitte <a href=\"{{BASE_URL}}/submit/index.php?id={{SUBMIT_ID}}\">hier</a>.<br>
                        Sollten Sie diesen Newsletter nicht bestellt haben, ignorieren oder löschen Sie bitte diese Email.<br>
                        Mit freundlichen Grüßen<br>
                        Das Ulmer-Winkel Team<br><br>
                    </p>
<p>&copy; Ulmer-Winkel. All rights reserved.<br>
    Dies ist eine automatisch generierte Email. Bitte antworten Sie nicht auf diese Email.</p>
                </td>
</tr>
</table>

</div>
</center>
</body>"

[newsletter]
newsletterSubject = "Ulmer-Winkel - Newsletter | {{TOPIC}}"
newsletterText = "
<!DOCTYPE html>
<html lang=\"en\" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset=\"utf-8\"> <!-- utf-8 works for most cases -->
    <meta name=\"viewport\" content=\"width=device-width\"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name=\"x-apple-disable-message-reformatting\">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title>Ulmer-Winkel Newsletter</title> <!-- The title tag shows in email notifications, like Android 4.4. -->
    <style>
        html { background-color: #CCC;}
    </style>
</head>

<body>

<center>
    <div id='email' style='width:900px;'>

        <table role='presentation' cellpadding='15px' border='0' width='100%'>
            <tr>
                <td bgcolor='#FFFFFF'>
                    <h1>Ulmer-Winkel Newsletter</h1>
                    <p>Guten morgen, <br>Das Wochenende steht bevor und das heißt: Es gibt neue Termine in den Kirchengemeinden.<br>
                        Mit dieser Email informieren wir Sie, über die aktuellen und kommenden Termine im Ulmer-Winkel.<br>
                        Kommen Sie gut in das Wochenende!<br> Ihr Ulmer-Winkel<br><br>
                        <i>Beachten Sie bitte, dass es aufgrund der aktuellen Lage zu kurzfristigen Änderungen kommen kann.</i></p>
                    <p>
                        <center><h2>{{MONTH}}</h2></center>
                        <table role='presentation' border=1 frame=void rules=rows width='100%'>
                            {{BODY}}
                        </table>
                    </p>
                    <!--
                    <p>{{BODY}}</p>
                    -->
                    <p>&copy; Ulmer-Winkel. All rights reserved.<br>Dies ist eine automatisch generierte Email. Bitte antworten Sie nicht auf diese Email.<br>Wenn Sie unseren Newsletter nicht mehr bekommen möchten, klicken Sie bitte <a href=\"{{UNSUBSCRIBE_LINK}}\">hier.</a></p>
                </td>
            </tr>
        </table>

    </div>
</center>
</body>"

[manualNewsletter]
newsletterSubject = "Ulmer-Winkel - Newsletter | Mitteilung"
newsletterText = "
<!DOCTYPE html>
<html lang=\"en\" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset=\"utf-8\"> <!-- utf-8 works for most cases -->
    <meta name=\"viewport\" content=\"width=device-width\"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name=\"x-apple-disable-message-reformatting\">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title>Ulmer-Winkel Newsletter - Mitteilung</title> <!-- The title tag shows in email notifications, like Android 4.4. -->
    <style>
        html { background-color: #CCC;}
    </style>
</head>

<body>

<center>
    <div id='email' style='width:900px;'>

        <table role='presentation' cellpadding='15px' border='0' width='100%'>
            <tr>
                <td bgcolor='#FFFFFF'>
                    <h1>Ulmer-Winkel Newsletter</h1>
                    <p>Hallo, <br>Es gibt eine neue, manuelle Mitteilung für Sie.<br></p>
                    <p>
                        <center><h2>Mitteilung</h2></center>
<table role='presentation' border=1 frame=void rules=rows width='100%'>
    {{BODY}}
</table><br>
Mit freundlichen Grüßen<br>
Ihr UlmerWinkel
</p>
<p>&copy; Ulmer-Winkel. All rights reserved.<br>Dies ist eine automatisch generierte Email. Bitte antworten Sie nicht auf diese Email.<br>Wenn Sie unseren Newsletter nicht mehr bekommen möchten, klicken Sie bitte <a href=\"{{UNSUBSCRIBE_LINK}}\">hier.</a></p>
</td>
</tr>
</table>
</div>
</center>
</body>"