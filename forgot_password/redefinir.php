<?php 
	
	require 'config.php';

	if(!empty($_GET['token'])) {
		$token = $_GET['token'];

		$sql = $pdo->prepare("SELECT * FROM usuarios_token WHERE hash = :hash AND used = 0 AND espira_em > NOW()");
		$sql->bindValue(':hash', $token);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();
			$id = $sql['id_usuario'];

			if(!empty($_POST['password'])) {
				$senha = $_POST['password'];

				$sql = $pdo->prepare("UPDATE usuarios SET senha = :senha WHERE id = :id");
				$sql->bindValue(':senha', md5($senha));
				$sql->bindValue(':id', $id);
				$sql->execute();

				$sql = $pdo->prepare("UPDATE usuarios_token SET used = 1 WHERE hash = :hash");
				$sql->bindValue(':hash', $token);
				$sql->execute();

				echo "<script>alert('Sua senha foi alterada com sucesso!')</script>";
				echo "<script>window.location.href = 'index.php'</script>";
			}

		}else {
			echo "<script>alert('Token inválido ou usado!')</script>";
			echo "<script>window.location.href = 'index.php'</script>";
		}

	}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
	<title>Redefina sua senha</title>
</head>
<body>
	<form method="post" class="form--single">
		Sua nova senha:
		<input type="password" name="password" placeholder="Insira sua nova senha..." autocomplete="off" required>
		<input type="submit" name="alterar" value="Redefinir">
	</form>
</body>
</html>