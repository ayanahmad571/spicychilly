<?php 
  session_start();
	 
include ("db_auth_base.php");
foreach($_POST as $key=>$v){

	if(!is_array($_POST[$key])){
		if($key == 'add_client_bill_addr' or $key == 'add_client_ship_addr' ){
			$_POST[$key] =str_replace('script>','', trim(($conn->escape_string($v))));
		}else{
		 $_POST[$key] = trim(strip_tags($conn->escape_string($v)));
		}
	}
	else if (is_array($_POST[$key])){
		foreach($_POST[$key] as $ke=>$vv){
		 $_POST[$key][$ke] = trim(strip_tags($conn->escape_string($vv)));
		}
	}else{
		die('INCL#ERR1');
	}


}

$arawer = $_SERVER['REMOTE_ADDR'];
if (array_search('', $_POST) !== false){ 
	die('Don\'t enter Blank Values');
}



function in_range($number, $min, $max, $inclusive = FALSE)
{
    if (is_numeric($number) && is_numeric($min) && is_numeric($max))
    {
        return $inclusive
            ? ($number >= $min && $number <= $max)
            : ($number > $min && $number < $max) ;
    }

    return false;
}


function is_address($string){
	
	#address
$address = $string;
$address = str_replace(' ','',$address);
$address = str_replace('-','',$address);
$address = str_replace('/','',$address);
$address = str_replace("'",'\'',$address);
$address = str_replace('>','',$address);
$address = str_replace('<','',$address);

if(ctype_alnum($address) == true){
	return true;
}else{
	return false ;
}

	
	
}


function is_name($string,$int){
	# int 1 = remove blank 
	#int 0 = keep blank
	#int 2 = remove blank and check for alnum
	#int 3 = remove blank and check for alnum or alphabets
	if($int==1){
		$myVar = str_replace(' ','',$string);

				if(ctype_alpha($myVar)){
					return true;
				}else{
					return false;
				}
	}
	
	else if($int == 0){
		
		
		$myVar = $string;

				if(ctype_alpha($myVar)){
					return true;
				}else{
					return false;
				}
	}
	else if($int == 2){
		
		$myVar = str_replace(' ','',$string);
		$myVar = str_replace('_','',$string);

				if(ctype_alnum($myVar)){
					return true;
				}else{
					return false;
				}
		
	}
	else if($int == 3){
		
		$myVar = str_replace(' ','',$string);
		$myVar = str_replace('_','',$string);

				if(ctype_alpha($myVar) or ctype_alnum($myVar)){
					return true;
				}else{
					return false;
				}
		
	}
	
	return false;
}


function is_mobno($string){

	$mobNo = trim($string);
if(is_numeric($mobNo)){
	if(strlen($mobNo) == 10){
		return true;
	}else{
		return false;
		}
}else{
	return false;
}



}

function validate_email($email) {
				return (preg_match("/(@.*@)|(\.\.)|(@\.)|(\.@)|(^\.)/", $email) || !preg_match("/^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/", $email)) ? false : true;
			}
			

function is_email($string){
	
				$email = str_replace('0','',$string);
				$email = str_replace('1','',$string);
				$email = str_replace('2','',$string);
				$email = str_replace('3','',$string);
				$email = str_replace('4','',$string);
				$email = str_replace('5','',$string);
				$email = str_replace('6','',$string);
				$email = str_replace('7','',$string);
				$email = str_replace('8','',$string);
				$email = str_replace('9','',$string);
				$email = str_replace('.circuit','.com',$string);
				
				if(validate_email($email) == true){
					return true;
				}else{
						return false ;
				}
			
		
	
}


function is_date($dy,$mt,$yr){
	
		
				
				if(checkdate($mt,$dy,$yr) == true){
					return true;
				}else{
						return false ;
				}
			
		
	
}



function is_pincode($string){

$pincode = $string;
if(is_numeric($pincode)){
	if(strlen($pincode) == 6 and ($pincode > 100000 )){
		return true;
	}else{
		return false;
	}
}else{
	return false;
}



}

function is_strength($string){
	
	$delno = $string;

if(is_numeric($delno) && ($delno < 22)){
		return true;
}else{
		return false;
}


}




function is_writeup($string){
	$text = strtolower($string);
	$text =strip_tags($text);
	$text = str_replace(' ','',$text);
	$text = str_replace("'",'',$text);
	$text = str_replace('"','',$text);
	$text = str_replace(";",'',$text);
	$text = str_replace("",'',$text);
	$text = str_replace("\n",'',$text);
	$text = str_replace("\r",'',$text);
	$text = str_replace("\\",'',$text);
	$text = str_replace("/",'',$text);
	$text = str_replace("?",'',$text);
	$text = str_replace(".",'',$text);
	$text = str_replace(",",'',$text);

				if(ctype_alnum($text) or ctype_alpha($text)){
					return true;
				}else{
					return false;
				}
	
}


