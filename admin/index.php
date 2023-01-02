<?php
require_once('includes/nav.php');

$data = User::get_all();
$sdata = User::get_by_id(1);
echo $sdata->id ;
?>