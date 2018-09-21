<?php
if(isset($_POST["name"]) && isset($_POST["password"]))
{
	// Подключаем  библиотеку конфига
	require_once("../config.php");
	session_start();
	// обрабатываем входящие данные
	// защищаем от SQL иньекций
	$name=mysql_escape_string($_POST["name"]);
	$password=mysql_escape_string($_POST["password"]);
	$phone=mysql_escape_string($_POST["phone"]);
	// добавляем юзера в БД
	$insertUser="INSERT INTO `user` (`name`, `password`, `phone`, `enable`) VALUES ('".$name."', PASSWORD('".$password."'), '".$phone."', '1')";
	mysql_query($insertUser, CONNECT);
}
?>
