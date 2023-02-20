<!-- Registar Leite -->		
 
 <?php 
	session_start();
	$link = mysqli_init();
mysqli_ssl_set($link,NULL,NULL, 'ca.pem', NULL, NULL);
mysqli_real_connect($link, "papemanu.mysql.database.azure.com", "emanu", "P@ssword1", "pap", 3306, MYSQLI_CLIENT_SSL);
	$vaca=$_SESSION['vaca'];
	if ((isset($_POST["medic"])) && (isset($vaca)) && (isset($_POST["dose"])) & (isset($_POST["motivo"]))){
		$fmedic=$_POST["medic"];
		$qry=mysqli_query($link,"Select * from medicamentos where nome='$fmedic'");  
			while ($row=mysqli_fetch_array($qry)){
			$idm=$row['idm'];
			}
		$fdose=$_POST["dose"];
		$fmotivo=$_POST["motivo"];
		$fvaca=$vaca;
		$datarecolha=date("Y-m-d");
		
		$query=mysqli_query($link,"insert into vacinacao(idm,numero,data,motivo,dose) values($idm,'$fvaca','$datarecolha','$fmotivo',$fdose)");
		
		//reduzir stock
		$stock=mysqli_query($link,"Select * from medicamentos where idm='$idm'");  
			while ($row=mysqli_fetch_array($stock)){
			$stock1=$row['qdisp'];
			$fqdisp=$stock1-$fdose;}
			mysqli_query($link,"update medicamentos set qdisp=$fqdisp where idm=$idm");
		
		
		if($query){
			$iduser=$_SESSION['iduser'];
			mysqli_query($link,"insert into logs(idu,descricao) values($iduser,'Vacinou uma Vaca')");
			header("Refresh:0; url=vaca.php");
						}
					else{
						echo"Erro ao inserir!Erro: ".mysqli_error($link)."";
						}
					
					}		else{echo 'Erroooo';}
					
 ?>