<?php
if(isset($_POST["userid"]))
{
	// Подключаем  библиотеку конфига
	require_once("../config.php");
	session_start();
	// обрабатываем входящие данные
	// защищаем от SQL иньекций
	$id=mysql_real_escape_string($_POST["userid"]);
	// Удаляем юзера из БД
	$delUser="DELETE FROM `user` WHERE `id`='".$id."'";
	mysql_query($delUser, CONNECT);
}
?>
