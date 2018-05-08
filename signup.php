<?php
$dbc = mysqli_connect('il280962.mysql.tools', 'il280962_kovtdb', 'qaz12345', 'il280962_kovtdb');

if(isset($_POST['submit'])){
	
	$username = mysqli_real_escape_string($dbc, trim($_POST['username']));
	$password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
	$password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));
	$phone = mysqli_real_escape_string($dbc, trim($_POST['phone']));
	
	if(!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2)) {
		
		$query = "SELECT * FROM `signup` WHERE username = '$username'";
		$data = mysqli_query($dbc, $query);
		
		if(mysqli_num_rows($data) == 0) {
			$query ="INSERT INTO `signup` (username, password,phone) VALUES ('$username', SHA('$password2'), '$phone')";
			mysqli_query($dbc,$query);
			echo 'Всё готово, можете авторизоваться<br/> <a href="index.php">На главную</a>';
			
			mysqli_close($dbc);
			exit();
		}
		else {
			echo 'Логин уже существует';
		}

	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link href="style/style.css" rel="stylesheet">
</head>
<body>
<header>
<ul>
	<li><a href="/">Главная</a></li>
	<li><a href="/">Новости</a></li>
	<li><a href="/">Магазин</a></li>
	<li><a href="/">Обратная связь</a></li>
</ul>
</header>
<content>
	<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<label for="username">Введите ваш логин:</label>
	<input type="text" name="username">
	<label for="password">Введите ваш пароль:</label>
	<input type="password" name="password1">
	<label for="password">Введите пароль еще раз:</label>
	<input type="password" name="password2">
	<label for="phone">Введите телефон:</label>
	<input type="phone" name="phone">
	<button type="submit" name="submit">Регистрация</button>
	</form>
</content>
<footer class="clear">
	<p>Разработчик : Ковтун А.Г. 11 МБ КН (2017 год)</p>
</footer>

</body>

</html>