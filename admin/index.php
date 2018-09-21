<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location:login.php");
} else {
    // Подключаем  библиотеку конфига
    require_once("../config.php");

    // Достаем заказы
    $selectOrders = "SELECT `id`, `email`, `phone`, `package`, `date`, `time`, `status` FROM `pre-order` ORDER BY `id` ASC LIMIT 20";
    $resultOrders = mysql_query($selectOrders, CONNECT);
    // Достаем пользователей
    $selectUsers = "SELECT `id`, `name`, `phone`, `enable` FROM `user` ORDER BY `id` ASC LIMIT 20";
    $resultUsers = mysql_query($selectUsers, CONNECT);
    ?>
    <!DOCTYPE html>
    <html lang="ru">
        <head>
    	<title>Scorpion web lair -> Админка</title>
    	<meta charset="utf-8">
    	<meta name="author" content="<? echo $metaAuthor; ?>">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<!-- CSS -->
    	<link rel="stylesheet" type="text/css" href="/style/style.css">
    	<!-- Bootstrap -->
    	<link rel="stylesheet" type="text/css" href="/js/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    	<link rel="stylesheet" type="text/css" href="/js/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    	<!-- JavaScript -->
    	<script src="/js/jquery/jquery-1.11.1.min.js"></script>
    	<script src="/js/bootstrap/js/bootstrap.min.js"></script>
    	<script src="/js/showhide.js"></script>
    	<script src="/js/send_order.js"></script>
    	<script src="/js/edit_user.js"></script>
	<script src="/js/edit_order.js"></script>
        </head>
        <body class="bg-main">
    	<!-- HEAD DIV -->
    	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    	    <div class="container-fluid">
    		<!-- Brand and toggle get grouped for better mobile display -->
    		<div class="navbar-header">
    		    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#head-navigation">
    			<span class="sr-only">Toggle navigation</span>
    			<span class="icon-bar"></span>
    			<span class="icon-bar"></span>
    			<span class="icon-bar"></span>
    		    </button>
    		    <a class="navbar-brand text-logo" href="index.php">Scorpion web lair</a>
    		</div>
    		<!-- Collect the nav links, forms, and other content for toggling -->
    		<div class="collapse navbar-collapse" id="head-navigation">
    		    <ul class="nav navbar-nav">
    			<li><a href="/index.php" target="_blank">Главная сайта</a></li>
    			<li><a href="javascript:void(null);" onClick="showHide('orders', 'fix-padding');">Заказы</a></li>
    			<li><a href="javascript:void(null);" onClick="showHide('users', 'fix-padding');">Пользователи</a></li>
    			<li><a href="javascript:void(null);" onClick="showHide('server-info', 'fix-padding');">Инфо</a></li>
    			<li><a href="javascript:void(null);">Здравствуйте, <? echo $_SESSION["user"]; ?></a></li>
    		    </ul>
    		    <form role="form" method="POST" action="logout.php" class="navbar-form navbar-right">
    			<button type="submit" name="logout" class="btn btn-danger">Выход <span class="glyphicon glyphicon-off"></span></button>
    		    </form>
    		</div><!-- /.navbar-collapse -->
    	    </div><!-- /.container-fluid -->
    	</nav>
    	<!-- CONTENT DIV -->
    	<!-- INFO -->
    	<div class="fix-padding" id="server-info">
    	    <div class="container-fluid">
    		<div class="row">
    		    <!-- LEFT MENU DIV -->
    		    <div class="col-md-2">
    			<div class="well well-small colorist">
    			    <ul class="nav nav-pills nav-stacked">
    				<li><a href="javascript:void(null);" class="admin-link">Инфо</a></li>
    			    </ul>
    			</div>
    		    </div>
    		    <!-- MAIN DIV -->
    		    <div class="col-md-10">
    			<p><b>Информация о сервере</b></p>
    			<table class="table table-bordered table-hover">
    			    <tr class="warning">
    				<td>Сервер:</td>
    				<td><? echo $_SERVER["SERVER_SOFTWARE"]; ?></td>
    			    </tr>
    			    <tr class="warning">
    				<td>IP:</td>
    				<td><? echo $_SERVER["SERVER_ADDR"]; ?></td>
    			    </tr>
    			    <tr class="warning">
    				<td>Хост:</td>
    				<td><? echo $_SERVER["SERVER_NAME"]; ?></td>
    			    </tr>
    			    <tr class="warning">
    				<td>Порт:</td>
    				<td><? echo $_SERVER["SERVER_PORT"]; ?></td>
    			    </tr>
    			    <tr class="warning">
    				<td>Протокол:</td>
    				<td><? echo $_SERVER["SERVER_PROTOCOL"]; ?></td>
    			    </tr>
    			    <tr class="warning">
    				<td>Версия PHP:</td>
    				<td><? echo phpversion(); ?></td>
    			    </tr>
    			    <tr class="warning">
    				<td>Кодировка:</td>
    				<td><? echo $_SERVER["HTTP_ACCEPT_CHARSET"]; ?></td>
    			    </tr>
    			    <tr class="warning">
    				<td>Язык:</td>
    				<td><? echo $_SERVER["HTTP_ACCEPT_LANGUAGE"]; ?></td>
    			    </tr>
    			</table>
    			<p><b>Информация о клиенте</b></p>
    			<table class="table table-bordered table-hover">
    			    <tr class="warning">
    				<td>IP:</td>
    				<td><? echo $_SERVER["REMOTE_ADDR"]; ?></td>
    			    </tr>
    			    <tr class="warning">
    				<td>Порт:</td>
    				<td><? echo $_SERVER["REMOTE_PORT"]; ?></td>
    			    </tr>
    			    <tr class="warning">
    				<td>Браузер:</td>
    				<td><? echo $_SERVER["HTTP_USER_AGENT"]; ?></td>
    			    </tr>
    			</table>
    		    </div>
    		</div>
    	    </div>
    	</div>
    	<!-- ORDERS -->
    	<div class="fix-padding" id="orders" style="display: none;">
    	    <div class="container-fluid">
    		<div class="row">
    		    <!-- LEFT MENU DIV -->
    		    <div class="col-md-2">
    			<div class="well well-small colorist">
    			    <ul class="nav nav-pills nav-stacked">
    				<li><a href="javascript:void(null);" class="admin-link" onClick="showAll('ordertr');">Все</a></li>
    				<li><a href="javascript:void(null);" class="admin-link" onClick="showHideClass('new', 'ordertr');">Новые</a></li>
    				<li><a href="javascript:void(null);" class="admin-link" onClick="showHideClass('inwork', 'ordertr');">В работе</a></li>
    				<li><a href="javascript:void(null);" class="admin-link" onClick="showHideClass('complete', 'ordertr');">Выполненные</a></li>
    				<li><a href="javascript:void(null);" class="admin-link" onClick="showHideClass('noaccept', 'ordertr');">Не выполненнные</a></li>
    			    </ul>
    			</div>
    		    </div>
    		    <!-- MAIN DIV -->
    		    <div class="col-md-10">
    			<p><b>Заказы</b></p>
    			<table class="table table-bordered table-hover">
    			    <thead>
    				<tr class="active">
    				    <th>ID</th>
    				    <th>Email</th>
    				    <th>Телефон</th>
    				    <th>Пакет</th>
    				    <th>Дата и время</th>
    				    <th>Статус</th>
    				    <th></th>
    				</tr>
    			    </thead>
    			    <tbody>
    <?
    while ($rowOrders = mysql_fetch_array($resultOrders)) {
	// делаем дату в европейском формате
	$explodeDate = explode("-", $rowOrders["date"]);
	$orderDate = $explodeDate[2] . "." . $explodeDate[1] . "." . $explodeDate[0];
	// делаем первую букву в названии пакета заглавной
	$pack = strtoupper(substr($rowOrders["package"], 0, 1));
	$age = substr($rowOrders["package"], 1);
	// определяем статус заказа
	switch ($rowOrders["status"]) {
	    case "new":
		$trColor = "warning ordertr new";
		$status = "Новый";
		break;
	    case "inwork":
		$trColor = "info ordertr inwork";
		$status = "В работе";
		break;
	    case "noaccept":
		$trColor = "danger ordertr noaccept";
		$status = "Не выполнен";
		break;
	    case "complete":
		$trColor = "success ordertr complete";
		$status = "Выполнен";
		break;
	}
	?>
					<tr class="<? echo $trColor; ?>" id="order<? echo $rowOrders["id"]; ?>">
					    <td><? echo $rowOrders["id"]; ?></td>
					    <td><? echo $rowOrders["email"]; ?></td>
					    <td><? echo $rowOrders["phone"]; ?></td>
					    <td><? echo $pack . $age; ?></td>
					    <td><? echo $orderDate; ?> <? echo $rowOrders["time"]; ?></td>
					    <td><? echo $status; ?></td>
					    <td>
						<a href="javascript:void(null);" class="admin-content-link" title="Редактировать" onClick="editOrderModal('<? echo $rowOrders["id"]; ?>');"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;
						<a href="javascript:void(null);" class="admin-content-link" title="Удалить" onClick="deleteOrder('order<? echo $rowOrders["id"]; ?>', '<? echo $rowOrders["id"]; ?>');"><span class="glyphicon glyphicon-remove"></span></a>
					    </td>
					</tr>
	<?
    }
    ?>
    			    </tbody>
    			</table>
    		    </div>
    		</div>
    	    </div>
    	</div>
    	<!-- USERS -->
    	<div class="fix-padding" id="users" style="display: none;">
    	    <div class="container-fluid">
    		<div class="row">
    		    <!-- LEFT MENU DIV -->
    		    <div class="col-md-2">
    			<div class="well well-small colorist">
    			    <ul class="nav nav-pills nav-stacked">
    				<li><a href="javascript:void(null);" class="admin-link" onClick="showHideClass('usertr', 'newuser');">Пользователи</a></li>
    				<li><a href="javascript:void(null);" class="admin-link" onClick="showHideClass('newuser', 'usertr');">Создать пользователя</a></li>
    			    </ul>
    			</div>
    		    </div>
    		    <!-- MAIN DIV -->
    		    <!-- СОЗДАННЫЕ ЮЗЕРЫ -->
    		    <div class="col-md-10 usertr">
    			<p><b>Пользователи</b></p>
    			<table class="table table-bordered table-hover">
    			    <thead>
    				<tr class="active">
    				    <th>ID</th>
    				    <th>Логин</th>
    				    <th>Телефон</th>
    				    <th>Статус</th>
    				    <th></th>
    				</tr>
    			    </thead>
    			    <tbody>
    <?
    while ($rowUsers = mysql_fetch_array($resultUsers)) {
	switch ($rowUsers["enable"]) {
	    case "1":
		$userStatus = "Активен";
		$color="warning";
		break;
	    case "0":
		$userStatus = "Неактивен";
		$color="danger";
		break;
	}
	?>
					<tr class="<? echo $color; ?>" id="user<? echo $rowUsers["id"]; ?>">
					    <td colspan="1"><? echo $rowUsers["id"]; ?></td>
					    <td colspan="1"><? echo $rowUsers["name"]; ?></td>
					    <td colspan="1"><? echo $rowUsers["phone"]; ?></td>
					    <td colspan="1"><? echo $userStatus; ?></td>
					    <td colspan="1">
						<a href="javascript:void(null);" class="admin-content-link" title="Редактировать" onClick="editUserModal('<? echo $rowUsers["id"]; ?>');"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;
						<a href="javascript:void(null);" class="admin-content-link" title="Удалить" onClick="deleteUser('user<? echo $rowUsers["id"]; ?>', '<? echo $rowUsers["id"]; ?>');"><span class="glyphicon glyphicon-remove"></span></a>
					    </td>
					</tr>
	<?
    }
    ?>
    			    </tbody>
    			</table>
    		    </div>
    		    <!-- НОВЫЙ ЮЗЕР -->
    		    <div class="col-md-10 newuser" style="display: none;">
    			<p><b>Создать пользователя</b></p>
    			<form role="form" method="POST" action="javascript: void(null)" onSubmit="sendCreateUser('create-user', 'admin-modal')" class="form-horizontal" id="create-user">
    			    <div class="form-group">
    				<div class="col-sm-3">
    				    <input type="text" class="form-control" name="name" id="name" placeholder="Логин" required>
    				</div>
    			    </div>
    			    <div class="form-group">
    				<div class="col-sm-3">
    				    <input type="text" class="form-control" name="password" id="password" placeholder="Пароль" maxlength="10" required>
    				</div>
    			    </div>
    			    <div class="form-group">
    				<div class="col-sm-3">
    				    <input type="text" class="form-control" name="phone" id="phone" placeholder="Телефон" maxlength="10" required>
    				</div>
    			    </div>
    			    <div class="form-group">
    				<div class="col-sm-3">
    				    <button type="submit" name="create" class="btn btn-success btn-block">Создать пользователя</button>
    				</div>
    			    </div>
    			</form>
    		    </div>
    		</div>
    	    </div>
    	</div>
    	<!-- FOOTER DIV -->
    	<nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
    	    <div class="container-fluid">
    		<div class="row admin-footer">
    		    <div class="col-md-2">
			coded &amp; designed by <a href="<? echo $httpHost; ?>" class="footer-link">$corpion</a>.<br>
			2014-<? echo date("Y"); ?> &copy; <a href="<? echo $httpHost; ?>" class="footer-link">Scorpion Web Lair</a>.
		    </div>
    		    <div class="col-md-2" align="center">
    			<b>Мы в социальных сетях</b><br>
    			<a href="http://vk.com" class="vk" target="_blank"></a>&nbsp;<a href="http://facebook.com" class="fb" target="_blank"></a>
    		    </div>
    		</div>
    	    </div>
    	</nav>
    	<!-- Alert (модалка) -->
    	<div class="modal fade" id="admin-modal">
    	    <div class="modal-dialog">
    		<div class="modal-content">
    		    <div class="modal-header">
    			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Закрыть</span></button>
    			<h4 class="modal-title" id="admin-modal-title"></h4>
    		    </div>
    		    <div class="modal-body" id="admin-modal-body">
    			Создание пользователя успешно завершено!
    		    </div>
    		    <div class="modal-footer">
    		    </div>
    		</div>
    	    </div>
    	</div>
        </body>
    </html>
    <?
}
?>
