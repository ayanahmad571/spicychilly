<?php
include("include.php");

if(isset($_SESSION['UID'])){
	header('Location: home.php');
	die();
}
?>
<?php
get_header('SpiC Chilly - Create Account Panel');
?>

        <div class="wrapper-page animated fadeInDown">
            <div class="panel panel-color panel-primary">
                <div class="panel-heading"> 
                   <h3 class="text-center m-t-10"> Sign Up for <strong>SpiC Chilli</strong> </h3>
                </div> 

                <form class="form-horizontal m-t-40" action="master_action.php" method="post">
                                            
                    <div 	class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" placeholder="First Name" name="c_fname">
                        </div>
                    </div>


                    <div 	class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" placeholder="Last Name" name="c_lname">
                        </div>
                    </div>


                    <div 	class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="email" placeholder="Email" name="c_email">
                        </div>
                    </div>

                    <div class="form-group ">
                        
                        <div class="col-xs-12">
                            <input class="form-control" type="password" placeholder="Password" name="c_pass1">
                        </div>
                    </div>
                    
                                       <div class="form-group ">
                        
                        <div class="col-xs-12">
                            <input class="form-control" type="password" placeholder="Re-Enter Password" name="c_pass2">
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <div class="col-xs-12">
                            <input type="submit" value="Create" name="create" class="btn btn-purple w-md"  />
                        </div>
                    </div>
                    <div class="form-group m-t-30">
                        <div class="col-sm-12 text-right">
                            <a href="login.php">Login</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    
<?php
get_end();
?>