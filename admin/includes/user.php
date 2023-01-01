<?php

use User as GlobalUser;

class User{

    public static function get_all(){
       return self::query_proccess("SELECT * FROM `student` ");
    }
    

    public static function query_proccess($sql){
        global $db; 
        $data = $db->query($sql);
        return $data ;
    }
}

$user = new User();
?>