<?php 
include("include.php");

check_login();

if(!isset($_GET['id'])){
	header('Location: home.php');
	die();
}else{
	$check = getdatafromsql($conn, "select *, ifnull((select count(*) from s_joins where j_e_id = e_id and j_approved = 1),0) as alpha from s_events where md5(e_id) = '".$_GET['id']."'");
	if(!is_array($check)){
		die('No cooking event found :(');
	}
}
get_header("SpiC Chilly - Items Panel");
?>

        <!-- Aside Start-->
<?php
get_nav();

$mainusrarr = getuserdets($check['e_a_id'], $conn);
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



                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <!-- <div class="panel-heading">
                                <h4>Invoice</h4>
                            </div> -->
                            <div class="panel-body">
                                <div class="clearfix">
                                    <div align="center">
                                        <h1 class="text-center"><?php echo $check['e_name'] ?></h1>
                                        
                                    </div>


      		                        <div align="center">
                                    <div class="col-md-3 col-xs-2"></div>
                                    <div class="col-md-6 col-xs-8"><img class="img-responsive" src="<?php echo $check['e_img_src']; ?>" alt="velonic"></div>
                                    <div class="col-md-3 col-xs-2"></div>
                                        
                                        
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pull-left m-t-30">
											<h3><?php echo $check['e_desc'] ?></h3>
                                        </div>
                                        <div class="pull-right m-t-30">
                                            <p><strong>Serves: </strong> <?php echo $check['e_people'] ?></p>
                                            <p class="m-t-10"><strong>When?: </strong> <?php echo date('d-m-Y, h:i a', $check['e_dnt']); ?></p>
                                            <p class="m-t-10"><strong>People Signed up: </strong> <?php echo $check['alpha'] ?></p>
                                            <p class="m-t-10"><strong>Cuisine: </strong> <?php echo $check['e_cuisine'] ?></p>
                                            <p class="m-t-10"><strong>Host: </strong> <?php echo $mainusrarr[3] ?> <?php echo $mainusrarr[4] ?>(<?php echo $mainusrarr[0] ?>)</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-h-50"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table m-t-30">
                                                <thead>
                                                    <tr><th>#</th>
                                                    <th>Name</th>
                                                    <th>Rating</th>
                                                    <?php if($check['e_a_id'] == $_SESSION['UID']){ echo '<th>Action</th>';}?>
                                                </tr></thead>
                                                <tbody>
                                                
                                                <?php
												
if($check['e_a_id'] != $_SESSION['UID']){
	$sql = "
SELECT * FROM s_joins j
left join s_accounts a on j.j_a_id = a.a_id

where j_e_id = ".$check['e_id'].' and j_approved = 1';
}else{
	
	$sql = "
SELECT * FROM s_joins j
left join s_accounts a on j.j_a_id = a.a_id

where j_e_id = ".$check['e_id'].'';

}
												


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
	$x = 1;
    while($row = $result->fetch_assoc()) {
		$usrarr = getuserdets($row['a_id'],$conn);
       ?>
       
                                                    <tr>
                                                        <td><?php echo $x; ?></td>
                                                        <td><?php echo $row['a_fname']." ".$row['a_lname']; ?></td>
                                                        <td><?php echo $usrarr[0] ?></td>
                                                    <?php if($check['e_a_id'] == $_SESSION['UID']){ 
													
													echo '<td>';  
													
													if($row['j_approved'] == 0){
														?>
                                                        <form action="master_action.php" method="post">
                                                        <input type="hidden" name="join_add" value="<?php echo md5($row['j_id']) ?>" />
                                                        <input type="submit" class="btn btn-success" value="Approve"/>
                                                        </form>
                                                        <?php
													}else{
														?>
                                                        <form action="master_action.php" method="post">
                                                        <input type="hidden" name="join_rem" value="<?php echo md5($row['j_id']) ?>" />
                                                        <input type="submit" class="btn btn-danger" value="Remove"/>
                                                        </form>
                                                        <?php
													}
													echo'</td>';
													
													}?>
                                                    </tr>
       
       <?php
    }
} else {
    ?>
    <tr>
                                                        <td colspan="3">None</td>
                                                    </tr>
    <?php
}
												?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?php if($check['e_a_id'] != $_SESSION['UID']){ ?>
                                <div class="hidden-print">
                                <?php if($check['alpha'] >= $check['e_people']){
									echo '<div class="pull-right" style="color:red">Party Is full</div>';
									}else{ ?>
                                    <div class="pull-right">
                                    <?php
									$reg = getdatafromsql($conn, "select * from s_joins where  j_e_id = '".$check['e_id']."' and j_a_id = '".$_SESSION['UID']."' ");
										if(is_array($reg)){
											if($reg['j_approved'] == 0){
												?>
                                                    <input type="submit" value="Awaiting Approval" class="btn btn-danger" disabled/>
                                                        <?php
                                                    }else{
                                                        ?>
                                            <form action="master_action.php" method="post">
                                    	<input type="hidden" name="join_leave" value="<?php echo md5($reg['j_id']) ?>" />
                                        <input type="submit" value="Leave" class="btn btn-warning"/>
                                    </form>
                                                        <?php
                                                    }
										}else{
											?>
                                            <form action="master_action.php" method="post">
                                    	<input type="hidden" name="join" value="<?php echo md5($check['e_id']) ?>" />
                                        <input type="submit" value="Join" class="btn btn-primary"/>
                                    </form>
                                            <?php
										}
										
										
										
									?>
                                    
                                    </div>
                                    <?php } ?>
                                    
                                </div>
                                <?php }
								
								
								 ?> 
                            </div>
                        </div>

                    </div>

                </div> <!-- End row -->



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