function is_numeric_array( $array){
  foreach( $array as $val){
    if( !is_numeric( $val)){
      return false;
    }
  }
  return true;
}



function array_has_dupes($array) {
   // streamline per @Felix
   return count($array) !== count(array_unique($array));
}

function extension($name){
	$img_name = explode('.',$name);
	$del =end($img_name);
	return($del);
}





function getdatafromsql($conn,$sql){
	
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_assoc();
	return $row;
} else {
    return "0 results";
}

}

function getdatafromsql_all($conn,$sql){
	
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $re = array();
	while($row = $result->fetch_assoc()){
		$re[] = $row;
	}
	return $re;
} else {
    return "0 results";
}

}




function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}

function get_header($title){
echo '
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
		
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Amazing App">
        <meta name="author" content="TeamX SpiC Chilly">
        <link rel="shortcut icon" href="img/favicon_1.png">
        <title>'.$title.'</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-reset.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="assets/ionicon/css/ionicons.min.css" rel="stylesheet" />

        <link rel="stylesheet" href="assets/morris/morris.css">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/helper.css" rel="stylesheet">
    </head>


    <body>

';
}

function get_end(){
	echo'
	
		<script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/pace.min.js"></script>
        <script src="js/wow.min.js"></script>
        <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
            
        <script src="js/jquery.app.js"></script>

    
    </body>

</html>

	';
}

function check_login(){
	if(!isset($_SESSION['UID'])){
		header('Location: login.php?l');
		die();
	}
}

function get_nav(){
	echo '
	        <aside class="left-panel">

            <!-- brand -->
            <div class="logo">
                <a href="index.php" class="logo-expanded">
                    <i class="ion-fork"></i>
                    <span class="nav-label">SPIC CHILLY</span>
                </a>
            </div>
            <!-- / brand -->
        
            <!-- Navbar Start -->
            <nav class="navigation">
                <ul class="list-unstyled">
                    <li class="'.(strtolower(basename($_SERVER['PHP_SELF'])) == 'home.php'?  'active':'').'">
                    	<a href="home.php"><i class="ion-home"></i> 
                        <span class="nav-label">Dashboard</span></a>
					</li>
                    <li class="'.(strtolower(basename($_SERVER['PHP_SELF'])) == 'users.php' ?  'active':'').'">
                    	<a href="users.php"><i class="ion-person"></i> 
                        <span class="nav-label">Profile</span></a>
					</li>
                    <li class="'.(strtolower(basename($_SERVER['PHP_SELF'])) == 'add.php' ?  'active':'').'">
                    	<a href="add.php"><i class="ion-person-add"></i> 
                        <span class="nav-label">Add Event</span></a>
					</li>					<li >
                    	<a href="logout.php"><i class="ion-forward"></i> 
                        <span class="nav-label">Logout</span></a>
					</li>

                </ul>
            </nav>
                
        </aside>
	';
}

function get_last(){
	echo '            <footer class="footer">
                2019 © Project X
            </footer>';
}


function getuserdets($id, $conn){
	$rating = getdatafromsql($conn, "select count(*) as ct, sum(r_val) as sm from s_ratings r left join s_events e on r.r_e_id = e.e_id 
	where e_a_id = '".$id."' ");
	$check = getdatafromsql($conn, "select * from s_accounts where a_id = '".$id."'");
	$ret =array();
	if($rating['ct'] == 0){
		$rating['ct'] = 1;
	}
	$ret[0] = $rating['sm']/$rating['ct']; //avg rating
	$ret[1]= $check['a_username'];//uname, 
	$ret[2]= $check['a_time'];//time, 
	$ret[3]= $check['a_fname'];//fname, 
	$ret[4]= $check['a_lname'];//lname, 
	$ev = getdatafromsql($conn, "select count(*) as ccc from s_events where e_a_id = '".$id."'");
	
	$ret[5]= $ev['ccc'];//events hosted, 
	return $ret;
}

####
function makebank($conn, $userid){
	
	
		$sql = "INSERT INTO `s_bank`(`b_a_id`, `b_initial_bal`) VALUES ('".$userid."','2000')";
	
	if ($conn->query($sql) === TRUE) {
		return true;
	} else {
		return false;
	}
	
	
	
}

function moneytomoney($conn, $from, $to, $val){
		
		$sql = "UPDATE `s_bank` SET b_initial_bal= b_initial_bal - ".$val." where b_a_id = ".$from;
		$sql2 = "UPDATE `s_bank` SET b_initial_bal= b_initial_bal + ".$val." where b_a_id = ".$to;
		

	
	if ($conn->query($sql) === TRUE) {
				if ($conn->query($sql2) === TRUE) {
				return true;
			} else {
				return false;
			}
			
	} else {
		return false;
	}
	
}


?>



