<?php 
function go($url){
header("location:{$url}");
}

function in($i){
    global $session;

    if ($i = 0){
        if(!$session->get_logged_in()){
            go("login.php");
        }
    }

    if($i = 1){
        if($session->get_logged_in()){
            go("index.php");
        }
    }

}
?>