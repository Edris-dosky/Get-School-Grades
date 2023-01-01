<?php
require_once('includes/nav.php');

$data = User::get_all();

while ($row = mysqli_fetch_assoc($data)){
   echo $row['username'];
}


?>