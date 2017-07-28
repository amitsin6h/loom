<?php
session_start();
if(isset($_GET['logoff']))
{
	session_destroy();
	header("Location: index.php");
	exit();
}