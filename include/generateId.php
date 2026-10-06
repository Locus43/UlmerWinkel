<?php


class generateId{
    public function generateId(){
        //cryptographically secure, 32 hex chars like the former md5 ids
        $id = bin2hex(random_bytes(16));
        return $id;
    }
}