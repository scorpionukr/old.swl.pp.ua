<?php
// config file
$httpHost="https://swl.pp.ua";
$title="Scorpion web lair";
$metaDescription="Scorpion web lair, разработка сайтов";
$metaKeywords="landing page, лендинг, разработка сайтов, создание сайтов, создание страниц, сайт под ключ, размещение на хостинге, редизайн сайта";
$metaAuthor="Scorpion";

$login="scorpion";
$password="fyybubkzwbz";
$server="localhost";
$db="scorp-web";
// Подключение к БД (старый метод)
$connect=mysql_connect($server, $login, $password) or die("<br>Не могу подключится к MySQL! <font color='#f00'>Scorpion server</font><br>");
mysql_select_db($db, $connect) || die("Не найдена DB: ".$db.". Error if any was: ".mysql_error() );
mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
define( "CONNECT", $connect );
?>
