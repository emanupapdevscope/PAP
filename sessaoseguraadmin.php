<?php 
require 'vendor/autoload.php';
use Predis\Client;
$redis = new Predis\Client([
    'scheme' => 'tcp',
    'host'   => 'emanu.redis.cache.windows.net',
    'port'   => 6380,
    'password' => 'dF2qyIAwXjJUPlRpfhGcnNnWQqPOyAoKKAzCaJhJWho='
]);

session_start();
if($_SESSION['tipo'] == 1){
}
else{
	Header("refresh:0.1;url=user.php");}
?>