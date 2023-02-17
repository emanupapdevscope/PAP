<!-- Registar Leite -->		
 
 <?php 
	session_start();
	include 'DBConnection.php';
	$vaca=$_SESSION['vaca'];
	if ((isset($_POST["leite"])) && (isset($vaca)) && (isset($_POST["timestamp"]))){
		$fleite=$_POST["leite"];
		$ftimestamp=$_POST["timestamp"];
		$fvaca=$vaca;
		$datarecolha=date("Y-m-d");
		
		$query=mysqli_query($link,"insert into leite(data,quantidade,numero,timestamp) values('$datarecolha',$fleite,'$fvaca','$ftimestamp')");
		
		if($query){
			$iduser=$_SESSION['iduser'];
						mysqli_query($link,"insert into logs(idu,descricao) values($iduser,'Registou Leite')");
			header("Refresh:0; url=vaca.php");
						}
					else{
						echo"Erro ao inserir!Erro: ".mysqli_error($link)."";
						}
					
					}		
					
 ?>