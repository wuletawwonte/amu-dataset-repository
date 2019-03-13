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
  	<link href="<?php echo base_url(); ?>css/w3.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>css/styler.css" rel="stylesheet" type="text/css">

</head>
<body>

   <div class="container">
      <div class="row" id="first-header-search-result">
         <div class="col-lg-10 col-lg-offset-2 col-md-10 col-md-offset-2 col-xs-12">
            
            <form class="navbar-form navbar-right" method="post" action="<?php echo base_url(); ?>welcome/user_validation">
               <div class="form-group">
                  <input type="text" placeholder="Username" class="form-control" name="username" required>
               </div>
               <div class="form-group">
                  <input type="password" placeholder="Password" class="form-control" name="password" required>
               </div>
               <button type="submit" class="w3-btn w3-light-grey"><i class="fa fa-user"></i> Login</button>
	            <span class="text-danger"><?php if(isset($error)){ echo $error; } ?></span>               
            </form>
         
         </div>
      </div>
      
      <div class="row" id="searchResultRow">

      	<div class="col-lg-10 col-lg-offset-1">
      		<div class="row" id="formTop">
      			<div class="col-lg-1 col-md-1 col-xs-1">
      				<a href="<?php echo base_url();?>"><img src="<?php echo base_url(); ?>img/amuDsrLog.png" width="54"></a>
      			</div>





            <div class="input-group col-lg-11 col-md-11 col-xs-11">
                <input type="text" form="searchForm" onfocus="this.value = this.value;" value="<?php echo $searchT; ?>" size="40" autofocus class="form-control input-lg" id="searchText" name="searchText" placeholder="search ..." required />
                <div class="input-group-btn">
                    <div class="btn-group" role="group">
                        <div class="dropdown dropdown-lg">
                            <button type="button" class="btn btn-default btn-lg dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                            <div class="dropdown-menu dropdown-menu-right" role="menu">
          
                            <form class="form-horizontal" id="searchForm" role="form" method="post" action="<?php echo base_url(); ?>welcome/searchFile">

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

                             <div class="form-group">
                                <label  class="col-sm-4 control-label"
                                          for="year">Year</label>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control" 
                                    name="year" placeholder="year" max="2040" min="1980"/>
                                </div>
                              </div>


                           <div class="form-group">
                              <div class="col-sm-offset-4 col-sm-10">
                                  <button type="submit" class="btn btn-primary searchBtn"><i class="fa fa-search"></i> Search</button>
                              </div>
                           </div>

                          </div>
                        </div>
                        <button type="submit" class="btn btn-primary searchBtn"><i class="fa fa-search"></i> Search</button>
                    </div>
                </div>
            </div>

         </form>
      </div>
   </div>



</div>

		    <div id="resultDiv" class="col-lg-10 col-lg-offset-1"> 
		        <?php if(count($files) == 0) {
		        	echo("<h2>Your search Query couldn't return any result.</h2>");
			    } else { ?>
		               	<table class="w3-table w3-bordered" id="resultTable">
   		                	<tbody>
		      			<?php foreach ($files as $row) {
		      				?>
		      				<tr>
		      					<td>
		      						<b><span data-toggle="tooltip" title="click for details"><a id="resultTitle" href="#" data-toggle="modal" data-target="#details<?php echo $row['file_id']; ?>"><?php echo $row['file_title']?></a></span></b><br>
		      						<p class="text-muted"><?php echo $row['upload_time']; ?></p>
		      						<span>Author: </span><?php echo $row['file_author']?>
		      					</td>
		      					<td>

		      						<?php if($row['access_level'] == 0) { ?>
			      						<a target="_blank" style="background-color: teal" href="<?php echo base_url(); ?>uploads/<?php echo $row['file_name']; ?>" class="btn btn-primary btn-lg"><i class="fa fa-download"></i></a>
			      					<?php } else { ?>
			      						<a target="_blank" data-target="#download<?php echo $row['file_id']; ?>" data-toggle="modal" style="background-color: teal;" class="btn btn-primary btn-lg"><i class="fa fa-lock"></i></a>
			      					<?php }?>

 		      					</td>
		      				</tr>



		      				<!-- Details modal starts here -->


		      			<div class="modal fade" id="details<?php echo $row['file_id']; ?>" tabindex="-1" role="dialog" 
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
	                                            <?php echo $row['file_title']; ?>
	                                        </h4>
	                                    </div>
	                                    
	                                    <!-- Modal Body -->
	                                    <div class="modal-body">
		                                        <p><?php echo $row['file_description']; ?></p>
		                                        Year: <?php echo $row['year']; ?>                                     
	                                    </div>
	                                    
	                                    <!-- Modal Footer -->
	                                    <div class="modal-footer">
	                                        <button type="button" class="btn btn-default"
	                                                data-dismiss="modal">
	                                                    Close
	                                        </button>

	                                    </div>
	                                </div>
	                            </div>
	                        </div>



	                        <!-- Restricted file download modal starts here -->

		      			    <div class="modal fade" id="download<?php echo $row['file_id']; ?>" tabindex="-1" role="dialog" 
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
	                                            File Title: <?php echo $row['file_title']; ?>
	                                        </h4>
	                                    </div>
	                                    
	                                    <!-- Modal Body -->
	                                    <div class="modal-body">
	                                        
	                                        <form role="form" id="dform<?php echo $row['file_id']?>" method="post" action="<?php echo base_url(); ?>welcome/dRestrictedFile">

		                                        <div class="form-group">
		                                            <label for="file_id">File Id</label>
		                                              <input type="text" class="form-control"
		                                              name="file_id" value="<?php echo $row['file_id']; ?>" readonly/>
		                                        </div>

		                                        <div class="form-group">
		                                            <label for="dCode">Download Code</label>
		                                              <input type="text" class="form-control"
		                                              name="dCode" placeholder="Download Code ..." required/>
		                                        </div>

		                                        <input type="text" name="file_name" id="file_name" value="<?php echo $row['file_name'];?>" hidden>

	                                        </form>
	                                        
	                                    </div>
	                                    
	                                    <!-- Modal Footer -->
	                                    <div class="modal-footer">
	                                        <button type="submit" form="dform<?php echo $row['file_id']?>" class="btn btn-primary">
	                                            Download
	                                        </button>

	                                        <button type="button" class="btn btn-default"
	                                                data-dismiss="modal">
	                                                    Close
	                                        </button>

	                                    </div>
	                                </div>
	                            </div>
	                        </div>














		      	<?php }	?>
		      				</tbody>
		      			</table>		      			
		      	<?php } ?>

     		</div>

        </div>
      </div>




   </div>

   <footer class="footer">
     <p class="text-muted">Copyright &copy 2017, <a target="_blank" href="http://www.amu.edu.et">Arbaminch University</a></p>
   </footer>

   <script src="<?php echo base_url(); ?>js/jquery.js"></script>
   <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
   <script type="text/javascript">

   	$(document).ready(function() {
    	var input = $("#searchText");
    	var len = input.val().length;
    	input[0].focus();
    	input[0].setSelectionRange(len, len);

	});   	

   </script>

</body>
</html>

