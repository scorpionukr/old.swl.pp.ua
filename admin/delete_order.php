<?php
if(isset($_POST["orderid"]))
{
	// Подключаем  библиотеку конфига
	require_once("../config.php");
	session_start();
	// обрабатываем входящие данные
	// защищаем от SQL иньекций
	$id=mysql_real_escape_string($_POST["orderid"]);
	// Удаляем юзера из БД
	$delOrder="DELETE FROM `pre-order` WHERE `id`='".$id."'";
	mysql_query($delOrder, CONNECT);
}
?>