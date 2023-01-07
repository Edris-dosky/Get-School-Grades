<?php

use User as GlobalUser;

class User{

    public $id;
    public $username;
    public $password;
    public $rule;

    public static function get_all(){
       return self::query_proccess("SELECT * FROM `student` ");
    }

    public static function get_by_id($userid){
        $single_data = self:: query_proccess("SELECT * FROM `student` WHERE `id` = '$userid'");
        return !empty($single_data) ? array_shift($single_data) : false ;
    }

    public static function query_proccess($sql){
        global $db; 
        $all_data = array();
        $result = $db->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            $all_data[] = self::instant($row);
        }
        return $all_data ;
    }   

    public static function instant($columns){
        $class = new self;
        foreach ($columns as $property => $value) {
            if(array_key_exists($property,(get_object_vars(new self)))){
                $class->$property = $value ;
            }
        }
        return $class ;
    }

    public static function verify($username , $password){
        $password = hash('gost',$password);
        $result = self::query_proccess("SELECT * FROM `student` WHERE `username` = '$username' AND `password` = '$password'");
        return !empty($result) ? array_shift($result) : false ;
    }

    public function create(){
        global $db ;
        $username = $db->secure($this->username);
        $password = $db->secure($this->password);
        $rule = $db->secure($this->rule);

        $execute = $db->query("INSERT INTO `student` (`username`, `password`, `rule`) VALUES ('$username', '$password', '$rule')");
        if($execute){
            return true ;
        }else{
            return false;
        }
    }

    public function update(){
        global $db ;
        $id = $db->secure($this->id);
        $username = $db->secure($this->username);
        $password = $db->secure($this->password);
        $rule = $db->secure($this->rule);
        $execute =$db->query("UPDATE `student` SET `username` = '$username' , `password` = '$password', `rule`='$rule' WHERE `id` = '$id'");
        if($execute){
            return true ;
        }else{
            return false;
        }
    }
    
    public function delete(){
        global $db ;
        $id = $db->secure($this->id);
        $execute = $db->query("DELETE FROM `student` WHERE `id` = $id");
    }

}

$user = new User();
?>
