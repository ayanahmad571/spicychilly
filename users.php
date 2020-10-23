<?php 
include("include.php");

check_login();

if(isset($_GET['id'])){
	$check = getdatafromsql($conn, "SELECT * FROM `s_accounts` where md5(a_id) = '".$_GET['id']."'");
}else{
	$check = getdatafromsql($conn, "SELECT * FROM `s_accounts` where a_id = '".$_SESSION['UID']."'");
}
	if(!is_array($check)){
		die('No USER found :(');
	}
	
	$detar = getuserdets($check['a_id'], $conn);

get_header("SpiC Chilly - Users Panel");
?>

        <!-- Aside Start-->
<?php
get_nav();
?>
        <!-- Aside Ends-->


        <!--Main Content Start -->
        <section class="content">
            
            <!-- Header -->
            <header class="top-head container-fluid">
                <button type="button" class="navbar-toggle pull-left">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
 
            </header>
            <!-- Header Ends -->


            <!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
                <div class="row m-t-30">
                    <div class="col-sm-12">
                        <div class="panel panel-default p-0">
                            <div class="panel-body p-0"> 
                                <ul class="nav nav-tabs profile-tabs">
                                    <li class="active"><a data-toggle="tab" href="#aboutme">About Me</a></li>
                                    <li class=""><a data-toggle="tab" href="#user-activities">Hosted Events</a></li>
                                    <li class=""><a data-toggle="tab" href="#edit-profile">Ratings</a></li>
                                    <li class=""><a data-toggle="tab" href="#projects">FAQ</a></li>
                                </ul>

                                <div class="tab-content m-0"> 

                                    <div id="aboutme" class="tab-pane active">
                                    <div class="profile-desk">
                                        <h1><?php echo $check['a_fname'].' '.$check['a_lname'] ?></h1>
                                        <table class="table table-condensed">
                                            <thead>
                                                <tr>
                                                    <th colspan="3"><h3>Contact Information</h3></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><b>Name</b></td>
                                                    <td>
                                                    <a href="#" class="ng-binding">
                                                       <?php echo $check['a_fname'].' '.$check['a_lname']; ?>
                                                    </a></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Email</b></td>
                                                    <td>
                                                    <a href="#" class="ng-binding">
                                                       <?php echo $check['a_username']; ?>
                                                    </a></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Rating</b></td>
                                                    <td class="ng-binding"> 
                                                       <?php echo $detar[0]; ?>
                                                    
													</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Events Hosted</b></td>
                                                    <td class="ng-binding">
													
                                                       <?php echo  $detar[5]; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Bank:</b></td>
                                                    <td class="ng-binding">
													
                                                       £<?php
													   $money = getdatafromsql($conn, "select * from s_bank where b_a_id = ".$_SESSION['UID']."");
													    echo  number_format(($money['b_initial_bal']/100),2); ?>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div> <!-- end profile-desk -->
                                </div> <!-- about-me -->


                                <!-- Activities -->
                                <div id="user-activities" class="tab-pane">
                                    <div class="row m-t-10">
                                        <div class="col-md-12">
                                            <div class="portlet"><!-- /primary heading -->
                                                <div id="portlet2" class="panel-collapse collapse in">
                                                    <div class="portlet-body">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Event Name</th>
                                                                        <th>Description</th>
                                                                        <th>Date</th>
                                                                        <th>View</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

<?php
$sql = "SELECT * from s_events where e_a_id = ".$_SESSION['UID']." order by e_dnt asc";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
	$x =1;
    while($row = $result->fetch_assoc()) {

		?>
                                                                <tr>
                                    <td><?php echo $x ?></td>
                                    <td><?php echo  $row['e_name'];?> </td>
                                    <td><?php echo  $row['e_desc'];?> </td>
                                    <td><?php echo date('d-m-Y h:i a', $row['e_dnt'])?> </td>
                                    <td><a href="item.php?id=<?php echo md5($row['e_id']) ?>"><button class="btn btn-warning">View</button></a></td>
                                                                    </tr>
<?php $x++;
    }
} else {
    echo "0 results";
}

?>
    
                                                                    
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- /Portlet -->
                                        </div>
                                    </div>
                                </div>

                                <!-- settings -->
                                <div id="edit-profile" class="tab-pane">
                                    <div class="row m-t-10">
                                        <div class="col-md-12">
                                            <div class="portlet"><!-- /primary heading -->
                                                <div id="portlet2" class="panel-collapse collapse in">
                                                    <div class="portlet-body">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Event Name</th>
                                                                        <th>Description</th>
                                                                        <th>Host</th>
                                                                        <th>Date</th>
                                                                        <th>Rating</th>
                                                                        <th>Pay</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

