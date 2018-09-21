<?php
if(isset($_POST["email"]) && !empty($_POST["phone"]) && !empty($_POST["package"]))
{
	// Подключаем  библиотеку конфига
	require_once("../config.php");
	session_start();
	// обрабатываем входящие данные
	// защищаем от SQL иньекций
	$id=mysql_real_escape_string($_POST["orderid"]);
	$email=mysql_real_escape_string($_POST["email"]);
	$phone=mysql_real_escape_string($_POST["phone"]);
	$package=mysql_real_escape_string($_POST["package"]);
	$status=mysql_real_escape_string($_POST["status"]);
	// Вносим изменения в БД
	$updOrder="UPDATE `pre-order` SET
		`email`='".$email."',
		`phone`='".$phone."',
		`package`='".$package."',
		`status`='".$status."'
		WHERE `id`='".$id."'";
	mysql_query($updOrder, CONNECT);
	// выводим результат
	echo "Изменения сохранены.";
}
?>

