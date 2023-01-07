<?php

use User as GlobalUser;

class User{
    protected static $table = "`student`";
    protected static $columns = array('username','password','rule');
    public $id;
    public $username;
    public $password;
    public $rule;

    public static function get_all(){
       return self::query_proccess("SELECT * FROM ".self::$table." ");
    }

    public static function get_by_id($userid){
        $single_data = self:: query_proccess("SELECT * FROM ".self::$table." WHERE `id` = '$userid'");
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
        $result = self::query_proccess("SELECT * FROM ".self::$table." WHERE `username` = '$username' AND `password` = '$password'");
        return !empty($result) ? array_shift($result) : false ;
    }
    public function properties(){
        $pro = get_object_vars($this);
        $array =array();
        foreach(self::$columns as $column){
            $array[$column] = "'".$column."'";
        }
        return $array;
    }

    public function create(){
        global $db ;
        $pro = $this->properties();
        $db->query("INSERT INTO ".self::$table." (".implode(",",array_keys($pro)).") VALUES (".implode(",",array_values($pro)).")");
    }

    public function update(){
        global $db ;
        $id = $db->secure($this->id);
        $username = $db->secure($this->username);
        $password = $db->secure($this->password);
        $rule = $db->secure($this->rule);
        $execute =$db->query("UPDATE ".self::$table." SET `username` = '$username' , `password` = '$password', `rule`='$rule' WHERE `id` = '$id'");
        if($execute){
            return true ;
        }else{
            return false;
        }
    }
    
    public function delete(){
        global $db ;
        $id = $db->secure($this->id);
        $execute = $db->query("DELETE FROM ".self::$table." WHERE `id` = $id");
    }

}

$user = new User();
?>
