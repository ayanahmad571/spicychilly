<?php 
include("include.php");

check_login();

if(!isset($_GET['id'])){
	header('Location: home.php');
	die();
}else{
	$check = getdatafromsql($conn, "SELECT * FROM `s_threads` t left join s_accounts a on t.t_a_id = a.a_id where md5(t_id) = '".$_GET['id']."'");
	if(!is_array($check)){
		die('No threads found :(');
	}
}
get_header("SpiC Chilly - Threads Panel");
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

			<div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <!-- <div class="panel-heading">
                                <h4>Invoice</h4>
                            </div> -->
                            <div class="panel-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                        <h2> Thread: <?php echo $check['t_desc']; ?></h2>
                                        <h2> By: <?php echo $check['a_fname'].' '.$check['a_lname']; ?></h2>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                    <th>Name</th>
                                                    <th>Text</th>
                                                    <th>Date and Time</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                <form action="master_action.php" method="post">
                                                <tr>
                                                	<td colspan="2">
                                                    <input type="hidden" name="add_tid" value="<?php echo md5($check['t_id']) ?>" />
                                                    	<input class="form-control" placeholder="Post on this thread.." name="add_chat" required />
                                                    </td>
                                                    <td>
                                                    	<button type="submit" class="btn btn-success">Send</button>
                                                    </td>
                                                </tr>
                                                </form>
                                                
                                                <?php
												
$sql = "select * from s_chat c  
left join s_accounts a on c.c_a_id = a.a_id
where c_t_id = ".$check['t_id']."
order by c_dnt desc";
												


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       ?>
       
                                                    <tr>
                                                        <td><?php echo $row['a_fname']." ".$row['a_lname']; ?></td>
                                                        <td><?php echo $row['c_text']; ?></td>
                                                        <td><?php echo date('d-m-Y h:i a', $row['c_dnt'])?></td>
                                                    </tr>

                                            <?php 
	}
}
											?>

                                                </tbody>
                                            </table>
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