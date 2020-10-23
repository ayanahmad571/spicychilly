<?php

include ("include.php");
##login and create
if(isset($_POST['email']) && isset($_POST['pass'])){
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$sql = "SELECT * FROM s_accounts where a_username= '".$email."' and a_password = '".md5(sha1($pass."f02#38$!40t12n847egth8*1348"))."' ";
	
	$check = getdatafromsql($conn, $sql );
	if(is_array($check)){
		session_regenerate_id(true);
		$_SESSION['UID'] = $check['a_id'];
		header('Location: home.php');
		die();
	}else{
		header('Location: login.php?e');
		die();
	}

}
if(isset($_POST['create'])){
	$fname = $_POST['c_fname'];
	$lname = $_POST['c_lname'];
	$email = $_POST['c_email'];
	$pass1 = $_POST['c_pass1'];
	$pass2 = $_POST['c_pass2'];
	if($pass1 != $pass2){
		header('Location: create.php?p');
		die();
	}
	
	$sql = "INSERT INTO `s_accounts`( `a_username`, `a_password`, `a_time`, `a_fname`, `a_lname`) VALUES 
	(
	'".$email."',
	'".md5(sha1($pass1."f02#38$!40t12n847egth8*1348"))."',
	'".time()."',
	'".$fname."',
	'".$lname."'
	)";

if ($conn->query($sql) === TRUE) {
	session_destroy();
	session_start();
	session_regenerate_id();
	$_SESSION['UID'] = $conn->insert_id;
	if(makebank($conn, $_SESSION['UID'])){
	   header('Location: home.php');
   die();
		
	}else{
		die('Could not make a bank acc');
	}
	
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


}

if(isset($_POST['join'])){
	$check = getdatafromsql($conn, "select *, ifnull((select count(*) from s_joins where j_e_id = e_id and j_approved = 1),0) as alpha from s_events where md5(e_id) ='".$_POST['join']."' ");
	if(!is_array($check)){
		die('Did not find event/ might not be space ('.$check['alpha'].')');
	}
	
	if(($check['alpha'] >= $check['e_people'])){
		die('Sorry, were full');
	}
	$sql = "INSERT INTO `s_joins`(`j_a_id`, `j_e_id`) VALUES ('".$_SESSION['UID']."','".$check['e_id']."')";
	
	if ($conn->query($sql) === TRUE) {
		header('Location: item.php?id='.md5($check['e_id']));
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	
	
	
	
	
}
if(isset($_POST['join_leave'])){
	
		$check = getdatafromsql($conn, "select * from s_joins where md5(j_id)='".$_POST['join_leave']."'");
	$sql = "DELETE FROM `s_joins` WHERE md5(j_id) = '".$_POST['join_leave']."'";
	
	if ($conn->query($sql) === TRUE) {
		header('Location: item.php?id='.md5($check['j_e_id']));
		die();
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}	


	$check = getdatafromsql($conn, "select *, ifnull((select count(*) from s_joins where j_e_id = e_id and j_approved = 1),0) as alpha from s_events where md5(e_id) ='".$_POST['join_leave']."' ");
	if(!is_array($check)){
		die('Did not find event/ might not be space');
	}
	
	$sql = "INSERT INTO `s_joins`(`j_a_id`, `j_e_id`) VALUES ('".$_SESSION['UID']."','".$check['e_id']."')";
	
	if ($conn->query($sql) === TRUE) {
		header('Location: item.php?id='.md5($check['e_id']));
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	
	
	
	
	
}

#rem and add join
if(isset($_POST['join_add'])){
	$check = getdatafromsql($conn, "select * from s_joins where md5(j_id)='".$_POST['join_add']."'");
	$sql = "UPDATE `s_joins` SET `j_approved` = '1' WHERE md5(j_id) = '".$_POST['join_add']."'";
	
	if ($conn->query($sql) === TRUE) {
		header('Location: item.php?id='.md5($check['j_e_id']));
		die();
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}	
}
if(isset($_POST['join_rem'])){
	$check = getdatafromsql($conn, "select * from s_joins where md5(j_id)='".$_POST['join_rem']."'");
	$sql = "UPDATE `s_joins` SET `j_approved` = '0' WHERE md5(j_id) = '".$_POST['join_rem']."'";
	
	if ($conn->query($sql) === TRUE) {
		header('Location: item.php?id='.md5($check['j_e_id']));
		die();
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}	
}
##

##rat
if(isset($_POST['rat_1'])){
	$check = getdatafromsql($conn,"select * from s_events where md5(e_id) = '".$_POST['rat_1']."'");
		$sql = "INSERT INTO `s_ratings`(`r_a_id`, `r_e_id`, `r_val`) VALUES (
			'".$_SESSION['UID']."' , '".$check['e_id']."' , 1)";
		
		if ($conn->query($sql) === TRUE) {
			echo header("Location: users.php");
				
		} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		}

}
if(isset($_POST['rat_2'])){
	$check = getdatafromsql($conn,"select * from s_events where md5(e_id) = '".$_POST['rat_2']."'");
		$sql = "INSERT INTO `s_ratings`(`r_a_id`, `r_e_id`, `r_val`) VALUES (
			'".$_SESSION['UID']."' , '".$check['e_id']."' , 2)";
		
		if ($conn->query($sql) === TRUE) {
			echo header("Location: users.php");
				
		} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		}

}
if(isset($_POST['rat_3'])){
	$check = getdatafromsql($conn,"select * from s_events where md5(e_id) = '".$_POST['rat_3']."'");
		$sql = "INSERT INTO `s_ratings`(`r_a_id`, `r_e_id`, `r_val`) VALUES (
			'".$_SESSION['UID']."' , '".$check['e_id']."' , 3)";
		
		if ($conn->query($sql) === TRUE) {
			echo header("Location: users.php");
				
		} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		}

}
if(isset($_POST['rat_4'])){
	$check = getdatafromsql($conn,"select * from s_events where md5(e_id) = '".$_POST['rat_4']."'");
		$sql = "INSERT INTO `s_ratings`(`r_a_id`, `r_e_id`, `r_val`) VALUES (
			'".$_SESSION['UID']."' , '".$check['e_id']."' , 4)";
		
		if ($conn->query($sql) === TRUE) {
			echo header("Location: users.php");
				
		} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		}

}
if(isset($_POST['rat_5'])){
	$check = getdatafromsql($conn,"select * from s_events where md5(e_id) = '".$_POST['rat_5']."'");
		$sql = "INSERT INTO `s_ratings`(`r_a_id`, `r_e_id`, `r_val`) VALUES (
			'".$_SESSION['UID']."' , '".$check['e_id']."' , 5)";
		
		if ($conn->query($sql) === TRUE) {
			echo header("Location: users.php");
				
		} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		}

}

