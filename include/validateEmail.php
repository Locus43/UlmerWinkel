<?php
require_once("db.php");

class validateEmail{
    public static function validate($email){
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $duplicate = validateEmail::checkForDuplicates($email);
        if(filter_var($email, FILTER_VALIDATE_EMAIL) && $duplicate == false){
            return true;
        }else{
            return false;
        }
    }
    //ToDo: replace if statement with for loop over all rows and check for duplicates -> if different emails, only the first row gets checked
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
    }
}