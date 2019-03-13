<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="wuletawwonte@yahoo.com">
	<link rel="icon" href="<?php echo base_url(); ?>/ico/favicon.ico" type="image/x-icon">
	<title>Welcome to AMU-DRS</title>

  <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>css/w3.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>css/stylerMain.css" rel="stylesheet" type="text/css">

</head>
<body>

   <div class="se-pre-con"></div>
   
   <div class="container">
      <div class="row" id="first-header">
         <div class="col-lg-12 col-md-12 col-xs-12">
            <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>img/amuDsrLogo.png" height="55px" /></a>

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
  
  <!-- search form area starts here -->

      <div class="row" id="searchArea">    


          <div class="row" id="secondRow">

             <div class="intro-heading">
                <h3 id="intro-heading">Arbaminch University Dataset Repository</h3>
             </div>

          </div>

          <!-- Third Row content starts here -->

          <div class="row col-xs-12" id="thirdRow">

              <form class="form-horizontal" id="searchForm" role="form" method="post" action="<?php echo base_url(); ?>welcome/searchFile">

                <div id="custom-search-input">
                    <div class="input-group col-md-12">
                        <input type="text" form="searchForm" class="form-control input-lg" size="40" autofocus name="searchText" placeholder="search ..." required />
                        <span class="input-group-btn">
                            <button class="btn btn-primary btn-lg" type="submit">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </span>
                    </div>
                </div>

             </form>
          </div>
      </div>

  <!-- the blues part of the screen -->

      <div class="row" id="fourthRow"> 
            <div class="col1 col-lg-4 col-sm-12 col-xs-12">
              <img src="<?php echo base_url(); ?>img/snip (3).png">
              <h5>Different Years</h5>
              <p>This system contains datasets of different years</p>
            </div>
            <div class="col2 col-lg-4 col-sm-12 col-xs-12">
              <img src="<?php echo base_url(); ?>img/snip (2).png">              
              <h6>Dataset stats</h6>
                  <table class="w3-table w3-bordered w3-tiny">
                    <tr>
                      <td>Public dataset files</td>
                      <td><?php echo $stat['public']; ?></td>
                    </tr>
                    <tr>
                      <td>Restricted dataset files</td>
                      <td><?php echo $stat['restricted']; ?></td>
                    </tr>
                  </table>
            </div>
            <div class="col3 col-lg-4 col-sm-12 col-xs-12">
              <img src="<?php echo base_url(); ?>img/snip (4).png">              
              <h5>Different Departments</h5>
              <p>This system contains datasets of different departments</p>            
            </div>
      </div>


<!-- Recent dataset uploads content starts here ... -->


        <div id="resultDiv" class="col-lg-10 col-lg-offset-1 col-xs-12 col-sm-12"> 
            <?php if(count($recentUploads) == 0) {
              echo("<h2>Your search Query couldn't return any result.</h2>");
          } else { ?>

                    <h2>Recent dataset uploads</h2><hr>
                    <table class="w3-table w3-bordered" id="resultTable">
                        <tbody>
                <?php foreach ($recentUploads as $row) {
                  ?>
                  <tr>
                    <td>
                      <b><span data-toggle="tooltip" title="click for details"><a id="resultTitle" href="#" data-toggle="modal" data-target="#details<?php echo $row['file_id']; ?>"><?php echo $row['file_title']?></a></span></b><br>
                      <p class="text-muted"><?php echo $row['upload_time']; ?></p>
                      <span>Author: </span><?php echo $row['file_author']?>
                    </td>
                    <td>

                      <?php if($row['access_level'] == 0) { ?>
                        <a target="_blank" style="background-color: teal;" href="<?php echo base_url(); ?>uploads/<?php echo $row['file_name']; ?>" class="btn btn-primary btn-lg"><i class="fa fa-download"></i></a>
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
                                      <div class="modal-header modal-header-info">
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



            <?php } ?>
                  </tbody>
                </table>                
            <?php } ?>

        </div>

     </div>

   <footer class="footer">
      <p class="text-muted">Copyright &copy 2017, <a target="_blank" href="http://www.amu.edu.et">Arbaminch University</a></p>
   </footer>

   <script src="<?php echo base_url(); ?>js/jquery.js"></script>
   <script src="<?php echo base_url(); ?>js/bootstrap.js"></script>

   <script type="text/javascript">
   
     // Wait for window load
     $(window).load(function() {
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");;
     });
   
   </script>

</body>
</html>

