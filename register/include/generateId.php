<?php


class generateId{
    public function generateId(){
        $random = uniqid();
        $id = md5($random);
        return $id;
    }
}