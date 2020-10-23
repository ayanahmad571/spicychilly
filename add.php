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
                                    <div class="col-md-8 col-md-offset-2 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title">Add an event</h3></div>
                            <div class="panel-body">
                                <form class="form-horizontal" role="form" action="master_action.php" method="post">
                                    

                                     
                                    <div class="form-group">
                                        <label for="a1" class="col-sm-3 control-label">Name</label>
                                        <div class="col-sm-9">
                                          <input type="text" class="form-control" id="a1" placeholder="Name of the Dish" name="event_name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="a11" class="col-sm-3 control-label">Cuisine</label>
                                        <div class="col-sm-9">
                                          <input type="text" class="form-control" id="a11" placeholder="Cuisine" name="event_cui">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="a111" class="col-sm-3 control-label">Description of the Event</label>
                                        <div class="col-sm-9">
                                          <input type="text" class="form-control" id="a111" placeholder="Description" name="event_desc">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="a122" class="col-sm-3 control-label">Post Code</label>
                                        <div class="col-sm-9">
                                          <input type="text" class="form-control" id="a122" placeholder="Postcode of Event" name="event_pc">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="a133" class="col-sm-3 control-label">Price</label>
                                        <div class="col-sm-9">
                                          <input type="number" min="0" class="form-control" id="a133" placeholder="Price per person in pence" name="event_price">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="a155" class="col-sm-3 control-label">People</label>
                                        <div class="col-sm-9">
                                          <input type="number" min="0" class="form-control" id="a155" placeholder="Max Number of People" name="event_people">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="a1d55" class="col-sm-3 control-label">URL Source of Image</label>
                                        <div class="col-sm-9">
                                          <input type="text" class="form-control" id="a1d55" placeholder="http://image.com/g.jpg" name="event_img">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="timeme" class="col-sm-3 control-label">Date of the Event</label>
                                        <div class="col-sm-9">
                                          <input type="text" class="form-control" id="timeme" placeholder="DD-MM-YYYY" name="event_date">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="dtimeme" class="col-sm-3 control-label">Time of the Event</label>
                                        <div class="col-sm-9">
                                          <input type="text" class="form-control" id="dtimeme" placeholder="14:00" name="event_time">
                                        </div>
                                    </div>
                                

                                    <div class="form-group m-b-0">
                                        <div class="col-sm-offset-3 col-sm-9">
                                        	<input type="submit" name="event_add" class="btn btn-info" value="Add Event"  />
                                        </div>
                                    </div>
                                </form>
                            </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- col -->
                    
                    
                    
                    
                
                </div> <!-- End row -->

        <!-- js placed at the end of the document so the pages load faster -->



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