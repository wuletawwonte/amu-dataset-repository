<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?php echo base_url(); ?>/ico/favicon.ico" type="image/x-icon">	
   <title>Welcome to DR</title>

   <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>css/font-awesome.min.css" rel="stylesheet" type="text/css">
   <link href="<?php echo base_url(); ?>css/w3.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>css/adminStyler.css" rel="stylesheet" type="text/css">


    <link rel="shortcut icon" href="<?php echo base_url(); ?>ico/favicon.png">
</head>
<body>

   <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
         <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>img/amuDsrLog.png" height="27px" /></a>
         </div>
      <div id="navbar" class="navbar-collapse collapse">
         <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="<?php echo base_url(); ?>">Home</a></li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $this->session->userdata('username'); ?>
              <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url(); ?>welcome/editAdminProfileView"><i class="fa fa-user"></i> Profile</a></li>
                <li><a href="<?php echo base_url(); ?>welcome/logout"><i class="fa fa-sign-out"></i> Logout</a></li>
              </ul>
            </li>
         </ul>
         </div>
      </div>
   </nav>


   <div class="container col-lg-8 col-lg-offset-2" id="adminBody">
      <ul class="nav nav-tabs" >
        <li class="active"><a data-toggle="tab" href="#home">Users</a></li>
        <li><a data-toggle="tab" href="#rcTab">Research Centers</a></li>
      </ul>

      <div class="tab-content">
      
         <div id="home" class="tab-pane fade in active">
            <br>
            <h2>Users of the System</h2>

              <?php if(count($users) == 0) {
               echo("<br><h2><sup>There is no User Account created yet.</sup></h2>");
             } else { ?>


            <p>Edit user accounts</p>    <br>     
            <div class="w3-responsive">   
               <table class="w3-table table table-hover w3-bordered w3-striped w3-small w3-card-2" id="usersTable">
                  <thead>
                     <tr>
                        <th>Username</th>
                        <th>Research Center</th>
                        <th colspan="2" style="text-align: center; width: 20%; ">Edit</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php foreach ($users as $row) {  ?>
                     <tr>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php $controller->getRcName($row['research_center']); ?></td>
                        <td><a class="btn btn-xs w3-blue" data-toggle="modal" data-target="#<?php echo $row['user_id']; ?>"><i class="fa fa-edit"></i> Edit</a></td>

                        <!-- Edit Account Modal -->

                        <div class="modal fade" id="<?php echo $row['user_id']; ?>" tabindex="-1" role="dialog" 
                             aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <button type="button" class="close" 
                                           data-dismiss="modal">
                                               <span aria-hidden="true">&times;</span>
                                               <span class="sr-only">Close</span>
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel">
                                            Edit User Account
                                        </h4>
                                    </div>
                                    
                                    <!-- Modal Body -->
                                    <div class="modal-body">
                                        
                                        <form role="form" id="editAccountForm" method="post" action="<?php echo base_url(); ?>welcome/editAccount">
                                          <div class="form-group">
                                            <label for="exampleUsername">Username</label>
                                              <input type="text" class="form-control"
                                              name="exampleUsername" value="<?php echo $row['username']; ?>"/>
                                          </div>
                                          <div class="form-group">
                                            <label for="examplePassword">Password</label>
                                              <input type="text" class="form-control"
                                                  name="examplePassword" value="<?php echo $row['password']; ?>"/>
                                          </div>

                                          <input value="<?php echo $row['user_id']; ?>" id="user_id" name="user_id" hidden />

                                        </form>
                                        
                                        
                                    </div>
                                    
                                    <!-- Modal Footer -->
                                    <div class="modal-footer">
                                        <button type="submit" form="editAccountForm" class="btn btn-primary">
                                            Save changes
                                        </button>
                                        <button type="button" class="btn btn-default"
                                                data-dismiss="modal">
                                                    Close
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>



                        <td><a class="btn btn-xs w3-red" data-toggle="modal" href="<?php echo base_url(); ?>welcome/deleteAccount/?eid=<?php echo $row['user_id']; ?>" onclick="return confirm('The user is Going to be Delete')"><i class="fa fa-remove"></i> Delete</a></td>

                     </tr>
                     <?php } ?>
                  </tbody>
               </table>
            </div><br>
            <?php } ?>
            <a id="newAccountButton" class="w3-btn w3-teal" data-toggle="modal" data-target="#myModal" title="Create New Account">Create New Account</a>



            <!-- Create User Account Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" 
                 aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <button type="button" class="close" 
                               data-dismiss="modal">
                                   <span aria-hidden="true">&times;</span>
                                   <span class="sr-only">Close</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">
                                Create New Account
                            </h4>
                        </div>
                        
                        <!-- Modal Body -->
                        <div class="modal-body">
                            
                            <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>welcome/create_user_account" role="form" id="createAccountForm">
                              <div class="form-group">
                                <label  class="col-sm-4 control-label"
                                          for="username">Username</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" 
                                    name="username" placeholder="Username" required/>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-4 control-label"
                                      for="password" >Password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control"
                                        name="password" placeholder="Password" required/>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-4 control-label"
                                      for="researchCenter" >Research Center</label>
                                <div class="col-sm-8">
                                   <select class="form-control" id="researchCenter" name="researchCenter">
                                    <?php foreach ($rcs as $rc) {  ?>
                                      <option value="<?php echo $rc['rc_id']; ?>"><?php echo $rc['rc_name'];?></option>
                                    <?php } ?>
                                   </select>
                                </div>
                              </div>
                            </form>
                            
                            
                            
                            
                            
                            
                        </div>
                        
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                           <div class="form-group">
                              <div class="col-sm-offset-2 col-sm-10">
                                 <button type="submit" class="btn btn-primary" form="createAccountForm">Create Account</button>
                                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                           </div>

                        </div>
                    </div>
                </div>
            </div>
         </div>



         <!-- Research Centers tab content is   -->
         <div id="rcTab" class="tab-pane fade">
            <br>
            <h2>Research Centers</h2>

              <?php if(count($rcs) == 0) {
               echo("<br><h2><sup>There is no Research Center created yet.</sup></h2>");
             } else { ?>

            <p>Edit Research Centers</p>    <br>     


            <div class="w3-responsive">   
               <table class="w3-table table table-hover w3-bordered w3-striped w3-small w3-card-2" id="usersTable">
                  <thead>
                     <tr>
                        <th>Research Center Name</th>
                        <th colspan="2" style="text-align: center; width: 20%; ">Edit</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php foreach ($rcs as $row) {  ?>
                     <tr>
                        <td><?php echo $row['rc_name']; ?></td>
                        <td><a class="btn btn-xs w3-blue" data-toggle="modal" data-target="#<?php echo $row['rc_id']; ?>"><i class="fa fa-edit"></i> Edit</a></td>




                        <!-- Edit Research Center account modal starts here -->
                        <div class="modal fade" id="<?php echo $row['rc_id']; ?>" tabindex="-1" role="dialog" 
                             aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <button type="button" class="close" 
                                           data-dismiss="modal">
                                               <span aria-hidden="true">&times;</span>
                                               <span class="sr-only">Close</span>
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel">
                                            Edit Research Center Account
                                        </h4>
                                    </div>
                                    
                                    <!-- Modal Body -->
                                    <div class="modal-body">
                                        
                                        <form role="form" id="editRcAccountForm" method="post" action="<?php echo base_url(); ?>welcome/editRcAccount">
                                          <div class="form-group">
                                            <label for="editableRc">Research Center</label>
                                              <input type="text" class="form-control"
                                              name="editableRc" value="<?php echo $row['rc_name']; ?>"/>
                                          </div>
                                          <input type="text" id="researchCenterID" name="researchCenterID" value="<?php echo $row['rc_id']; ?>" hidden />

                                        </form>
                                        
                                        
                                    </div>
                                    
                                    <!-- Modal Footer -->
                                    <div class="modal-footer">
                                        <button type="submit" form="editRcAccountForm" class="btn btn-primary">
                                            Save changes
                                        </button>
                                        <button type="button" class="btn btn-default"
                                                data-dismiss="modal">
                                                    Close
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>




                        <td><a class="btn btn-xs w3-red" data-toggle="modal" href="<?php echo base_url(); ?>welcome/deleteRcAccount/?eid=<?php echo $row['rc_id']; ?>" onclick="return confirm('Be Carefull! The Research Center and user accounts in it are going to be deleted.')"><i class="fa fa-remove"></i> Delete</a></td>

                     </tr>
                     <?php } ?>
                  </tbody>
               </table>
            </div><br>
            <?php } ?>
            <a id="newRcAccountButton" class="w3-btn w3-teal" data-toggle="modal" data-target="#myModal2" title="Create New Account">Create New Research Center</a>

            <!-- Create new research center modal starts here..  -->
            <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" 
                 aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <button type="button" class="close" 
                               data-dismiss="modal">
                                   <span aria-hidden="true">&times;</span>
                                   <span class="sr-only">Close</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">
                                Create New Research Center Account
                            </h4>
                        </div>
                        
                        <!-- Modal Body -->
                        <div class="modal-body">
                            
                            <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>welcome/create_rc_account" role="form" id="createRcAccountForm">
                              <div class="form-group">
                                <label  class="col-sm-4 control-label"
                                          for="rcName">Research Center</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" 
                                    name="rcName" placeholder="Research Center" required/>
                                </div>
                              </div>                            
                        </div>
                        
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                           <div class="form-group">
                              <div class="col-sm-offset-2 col-sm-10">
                                 <button type="submit" class="btn btn-primary" form="createRcAccountForm">Create Research Center Account</button>
                                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                           </div>

                        </div>
                    </div>
                </div>

            
         </div>
      
      </div>
   </div>

   <script src="<?php echo base_url(); ?>js/jquery.js"></script>
   <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
   <script src="<?php echo base_url(); ?>js/tableFixRows.js"></script>


</body>
</html>
























































































































