<?php 
include "bootstrap/init.php";

//checking that if the form is sended or not 
//the correct format of checking is by using $_SERVER["REQUEST_METHOD"] == "POST"
$homeUrl=siteUrl();
if($_SERVER['REQUEST_METHOD'] =='POST'){
	$action = $_GET['action'];
	$params = $_POST;


	if($action == "register"){
		$result = register($params);
		if($result){

			messageSuccessfully("registered successfully<br>
			<a href='{$homeUrl}auth.php'>Please Login</a>");



		}else{

			messageFailed("registration failed");

		}



	}else if($action == "login"){

		$result =login($params['email'], $params["pass"]);
		if(!$result){
			messageFailed('Email or Password is incorrect');
		}else{
			messageSuccessfully("Login successfully<br>
			<a href='{$homeUrl}index.php'>manage your task</a>");
		}
	}
}



include "template/tp-auth.php";