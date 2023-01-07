<?php require_once('includes/nav.php'); ?>
<?php
$b = user::get_by_id(3);
$b->username = "karwan";
$b->update();

?>

    
</body>
</html>