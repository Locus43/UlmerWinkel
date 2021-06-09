<?php

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
            $result = $result['email'];
            if($result == $email){
                return true;
            }elseif($result == null){
                return false;
            }
    }
}