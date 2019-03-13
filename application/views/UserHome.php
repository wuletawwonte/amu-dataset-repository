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
    <link href="<?php echo base_url(); ?>css/bootstrap-datepicker.css" rel="stylesheet" type="text/css">
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
            <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>img/DSadminlogo.png" height="27px" /></a>
         </div>
      <div id="navbar" class="navbar-collapse collapse">
         <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="<?php echo base_url(); ?>">Home</a></li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $this->session->userdata('username'); ?>
              <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url(); ?>welcome/editUserProfileView"><i class="fa fa-user"></i> Profile</a></li>
                <li><a href="<?php echo base_url(); ?>welcome/logout"><i class="fa fa-sign-out"></i> Logout</a></li>
              </ul>
            </li>
         </ul>
         </div>
      </div>
   </nav>

   	<div class="container col-lg-8 col-lg-offset-2" id="adminBody">
		<ul class="nav nav-tabs">
		   <li class="active"><a data-toggle="tab" href="#uploadFile">Upload File</a></li>
		   <li><a data-toggle="tab" href="#files">Uploaded Files</a></li>
		</ul>

	    <div class="tab-content">

	    	<!-- Form for file uploading -->

	      	<div class="tab-pane fade in active" id="uploadFile">

	            <br>
	            <div style="text-align: center;">
		            <h2>Upload Dataset File</h2>
		            <p>Fields with <sup>*</sup> cannot be empty</p>    <br>     
		        </div>
	            <!-- Upload Dataset File  -->

                <form class="form-horizontal" enctype=multipart/form-data method="post" action="<?php echo base_url(); ?>welcome/upload" role="form">

	                <?php if(isset($success_msg)) { echo $success_msg; } ?>
                 
                  <div class="form-group">
                    <label  class="col-sm-4 control-label"
                              for="fileInput">File <sup>*</sup></label>
                    <div class="col-sm-8">
			            <div class="input-group">
			                <input type="text" class="form-control" id="fileAddress" readonly>
			                <label class="input-group-btn">
			                    <span class="btn btn-primary">
			                        Browse&hellip; <input type="file" accept=".xlsx, .xls, .doc, .docx, .ppt, .pptx, .txt, .pdf" name="fileInput" style="display: none;" id="fileInput">
			                    </span>
			                </label>
			            </div>
			            <span class="text-danger"><?php if(isset($error)){ echo $error; } ?></span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label  class="col-sm-4 control-label"
                              for="fileTitle">File Title <sup>*</sup></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" 
                        name="fileTitle" placeholder="Title of the file" required/>
  			            <span class="text-danger"><?php if(isset($error2)){ echo $error2; } ?></span>
                    </div>
                  </div>
  
                  <div class="form-group">
                    <label class="col-sm-4 control-label"
                          for="fileDescription" >Description <sup>*</sup></label>
                    <div class="col-sm-8">
                    	<textarea class="form-control" rows="2" placeholder="Description ..." name="fileDescription" id="fileDescription" required></textarea>
                        <span class="help-block">Fill this field carefully ...</span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label  class="col-sm-4 control-label"
                              for="fileAuthor">Author <sup>*</sup></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" 
                        name="fileAuthor" placeholder="Author of the file" required/>
                    </div>
                  </div>

                  <div class="form-group">
                    <label  class="col-sm-4 control-label"
                              for="year">Year of Data Gathering <sup>*</sup></label>
                    <div class="col-sm-8">
						<div class='input-group date' id='uploadYear'>
			                <input name="year" type='text' class="form-control" required />
			                <span class="input-group-addon">
			                    <span class="glyphicon glyphicon-calendar">
			                    </span>
			                </span>
			            </div>
                    </div>
                  </div>


                  <div class="form-group">
                    <label  class="col-sm-4 control-label"
                              for="Alevel">Access Level</label>
                    <div class="col-sm-8">
						<label class="radio-inline"><input type="radio" value = 0 checked name="Alevel">Public</label>
						<label class="radio-inline"><input type="radio" value = 1 name="Alevel">Restricted</label>  
                    </div>
                  </div>

                  <div class="form-group">
				    <div class="col-sm-8 col-sm-offset-4">
				      <button type="submit" class="btn btn-primary">Submit</button>
				    </div>
				  </div>
                </form>
                            
                            


	      	</div>

	      	<!-- Uploaded files tab -->

	      	<div id="files" class="tab-pane fade">
	            <br>
	            <div style="text-align: center;">
		            <h2>Uploaded Dataset Files</h2>
			        <?php if(count($files) == 0) {
			        	echo("<br><h2 style='text-align: left;'><sup>There is no file uploaded yet.<sup></h2>");
				    } else { ?>

		            <p>Edit the metadata of files uploaded</p>    <br>     
		        </div>

	            <div class="w3-responsive">   
	               <table class="w3-table table table-hover w3-bordered w3-striped w3-small w3-card-2" id="usersTable">
	                  <thead>
	                     <tr>
	                        <th>Title</th>
	                        <th>Author</th>
	                        <th colspan="3" style="text-align: center; width: 20%; ">Edit</th>
	                     </tr>
	                  </thead>
	                  <tbody>
	                     <?php foreach ($files as $row) {  ?>
	                     <tr>
	                        <td><?php echo $row['file_title']; ?></td>
	                        <td><?php echo $row['file_author']; ?></td>


	                        <td><a class="btn btn-xs w3-blue" data-toggle="modal" data-target="#<?php echo $row['file_id']; ?>"><i class="fa fa-edit"></i> Edit</a></td>

	                        <!-- Edit File Metadata Modal -->

	                        <div class="modal fade" id="<?php echo $row['file_id']; ?>" tabindex="-1" role="dialog" 
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
	                                            Edit File Metadata
	                                        </h4>
	                                    </div>
	                                    
	                                    <!-- Modal Body -->
	                                    <div class="modal-body">
	                                        
	                                        <form role="form" id="editFileMetadata" method="post" action="<?php echo base_url(); ?>welcome/editFileMetadata">

		                                        <div class="form-group">
		                                            <label for="fileTitle">File Title</label>
		                                              <input type="text" class="form-control"
		                                              name="fileTitle" value="<?php echo $row['file_title']; ?>"/>
		                                        </div>

		                                        <div class="form-group">
		                                            <label for="fileDescription">Description</label>
								                    	<textarea class="form-control" rows="2" name="fileDescription" id="fileDescription"><?php echo $row['file_description']; ?></textarea>
							                        <span class="help-block">Fill this field carefully ...</span>
		                                        </div>


		                                        <div class="form-group">
		                                            <label for="fileAuthor">File Author</label>
		                                              <input type="text" class="form-control"
		                                              name="fileAuthor" value="<?php echo $row['file_author']; ?>"/>
		                                        </div>

		                                        <div class="form-group">
		                                            <label for="year">Year</label>
		                                              <input type="number" class="form-control"
		                                              name="year" min="1980" max="2040" value="<?php echo $row['year']; ?>"/>
		                                        </div>

		                                        <?php if($row['access_level'] == 1) { ?>
		                                        <div class="form-group">
		                                            <label for="dcode">Download Code</label>
		                                              <input type="text" class="form-control"
		                                              name="dcode" value="<?php echo $row['downloadCode']; ?>" readonly/>
		                                        </div>
		                                        <?php  } ?>
							

	                                          <input value="<?php echo $row['file_id']; ?>" id="file_id" name="file_id" hidden />

	                                        </form>	                                        
	                                        
	                                    </div>
	                                    
	                                    <!-- Modal Footer -->
	                                    <div class="modal-footer">
	                                        <button type="submit" form="editFileMetadata" class="btn btn-primary">
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



	                        <td><a target="_blank" class="btn btn-xs w3-teal" href="<?php echo base_url(); ?>uploads/<?php echo $row['file_name']; ?>"><i class="fa fa-download"></i> Download</a></td>
	                        <td><a class="btn btn-xs w3-red" href="<?php echo base_url(); ?>welcome/deleteAccount/?eid=<?php echo $row['file_id']; ?>" onclick="return confirm('The user is Going to Delete')"><i class="fa fa-remove"></i> Delete</a></td>

	                     </tr>
	                     <?php }} ?>
	                  </tbody>
	               </table>
	            </div><br>

			</div>

	    </div>
	</div>

   <script src="<?php echo base_url(); ?>js/jquery.js"></script>
   <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
   <script src="<?php echo base_url(); ?>js/moment.min.js"></script>
   <script src="<?php echo base_url(); ?>js/bootstrap-datepicker.min.js"></script>
   <script src="<?php echo base_url(); ?>js/fileUploadHelper.js"></script>

	<script type="text/javascript">
        $(function () {
            $('#uploadYear').datetimepicker({
                viewMode: 'years',
                format: 'YYYY'
            });
        });
    </script>

</body>
</html>

