<?php

	try{
		$pdo = new PDO("mysql:dbname=forgot_password;host=localhost","root","");
	}catch(Exception $e){
		echo "ERRO: ".$e->getMessage();
		exit;
	}

?>