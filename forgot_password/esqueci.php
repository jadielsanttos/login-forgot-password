<?php  
	require 'config.php';

	if(isset($_POST['email'])) {
		$email = $_POST['email'];

		$sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
		$sql->bindValue(':email', $email);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();
			$id = $sql['id'];

			$token = md5(time().rand(0,99999).rand(0,99999));

			$sql = $pdo->prepare("INSERT INTO usuarios_token (id_usuario, hash, espira_em) VALUES (:id_usuario, :hash, :espira_em)");
			$sql->bindValue(':id_usuario', $id);
			$sql->bindValue(':hash', $token);
			$sql->bindValue(':espira_em', date('Y/m/d H:i', strtotime('+2 hours')));
			$sql->execute();

			$link = "http://localhost/forgot_password/redefinir.php?token=".$token;

			$mensagem = "clique no link abaixo para redefinir sua senha:<br>".$link;

			header('location: redefinir.php?token='.$token);	

		}else {
			echo "<script>alert('email digitado não existe!')</script>";
		}

	}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Não lembra da senha? Dont have problem!</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="box-redefinir">
		<h3>Para continuar, insira seu email</h3>
		<form method="post">
			<input type="email" name="email" placeholder="email..." autocomplete="off" required>
			<input type="submit" name="continuar" value="continuar">
		</form>
	</div>
</body>
</html>