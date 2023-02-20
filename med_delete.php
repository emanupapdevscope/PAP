<?php
session_start();
$link = mysqli_init();
mysqli_ssl_set($link,NULL,NULL, 'ca.pem', NULL, NULL);
mysqli_real_connect($link, "dbemanu.mysql.database.azure.com", "emanu", "L@ctog@l2205", "pap", 3306, MYSQLI_CLIENT_SSL);
			$divide  = explode("?", $_SERVER["REQUEST_URI"]);
			$divide['1'];
			$idm=$divide['1'];
			$query = mysqli_query($link,"update medicamentos set ativo=1 where idm=$idm");

					if($query){
						$iduser=$_SESSION['iduser'];
						$log=mysqli_query($link,"insert into logs(idu,descricao) values($iduser,'Eliminou um Medicamento')");
						if($log){
						Header("Location:med_listar.php");}
					}
	
?>