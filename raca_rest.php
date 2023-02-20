<?php
	session_start();
	$link = mysqli_init();
mysqli_ssl_set($link,NULL,NULL, 'ca.pem', NULL, NULL);
mysqli_real_connect($link, "dbemanu.mysql.database.azure.com", "emanu", "L@ctog@l2205", "pap", 3306, MYSQLI_CLIENT_SSL);
			$divide  = explode("?", $_SERVER["REQUEST_URI"]);
			$divide['1'];
			$idr=$divide['1'];
			$query = mysqli_query($link,"update racas set ativo=0 where idr=$idr");

					if($query){
						$iduser=$_SESSION['iduser'];
						mysqli_query($link,"insert into logs(idu,descricao) values($iduser,'Restaurou uma Raça')");
						Header("Location:racas.php");
					}
	
?>