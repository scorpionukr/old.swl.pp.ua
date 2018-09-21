<!DOCTYPE html>
<html lang="ru">
<head>
	<title>Scorpion web lair -> Логин</title>
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
	<script src="/js/login.js"></script>
</head>
<body class="bg-main">
<!-- LOGIN DIV -->
<div class="content-login">
	<div class="container">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="well well-small">
					<h2 class="h1orange" align="center">Scorpion Web Lair</h2>
					<form role="form" method="POST" action="trylogin.php" id="login">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
							<input type="text" class="form-control" name="name" id="name" placeholder="Логин" required>
						</div>
						<br>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-eye-close"></span></span>
							<input type="password" class="form-control" name="password" id="pass" placeholder="Пароль" maxlength="10" required>
						</div>
						<br>
						<button type="submit" class="btn btn-success btn-block">Вход</button>
					</form>
				</div>
			</div>
			<div class="col-md-4"></div>
		</div>
	</div>
</div>
</body>
</html>
