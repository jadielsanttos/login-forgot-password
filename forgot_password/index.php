<?php

	session_start();
	require 'config.php';

	if(isset($_POST['senha'])) {
		$email = $_POST['email'];
		$senha = $_POST['senha'];

		$sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
		$sql->bindValue(':email', $email);
		$sql->bindValue(':senha', md5($senha));
		$sql->execute();

		if($sql->rowCount() > 0) {

			$sql = $sql->fetch();
			$_SESSION['logado'] = $sql['id'];
			header('location: home.php');

		}else {
			echo "<script>alert('Dados incorretos, tente novamente.')</script>";
		}

}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bem-vindo(a)</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="formLogin">
		<h2>Login</h2>
		<form method="post">
			E-mail
			<input type="email" name="email" placeholder="email..." autocomplete="off" required>
			Senha
			<input type="password" name="senha" placeholder="*****" autocomplete="off" required>
			<a href="esqueci.php" id="link-forgot">esqueci minha senha</a>
			<input type="submit" name="entrar" value="entrar">
			<a href="cadastro.php" id="link-cad">Não possui login? crie agora...</a>
		</form>
	</div>
</body>
</html>



