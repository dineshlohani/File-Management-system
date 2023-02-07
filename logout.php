<?php require_once('includes/session.php');
require_once('includes/config.php');
require_once('includes/database.php');
require_once('includes/database_object.php');
require_once('includes/functions.php');
require_once('includes/user.php');

	$session->logout();
	redirect_to('login.php');
?>