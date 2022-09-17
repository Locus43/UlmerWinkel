<?php
require_once("db.php");

class validateEmail{
    public function validate($email){
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $duplicate = validateEmail::checkForDuplicates($email);
        if(filter_var($email, FILTER_VALIDATE_EMAIL) && $duplicate == false){
            return true;
        }else{
            return false;
        }
    }
    private function checkForDuplicates($email){
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
    }public function checkForId($id){
        $query = "select id from newsletter where id='" . $id . "'";
        $result = db::getInstance()->get_result($query);
        if($result){
            return true;
        }else{
            return false;
        }
}
}
