<?php 

    session_start();
    require 'config.php';

    if(isset($_SESSION['logado']) && !empty($_SESSION['logado'])) {
        $id = $_SESSION['logado'];
        $sql = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $info = $sql->fetch();
        }else {
            header('location: index.php');
        }
    }else {
        header('location: index.php');
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Home</title>
</head>
<body>
    <h1 class="title--home"><?php echo "Olá ".$info['email']; ?></h1>
    <a href="logout.php" class="link--home">sair</a>
</body>
</html>