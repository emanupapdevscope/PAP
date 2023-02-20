<?php 
require 'vendor/autoload.php';
use Predis\Client;
$redis = new Predis\Client([
    'scheme' => 'tcp',
    'host'   => 'redis-host-name.redis.cache.windows.net',
    'port'   => 6379,
    'password' => 'redis-access-key'
]);

session_start();
if($_SESSION['tipo'] == 1){
}
else{
	Header("refresh:0.1;url=user.php");}
?>