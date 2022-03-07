<?php 

	require 'config.php';

	if(isset($_POST['cadastrar'])) {
		$email = $_POST['email'];
		$senha = $_POST['senha'];

		$sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
		$sql->bindValue(':email', $email);
		$sql->execute();

		if($sql->rowCount() > 0) {
			echo "<script>alert('Ja possui um email com esses caracteres!')</script>";
		}else {
			$sql = $pdo->prepare("INSERT INTO usuarios (email, senha) VALUES (:email, :senha)");
			$sql->bindValue(':email', $email);
			$sql->bindValue(':senha', md5($senha));
			$sql->execute();

			echo "<script>alert('Cadastro finalizado com sucesso!')</script>";
			echo "<script>window.location.href = 'index.php'</script>";
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
		<h2>Cadastro</h2>
		<form method="post">
			E-mail
			<input type="email" name="email" placeholder="email..." autocomplete="off" required>
			Senha
			<input type="password" name="senha" placeholder="*****" autocomplete="off" required>
			<input type="submit" name="cadastrar" value="cadastrar">
			<a href="index.php" id="link-cad">Ja tem conta? faça login...</a>
		</form>
	</div>
</body>
</html>

