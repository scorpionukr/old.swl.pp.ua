<?php
require_once("config.php");
if(isset($_POST["email"]) && isset($_POST["telephone"]))
{
	// генерируем дату и время
	$date=date("Y-m-d");
	$time=date("H:i");
	// переменная для хранения ошибок
	$error=0;
	// обрабатываем входящие данные
	// защищаем от SQL иньекций
	$email=mysql_escape_string($_POST["email"]);
	if(filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		$email=filter_var($email, FILTER_VALIDATE_EMAIL);
	}
	else
	{
		$error=1;
		echo "Ошибка, при вводе E-mail.";
	}
	$phone=mysql_escape_string(preg_replace("/[^0-9,\s]/", "", $_POST["telephone"]));
	$phone=substr($phone, 0, 10);
	if(!empty($_POST["package"]))
	{
		$package=mysql_escape_string($_POST["package"]);
	}
	else
	{
		$error=1;
		echo "Ошибка, не выбран пакет.";
	}
	if($error==0)
	{
		$addPreOrder="INSERT INTO `pre-order` (
		`email`,
		`phone`,
		`package`,
		`date`,
		`time`,
		`status`)
		VALUES (
		'".$email."',
		'".$phone."',
		'".$package."',
		'".$date."',
		'".$time."',
		'new')";
		mysql_query($addPreOrder, CONNECT);
		mysql_close(CONNECT);
		// Выводим сообщение что форма успешно отправлена
		echo "Ваша заявка с данными:<br />
		E-mail: ".$email."<br />
		Телефон: ".$phone."<br />
		Успешно отправлена!<br />
		И будет обработана в ближайшее время&hellip;";
	}
}