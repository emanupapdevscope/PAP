<?php 

	session_start();
	$link = mysqli_init();
mysqli_ssl_set($link,NULL,NULL, 'ca.pem', NULL, NULL);
mysqli_real_connect($link, "dbemanu.mysql.database.azure.com", "emanu", "L@ctog@l2205", "pap", 3306, MYSQLI_CLIENT_SSL);
	$fpreco=$_POST['newpreco'];
	$query = mysqli_query($link,"insert into precoleite(preco) values('$fpreco')");
	if($query){	
		$iduser=$_SESSION['iduser'];
		mysqli_query($link,"insert into logs(idu,descricao) values($iduser,'Alterou o Preço do Leite')");
		Header("Location:precoleite.php");}
	?>