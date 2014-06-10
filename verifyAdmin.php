<?php
ob_start();
include('secret/settings.conf');

if(isset($_COOKIE['LoginUserID']) and isset($_COOKIE['LoginuNID']) and isset($_COOKIE['timeOfLogin']) and isset($_COOKIE['hash'])){
	$LoginUserID=$_COOKIE['LoginUserID'];
	$LoginuNID = $_COOKIE['LoginuNID'];
	$timeOfLogin = $_COOKIE['timeOfLogin'];
	$hashCookie = $_COOKIE['hash'];
	$hashCalculated=sha1("Y".$secret.$LoginUserID.$LoginuNID.$timeOfLogin);
	if($hashCookie!=$hashCalculated){
		header('location:login.php');
		exit;
	}
	$StudentUserID=$_COOKIE['StudentUserID'];
	$StudentuNID = $_COOKIE['StudentuNID'];
}else{
	header('location:login.php');
	exit;
}
?>
