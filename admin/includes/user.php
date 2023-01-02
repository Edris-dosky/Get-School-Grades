<?php

use User as GlobalUser;

class User{

    public static function get_all(){
       return self::query_proccess("SELECT * FROM `student` ");
    }
    
    public static function get_user_by_id($userid){
        $single_user_data = self:: query_proccess("SELECT * FROM `user` WHERE `id` = '$userid'");
        return !empty($single_user_data) ? array_shift($single_user_data) : false ;
    }

    public static function query_proccess($sql){
        global $db; 
        $data = $db->query($sql);
        return $data ;
    }
}

$user = new User();
?>