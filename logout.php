<?php
if (isset($_COOKIE['id'])) {
	setcookie ('id', null, time()-300, '/', '', 0);
	setcookie ('authkey', null, time()-300, '/', '', 0);
	setcookie ('username', null, time()-300, '/', '', 0);
	setcookie ('theme', null, time()-300, '/', '', 0);
	setcookie ('network', null, time()-300, '/', '', 0);
}
header("Location: index.php");
exit();
?>