<?php
if(isset($_POST["name"]) && !empty($_POST["password"]))
{
	// Подключаем  библиотеку конфига
	require_once("../config.php");
	session_start();
	// обрабатываем входящие данные
	// защищаем от SQL иньекций
	$id=mysql_real_escape_string($_POST["userid"]);
	$name=mysql_real_escape_string($_POST["name"]);
	$password=mysql_real_escape_string($_POST["password"]);
	$phone=mysql_real_escape_string($_POST["phone"]);
	$status=mysql_real_escape_string($_POST["enable"]);
	// Вносим изменения в БД
	$updUser="UPDATE `user` SET
		`name`='".$name."',
		`password`=PASSWORD('".$password."'),
		`phone`='".$phone."',
		`enable`='".$status."'
		WHERE `id`='".$id."'";
	mysql_query($updUser, CONNECT);
	// выводим результат
	echo "Изменения сохранены.";
}
?>
