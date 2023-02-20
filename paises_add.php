<?php 

	session_start();
	$link = mysqli_init();
mysqli_ssl_set($link,NULL,NULL, 'ca.pem', NULL, NULL);
mysqli_real_connect($link, "dbemanu.mysql.database.azure.com", "emanu", "L@ctog@l2205", "pap", 3306, MYSQLI_CLIENT_SSL);
	$fpais=$_POST['pais'];
	$query = mysqli_query($link,"insert into pais(pais) values('$fpais')");
	if($query){	
			$iduser=$_SESSION['iduser'];
			mysqli_query($link,"insert into logs(idu,descricao) values($iduser,'Inseriu um Novo País')");
			Header("Location:paises.php");}
	?>