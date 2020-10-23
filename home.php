<?php 
include("include.php");

check_login();
get_header("SpiC Chilly - Home Panel");
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
                            <div class="panel-heading"><h3 class="panel-title">Welcome, lets get you some food!!</h3></div>
                            <form action="<?php echo basename($_SERVER['PHP_SELF']) ?>" method="get">
                                <div class="panel-body">
                                    <div class="col-xs-8 col-md-10">
                                        <input type="text" class="form-control" placeholder="Search...." name="s" value="<?php echo (isset($_GET['s'])? $_GET['s']: '') ?>">
                                    </div>
                                    <div class="col-xs-4 col-md-2">
                                        <button type="submit" class="btn btn-success m-l-10">Search</button>
                                         <a href="home.php"><button type="button" class="btn btn-warning m-l-10">Clear</button></a>
                                    </div>
                                </div> <!-- panel-body -->
                            </form>
                        </div> <!-- panel -->
                    </div> <!-- col -->
                     
                </div> <!-- End row -->


                <div class="row">
    <?php
	if(isset($_GET['s'])){
                $sql = "select *, ifnull((select count(*) from s_joins where j_e_id = e_id and j_approved = 1),0) as alpha from s_events e
				left join s_accounts a on e.e_a_id = a.a_id where
				(`e_name` LIKE '%".$_GET['s']."%' or `e_cuisine` LIKE '%".$_GET['s']."%' 
				or e_desc LIKE '%".$_GET['s']."%'
				or e_price LIKE '%".$_GET['s']."%'
				or e_people LIKE '%".$_GET['s']."%' )and 
				e_dnt >= ".time()." 
				
				order by e_dnt asc
				";
		
	}else{
                $sql = "select *, ifnull((select count(*) from s_joins where j_e_id = e_id and j_approved = 1),0) as alpha from s_events e
				left join s_accounts a on e.e_a_id = a.a_id
				where e_dnt >= ".time()." 
				order by e_dnt asc
				";
	}
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
	$x = 1;
    while($row = $result->fetch_assoc()) {
        ?>
        
                            <div class="col-sm-6">
                            <a href="item.php?id=<?php echo md5($row['e_id']) ?>">
                        <div class="panel">
                        
                            <div class="panel-body p-t-10">
                                <div class="media-main">
                                    <div class="pull-left" href="#" style="margin-right:10px">
                                        <img class="thumb-lg img-square bx-s" src="<?php echo $row['e_img_src']; ?>" alt="">
                                    </div>
                                    <div class="info">
                                        <h4><?php echo $row['e_name']; ?></h4>
                                    <p class="text-muted"><strong>Hosted by</strong>: 
									<?php echo ($row['e_a_id'] == $_SESSION['UID']? "You": $row['a_fname'].' '.$row['a_lname']) ?> <br>
                                    <strong>Date</strong>: <?php echo date('d-m-Y h:i a', $row['e_dnt'])?> <br>
									<?php echo $row['e_desc']; ?></p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <hr/>
                                <ul class="social-links list-inline p-b-10">
                                    <li>
                                        <?php echo 'Serves: <strong>'.$row['e_people'].'</strong> people'; ?>
                                    </li>
                                    <li>
                                        <?php echo '<strong>'.number_format($row['e_price']/100, 2).'</strong> Pounds'; ?>
                                    </li>
                                    <li>
                                        <?php echo 'Cuisine : <strong>'.$row['e_cuisine'].'</strong>'; ?>
                                    </li>
                                    <li>
                                        <?php echo 'Spots Left : <strong>'.($row['e_people']- $row['alpha']).'</strong>'; ?>
                                    </li>
                                    <li>
                                        
                                    </li>
                                </ul>
                            </div> <!-- panel-body -->
                        </div> <!-- panel -->
                        </a>
                    </div> <!-- end col -->


        <?php
		if($x%2 == 0){
			echo '</div><div class="row">';
		}
		$x++;
    }
} else {
    echo "No Events Nearby";
}

?>
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