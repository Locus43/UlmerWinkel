<?php
//protects admin forms against cross-site request forgery
//session::start() has to be called before using this class

class csrf{
    public static function getToken(){
        if(empty($_SESSION['csrf_token'])){
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
    public static function check($token){
        return is_string($token) && !empty($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
    public static function field(){
        return "<input type=\"hidden\" name=\"csrf_token\" value=\"" . csrf::getToken() . "\">";
    }
}
