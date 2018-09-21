<?php
if(isset($_POST["name"]) && isset($_POST["password"]))
{
	// Подключаем  библиотеку конфига
	require_once("../config.php");
	session_start();
	// обрабатываем входящие данные
	// защищаем от SQL иньекций
	$name=mysql_real_escape_string($_POST["name"]);
	$password=mysql_real_escape_string($_POST["password"]);
	// ищем в БД совпадения
	$selectUser="SELECT `name`, `password` FROM `user` WHERE `name`='".$name."' AND `password`=PASSWORD('".$password."') AND `enable`='1'";
	$resultUser=mysql_query($selectUser, CONNECT);
	if($rowUser=mysql_fetch_assoc($resultUser))
	{
		$_SESSION["user"]=$rowUser["name"];
		header("Location:index.php");
	}
	else
	{
		header("Location:login.php");
	}
}
?>
