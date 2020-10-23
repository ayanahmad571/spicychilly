<?php
include("include.php");

if(isset($_SESSION['UID'])){
	header('Location: home.php');
	die();
}
?>
<?php
get_header('SpiC Chilly - Login Panel');
?>

        <div class="wrapper-page animated fadeInDown">
            <div class="panel panel-color panel-primary">
                <div class="panel-heading"> 
                   <h3 class="text-center m-t-10"> Sign In to <strong>SpiC Chilli</strong> </h3>
                </div> 
				<?php
				if(isset($_GET['e'])){
					echo '<p style="color:red">Incorrect Details.</p>';
				}else if(isset($_GET['l'])){
					echo '<p style="color:red">Login to continue.</p>';
				}
				?>
                <form class="form-horizontal m-t-40" action="master_action.php" method="post">
                                            
                    <div 	class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="email" placeholder="Email" name="email">
                        </div>
                    </div>
                    <div class="form-group ">
                        
                        <div class="col-xs-12">
                            <input class="form-control" type="password" placeholder="Password" name="pass">
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <div class="col-xs-12">
                            <input type="submit" value="Login" name="submit" class="btn btn-purple w-md"  />
                        </div>
                    </div>
                    <div class="form-group m-t-30">
                        <div class="col-sm-12 text-right">
                            <a href="create.php">Create an account</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    
<?php
get_end();
?>