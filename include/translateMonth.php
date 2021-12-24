<?php


class translateMonth{
    public function translate($month){
        $monthsDE = ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'];

        if($month >= 1){
            return $monthsDE[$month - 1];
        }else{
            return "Januar";
        }
    }
}