<?php
$sql = "
select * from s_joins j
left join s_events e on e.e_id = j.j_e_id
left join s_accounts a on e.e_a_id = a.a_id
where j_a_id = '".$_SESSION['UID']."' and j_approved = 1 and e.e_dnt <= ".time()."
order by e_dnt asc";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
	$x =1;
    while($row = $result->fetch_assoc()) {

		?>
        <tr>
                <td style="width:5%"><?php echo $x ?></td>
                <td style="width:10%"><?php echo  $row['e_name'];?></td>
                <td style="width:20%"><?php echo  $row['e_desc'];?> </td>
                <td style="width:10%"><?php echo  $row['a_fname']." ".$row['a_lname'];?> </td>
                <td style="width:15%"><?php echo date('d-m-Y h:i a', $row['e_dnt'])?> </td>
                <td style="width:30%">
                <?php
			$ratex= getdatafromsql($conn, "select * from s_ratings where r_e_id = ".$row['e_id']." and r_a_id = ".$_SESSION['UID']."");	
		if(is_array($ratex) ){
			echo $ratex['r_val'];
		}else{
			?>
<div class="row">
	<div class="col-md-1">
            <form action="master_action.php" method="post">
            	<input type="hidden" value="<?php echo md5($row['e_id']); ?>" name="rat_1" />
                <input class="btn btn-warning" type="submit" value="1" />
            </form>
    </div>
	<div class="col-md-1" style="margin-left:10px">
            <form action="master_action.php" method="post">
            	<input type="hidden" value="<?php echo md5($row['e_id']); ?>" name="rat_2" />
                <input class="btn btn-warning" type="submit" value="2" />
            </form>
    </div>
	<div class="col-md-1" style="margin-left:10px">
            <form action="master_action.php" method="post">
            	<input type="hidden" value="<?php echo md5($row['e_id']); ?>" name="rat_3" />
                <input class="btn btn-warning" type="submit" value="3" />
            </form>
    </div>
	<div class="col-md-1" style="margin-left:10px">
            <form action="master_action.php" method="post">
            	<input type="hidden" value="<?php echo md5($row['e_id']); ?>" name="rat_4" />
                <input class="btn btn-warning" type="submit" value="4" />
            </form>
    </div>
	<div class="col-md-1" style="margin-left:10px">
            <form action="master_action.php" method="post">
            	<input type="hidden" value="<?php echo md5($row['e_id']); ?>" name="rat_5" />
                <input class="btn btn-warning" type="submit" value="5" />
            </form>
    </div>
</div>
            
            
            
            
            <?php
		}
				
				?>
                </td>
                
                
                                <td style="width:10%">
								
                                    <?php 
	if($row['j_paid'] == 0){
	?>
	<div class="col-md-3">
            <form action="master_action.php" method="post">
            	<input type="hidden" value="<?php echo md5($row['e_id']); ?>" name="money" />
                <input class="btn btn-success" type="submit" value="Pay Now (£<?php echo number_format(($row['e_price']/100), 2) ?>)!" />
            </form>
    </div>

<?php 
		}else {
			
		?>
    <div class="col-md-3">
                <input class="btn btn-danger" type="button" value="Paid" />
    </div>
        <?php 	
		}
?>

                                 </td>



            </tr>
<?php $x++;
    }
} else {
    echo "0 results";
}

?>
    
                                                                    
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- /Portlet -->
                                        </div>
                                    </div>
                                </div>


                                <!-- profile -->
                                <div id="projects" class="tab-pane">
                                    <div class="row m-t-10">
                                        <div class="col-md-12">
                                            <div class="portlet"><!-- /primary heading -->
                                                <div id="portlet2" class="panel-collapse collapse in">
                                                    <div class="portlet-body">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Thread Name</th>
                                                                        <th>User</th>
                                                                        <th>Date and Time</th>
                                                                        <th>View</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                <form action="master_action.php" method="post">
                                                                <tr>
                                                                	<td colspan="4">
                                                                    <input name="add_thread" class="form-control" placeholder="Write your question here.." />
                                                                    </td>
                                                                    <td>
                                                                    <button class="btn btn-success" type="submit">Make Thread</button>
                                                                    </td>
                                                                </tr>
                                                                </form>

<?php
$sql = "SELECT * FROM `s_threads` t
left join s_accounts a on t.t_a_id = a.a_id
order by t_time desc";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
	$x =1;
    while($row = $result->fetch_assoc()) {

		?>
                                                                <tr>
                                                                        <td><?php echo $x ?></td>
                                                                        <td><?php echo  $row['t_desc'];?> </td>
                                                                        <td><?php echo  $row['a_fname'].' '.$row['a_lname'];?> </td>
                                                                        <td><?php echo date('d-m-Y h:i a', $row['t_time'])?> </td>
                                                                        <td><a href="chat.php?id=<?php echo md5($row['t_id']) ?>"><button class="btn btn-warning">View</button></a></td>
                                                                    </tr>
<?php $x++;
    }
} else {
    echo "0 results";
}

?>
    
                                                                    
                                                                </tbody>
                                                            </table>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- /Portlet -->
                                        </div>
                                    </div>
                                </div>
                            </div>
             
                        </div> 
                    </div>
                </div>
            </div>

            

            


        </div>
            <!-- Page Content Ends -->
            <!-- ================== -->

            <!-- Footer Start -->
<?php
get_last();
?>
            <!-- Footer Ends -->



        </section>
        <!-- Main Content Ends -->
        


  <?php
     get_end();
?>