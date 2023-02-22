<?php
include 'sessaosegurauser.php';
// CONECTA COM A BASE DE DADOS
$link = mysqli_init();
mysqli_ssl_set($link,NULL,NULL, 'ca.pem', NULL, NULL);
mysqli_real_connect($link, "papemanu.mysql.database.azure.com", "emanu", "P@ssword1", "pap", 3306, MYSQLI_CLIENT_SSL);
// RECEBE OS DADOS DO FORMULÁRIO
$vaca=$_POST['vaca'];
// VERIFICA
$sql = mysqli_query($link,"SELECT * FROM vacas WHERE numero = '$vaca'");
// LINHAS AFECTADAS PELA CONSULTA
$row = mysqli_num_rows($sql);
// VERIFICA SE DEVOLVEU ALGO
// se nao devolveu nada mostra um erro
if($row == 0){

$pag='admin.php?erro=1';
$_SESSION['erro']=1;
Header("Location:$pag");
}
//se tiver devolvido algo vai para a pagina vaca.php
else {
	
	//GRAVA AS VARIÁVEIS NA SESSÃO
	$iduser=$_SESSION['iduser'];
	$_SESSION['iduser']=$iduser;
	$_SESSION['vaca'] = $vaca;
	Header("Location:vaca.php");

}//fecha else
	?>