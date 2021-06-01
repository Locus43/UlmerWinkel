<?php

class validateEmail{
    public function validate($email){
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }
    }
}