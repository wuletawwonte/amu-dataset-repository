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
	<link href="<?php echo base_url(); ?>css/styler.css" rel="stylesheet" type="text/css">

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
            <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>img/DSadminlogo.png" height="27px" /></a>
         </div>
      <div id="navbar" class="navbar-collapse collapse">
         <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li class="active dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $this->session->userdata('username'); ?>
              <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="active"><a href="<?php echo base_url(); ?>welcome/editAdminProfileView"><i class="fa fa-user"></i> Profile</a></li>
                <li><a href="<?php echo base_url(); ?>welcome/logout"><i class="fa fa-sign-out"></i> Logout</a></li>
              </ul>
            </li>
         </ul>
         </div>
      </div>
   </nav>

   <div class="container col-lg-8 col-lg-offset-2" id="adminBody">

   	<br><br>
   	<h3 style="text-align: center"><b>Edit Account Information</b></h3><br>
	  
		<span class="text-success col-sm-offset-4 col-sm-8"><?php if(isset($success_msg)) { echo $success_msg; } ?></span>
		<span class="text-danger col-sm-offset-4 col-sm-8"><?php if(isset($error_msg)) { echo $error_msg; } ?></span>

	   <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>welcome/editAdminAccount" role="form" id="createAccountForm">
	      <div class="form-group">
	        <label  class="col-sm-4 control-label"
	                  for="username">Username</label>
	        <div class="col-sm-8">
	            <input type="text" class="form-control" 
	            name="username" value="Admin" readonly/>
	        </div>
	      </div>
	      
	      <div class="form-group">
	        <label class="col-sm-4 control-label"
	              for="oldP" >Old Password</label>
	        <div class="col-sm-8">
	            <input type="password" class="form-control"
	                name="oldP" placeholder="Password" required/>
	        </div>
	      </div>	      

	      <div class="form-group">
	        <label class="col-sm-4 control-label"
	              for="newP" >New Password</label>
	        <div class="col-sm-8">
	            <input type="password" class="form-control"
	                name="newP" placeholder="Password" required/>
	        </div>
	      </div>	      

	      <div class="form-group">
	        <label class="col-sm-4 control-label"
	              for="confirmP" >Confirm Password</label>
	        <div class="col-sm-8">
	            <input type="password" class="form-control"
	                name="confirmP" placeholder="Password" required/>
	        </div>
	      </div>

	       <div class="form-group">
	          <div class="col-sm-offset-4 col-sm-8">
	             <button type="submit" class="btn btn-primary">Save Change</button>
	             <button type="reset" class="btn btn-default">Reset</button>
	          </div>
	       </div>


	    </form>
	    
	    
	    
	    
	    


      
   </div>

   <script src="<?php echo base_url(); ?>js/jquery.js"></script>
   <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
   <script src="<?php echo base_url(); ?>js/tableFixRows.js"></script>

</body>
</html>

