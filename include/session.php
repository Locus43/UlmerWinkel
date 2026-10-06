<?php
//starts the admin session with secure cookie settings, use session::start() instead of session_start()

class session{
    public static function start(){
        $https = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';

        //only accept session ids created by the server
        ini_set('session.use_strict_mode', '1');
        session_set_cookie_params([
            'lifetime' => 0,          //cookie ends when the browser is closed
            'path' => '/',
            'secure' => $https,       //only send cookie via https (if site runs on https)
            'httponly' => true,       //no access to the cookie via javascript
            'samesite' => 'Lax'       //cookie is not sent with requests from other sites
        ]);
        session_start();
    }
}
