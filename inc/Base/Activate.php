<?php
namespace Inc\Base;

Class Activate{

    public static function activate(){
        flush_rewrite_rules();
    }
}