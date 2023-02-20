<?php 
	
	session_start();
	$link = mysqli_init();
mysqli_ssl_set($link,NULL,NULL, 'ca.pem', NULL, NULL);
mysqli_real_connect($link, "dbemanu.mysql.database.azure.com", "emanu", "L@ctog@l2205", "pap", 3306, MYSQLI_CLIENT_SSL);

	$fraca=$_POST['raca'];
	$query = mysqli_query($link,"insert into racas(raca) values('$fraca')");
	if($query){	
		$iduser=$_SESSION['iduser'];
		mysqli_query($link,"insert into logs(idu,descricao) values($iduser,'Inseriu uma Nova Raça')");
		Header("Location:racas.php");}
	?>