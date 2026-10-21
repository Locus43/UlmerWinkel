<?php
//blocks an ip for some minutes after too many failed admin logins
//failed attempts are stored per ip in php's temp dir (outside of the webroot), no db table needed

class loginThrottle{
    const MAX_ATTEMPTS = 5;
    const LOCK_SECONDS = 900; //15 minutes

    public static function isBlocked($ip){
        return count(loginThrottle::getAttempts($ip)) >= loginThrottle::MAX_ATTEMPTS;
    }
    public static function registerFailure($ip){
        $attempts = loginThrottle::getAttempts($ip);
        $attempts[] = time();
        file_put_contents(loginThrottle::getFile($ip), json_encode($attempts), LOCK_EX);
    }
    public static function reset($ip){
        $file = loginThrottle::getFile($ip);
        if(file_exists($file)){
            unlink($file);
        }
    }
    //returns timestamps of failed attempts within the lock period
    private static function getAttempts($ip){
        $file = loginThrottle::getFile($ip);
        if(!file_exists($file)){
            return [];
        }
        $attempts = json_decode(file_get_contents($file), true);
        if(!is_array($attempts)){
            return [];
        }
        $limit = time() - loginThrottle::LOCK_SECONDS;
        return array_values(array_filter($attempts, function($time) use ($limit){
            return $time > $limit;
        }));
    }
    private static function getFile($ip){
        //hash the ip, so it can be used as file name (e.g. ipv6 contains ':')
        return sys_get_temp_dir() . DIRECTORY_SEPARATOR . "ulmerwinkel_login_" . hash('sha256', $ip);
    }
}