##add chat to thread
if((isset($_POST['add_chat'])) and isset($_POST['add_tid'])){
	$check = getdatafromsql($conn, "select t_id from s_threads where md5(t_id) = '".$_POST['add_tid']."'");
	
	$sql = "INSERT INTO `s_chat`( `c_t_id`, `c_a_id`, `c_text`, `c_dnt`) VALUES (
	'".$check['t_id']."','".$_SESSION['UID']."', '".$_POST['add_chat']."', '".time()."'	)";

if ($conn->query($sql) === TRUE) {
   
   header('Location: chat.php?id='.md5($check['t_id']));
   die();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


}
if(isset($_POST['add_thread'])){
	
	$sql = "
	INSERT INTO `s_threads`(`t_a_id`, `t_desc`, `t_time`) VALUES (
	'".$_SESSION['UID']."','".$_POST['add_thread']."','".time()."'	)";

if ($conn->query($sql) === TRUE) {
   
   header('Location: chat.php?id='.md5($conn->insert_id));
   die();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


}

##pay now
if(isset($_POST['money'])){
	$check = getdatafromsql($conn, "select * from s_events where md5(e_id) = '".$_POST['money']."'");
	
	if(moneytomoney($conn,$_SESSION['UID'],$check['e_a_id'],$check['e_price'])){
		
		
		$sql = "update s_joins set j_paid = 1 where j_a_id = ".$_SESSION['UID']." and j_e_id = ".$check['e_id']."";

if ($conn->query($sql) === TRUE) {
		header('Location: users.php?id='.md5($_SESSION['UID']));
		die();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}




	}else{
		die('Error processing payment');
	}


}

##add event
if(isset($_POST['event_add'])){
	$name = $_POST['event_name'];
	$cui = $_POST['event_cui'];
	$desc = $_POST['event_desc'];
	$postcode = $_POST['event_pc'];
	$price = $_POST['event_price'];
	$people = $_POST['event_people'];
	$img = $_POST['event_img'];
	$date1 = $_POST['event_date'];
	$date2 = $_POST['event_time'];
	$dnt = strtotime($date1.' '.$date2);
	
	$ch = curl_init();
	
	curl_setopt($ch,CURLOPT_URL,'http://api.getthedata.com/postcode/'.$postcode);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$output=curl_exec($ch);

$data = json_decode($output);

$lat = $data->data->latitude;
$long=  $data->data->longitude;
$sql = "INSERT INTO `s_events`(`e_name`, `e_cuisine`, `e_desc`, `e_lat`, `e_long`, `e_price`, `e_people`, `e_img_src`, `e_a_id`, `e_dnt`) VALUES (
'".$name."','".$cui."','".$desc."','".$lat."','".$long."','".$price."','".$people."','".$img."', '".$_SESSION['UID']."', '".$dnt."' )
";

if ($conn->query($sql) === TRUE) {
	header('Location: item.php?id='.md5($conn->insert_id));
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}




}

 if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['lname']) && isset($_POST['lname']) && isset($_POST['lname']) && isset($_POST['lname'])){
	$id = $_POST['uid'];
	
}else if(isset($_POST['events']) && isset($_POST['uid'])){
	$id = $_POST['uid'];
	
}




?>

