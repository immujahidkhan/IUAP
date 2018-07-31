<?php
session_start();
include_once "../../config.php";
if($class->doLogout())
{
	$class->redirect("login.php");
}
?>