<?php
date_default_timezone_set("Asia/Bangkok");
session_start();
$CONF = array();
$CONF["host"] = "localhost:3306";
$CONF["user"] = "root";
$CONF["pass"] = "";
$CONF["name"] = "stock";

$_SESSION['uid'] = 1;
$connect = new PDO("mysql:host=" . $CONF["host"] . ";dbname=" . $CONF["name"] . ";" , $CONF["user"] , $CONF["pass"] , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")) or die ("ERROE SQL");
$connect->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
$website = "http://localhost/stock";
$partUpload = "http://localhost/findpets/uploads/";
$ip = $_SERVER['REMOTE_ADDR'];
if(isset($_SESSION['uid'])){
    $user = $connect->prepare("SELECT * FROM `member` WHERE `uid` = ?");
    $user->execute([$_SESSION['uid']]);
    $user = $user->fetch();
}
function getToken($length){
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet);

   for ($i=0; $i < $length; $i++) {
       $token .= $codeAlphabet[random_int(0, $max-1)];
   }

   return $token;
}

include("function.php");
?>