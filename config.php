<?php
 

$xdteam_apikeytoken = "666666";                  # Token bot [@BotFather] | توکن خودرا بزارید
define('API_KEY',"$xdteam_apikeytoken");   # Do not touch | دست نزنید

$admin              = ['370477581'];       # User ID admin | ایدی عددی ادمین
$Channels           = ['link5yon','Winston_Source1']; # User NAME channel | یوزرنیم کانالتون
$channelseen        = "link5yon";            # view channel | چنل سین

# USE MARIA DB | https://mariadb.org       # Use Marid db | MARIADB DATABASE
$connect = new mysqli('localhost','saeedmiz_ss','saeedmiz_ss','saeedmiz_ss');
$connect->query("SET NAMES 'utf8'"); $connect->set_charset('utf8mb4');

 
?>