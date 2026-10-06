<?php
require_once("db.php");

class validateEmail{
    //validates the address exactly as it will be stored, so no sanitizing here
    public static function validate($email){
        $duplicate = validateEmail::checkForDuplicates($email);
        if(filter_var($email, FILTER_VALIDATE_EMAIL) && $duplicate == false){
            return true;
        }else{
            return false;
        }
    }
    private static function checkForDuplicates($email){
            $query = "select email from newsletter";
            $result = db::getInstance()->get_result($query);
            if(is_array($result)){
                foreach ($result as $result){
                    $result = $result[0];
                    if($result == $email){
                        return true;
                    }elseif($result == null){
                        return false;
                    }
                }
            }else{
                return false;
            }
    }public static function checkForId($id){
        $query = "select id from newsletter where id = ?";
        $result = db::getInstance()->get_result($query, [$id]);
        if($result){
            return true;
        }else{
            return false;
        }
}
}
