<?php
if(isset($_POST["logout"]))
{
	session_start();
	unset($_SESSION["user"]);
	header("Location:login.php");
}
?>
