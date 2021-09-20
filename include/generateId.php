<?php


class generateId{
    public static function generateId(){
        $random = uniqid();
        $id = md5($random);
        return $id;
    }
}