<?php require_once('includes/nav.php'); ?>
<?php

$ed = user::get_by_id(3);

$ed->username = "karwan";
$ed->update();

?>


</body>
</html>