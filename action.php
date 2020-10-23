<?php
//login action
include ("include.php");
if(isset($_GET['email']) && isset($_GET['pass'])){
	$email = $_GET['email'];
	$pass = $_GET['pass'];
	$sql = "SELECT * FROM s_accounts where a_username= '".$email."' and a_password = '".md5(sha1($pass."f02#38$!40t12n847egth8*1348"))."' ";
	
	$check = getdatafromsql($conn, $sql );
	if(is_array($check)){
		echo '1';
	}else{
		echo '0';
	}

}else if(isset($_GET['fname']) && isset($_GET['lname']) && isset($_GET['lname']) && isset($_GET['lname']) && isset($_GET['lname']) && isset($_GET['lname'])){
	$id = $_GET['uid'];
	
}else if(isset($_GET['events']) && isset($_GET['uid'])){
	$id = $_GET['uid'];
	
}
else{
	echo '#A100000';
}



?>


include ("include.php");

	$email = "kings@login.com";
	$pass = "test";
	$sql = "SELECT * FROM s_accounts where a_username= '".$email."' and a_password = '".md5(sha1($pass."f02#38$!40t12n847egth8*1348"))."' ";
	
	$check = getdatafromsql($conn, $sql );

	var_dump($check);