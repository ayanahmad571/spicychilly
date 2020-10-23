<?php
session_start();
if(isset($_SESSION['UID'])){
	header('Location: home.php');
}else{
	header('Location: login.php');
}
?>
