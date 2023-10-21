<?php
  include "../classes/userContr.classes.php";
  include "../includes/cashin.inc.php";

  $userdata = new UserCntr();
  $user = $userdata->get_userdata();

  $billing  = new cashInCntrl();
  $data = $billing->getAdminBilling();

if(isset($user)){
  $id = $user['id'];
  $name = ucfirst($user['first_name']).' ' .ucfirst($user['last_name']);
  $email = $user['email'];
  $role = $user['role'];
  $isApproved = $user['isApproved'];
  $purchase_details = $billing->getPaymentDetails($id);
  if(isset($role) == '1' && $isApproved == "1"){


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="../images/favicon.ico" type="image/ico" />

    <title>Cash In</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <link href="../vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">


    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">

    <style>
      #upload {
          opacity: 0;
      }

      #upload-label {
          position: absolute;
          top: 50%;
          left: 1rem;
          transform: translateY(-50%);
      }

      .image-area {
          border: 2px dashed rgba(255, 255, 255, 0.7);
          padding: 1rem;
          position: relative;
      }

      .image-area::before {
          content: 'Uploaded image result';
          color: #fff;
          font-weight: bold;
          text-transform: uppercase;
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          font-size: 0.8rem;
          z-index: 1;
      }
      .image-area img {
          z-index: 2;
          position: relative;
      }
    </style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa"></i> <span>&nbsp</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="../images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <?php include "../includes/user_side_menu.php"; ?>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/img.jpg" alt="">John Doe
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"  href="javascript:;"> Profile</a>
                    <a class="dropdown-item"  href="../includes/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                  </div>
                </li>

                <li role="presentation" class="nav-item dropdown open">
                  <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bell"></i>
                  </a><span class="badge bg-green">6</span>
                  <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <div class="text-center">
                        <a class="dropdown-item">
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">


             <div class="row">
              <div class="col-md-12">
              <div class="alert alert-dark justify-content-center" role="alert"><h4>Mode of Payment</h4></div>
                <div class="x_panel">
                  <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   
                    <div class="row">
                        <?php include_once("cash-in-thumbnail.php"); ?>

                    </div>
                  </div>
                </div>

                
                <div class="col-md-12">
                  <div class="x_panel">
                    <div class="x_content">
                      <br />
                      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="../includes/cashin.inc.php" enctype="multipart/form-data">

                        <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="amount"> <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 ">
                            <input type="number" name="cashin_amount" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Amount" required>
                            <span class="form-control-feedback left" aria-hidden="true">₱</span>
                          </div>
                        </div>

                        <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="method"> <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 ">
                            <select class="form-control  has-feedback-left" name="cashin_method" required>
                              <option value=''>Select Payment Method</option>
                                <?php
                                  foreach($data as $ds){
                                    echo '<option value="'.$ds['name'].'">'.$ds['name'].'</option>';
                                  }
                                
                                ?>
                            </select>
                            <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                          </div>
                        </div>

                        <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="reference"> <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 ">
                            <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Reference Number" name="cashin_reference" required>
                            <span class="fa fa-hashtag form-control-feedback left" aria-hidden="true"></span>
                          </div>
                        </div>

                        <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="date"> <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 ">
                            <input type="date" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Date" name="cashin_date" required>
                            <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                          </div>
                        </div>

                        <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="amount"> <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 ">
                            <input type="time" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Time" name="cashin_time" required>
                            <span class="fa fa-clock-o form-control-feedback left" aria-hidden="true"></span>
                          </div>
                        </div>

                        <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="amount"> <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 ">
                            <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                                <input id="upload" type="file" name="cashin_image" onchange="readURL(this);" class="form-control border-0" required>
                                <label id="upload-label" for="upload" class="font-weight-light text-muted">Choose file</label>
                                <div class="input-group-append">
                                    <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="image-area mt-4"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>


                        <div class="item form-group">
                           <div class="col-md-9 col-sm-9  offset-md-3">
                            <button type="submit" name="cashin_submit" class="btn btn-primary">Submit</button>
                          </div>
                        </div>

                        <div class="form-group row">
                                  <input type="hidden" value="<?= $id; ?>" name="user_id"> 
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                <div class="col-md-12 col-sm-12 ">
                        <div class="x_panel">
                              <div class="x_title">
                                <h2>Cash-In History</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                  </li>
                                </ul>
                                <div class="clearfix"></div>
                              </div>
                              <div class="x_content">
                                  <div class="row">
                                      <div class="col-sm-12">
                                        <div class="card-box table-responsive">
                      
                                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                  <thead>
                                    <tr>
                                      <th>Transaction #</th>
                                      <th>Initial Investment</th>
                                      <th>Compounded</th>
                                      <th>Total Profit</th>
                                      <th>Date Created</th>
                                      <th>Date Withdrawable</th>
                                      <th>Lock in Period</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                    <?php
                                        if($purchase_details == false){
                                            
                                        }
                                        else{
                                        foreach($purchase_details as $sd){ ?>
                                            <tr id="data_<?= $sd['id'];?>">
                                              <td> <?= $sd['transaction_number']; ?></td>
                                              <td> <?= $sd['initial_investment']; ?></td>
                                              <td> <?= $sd['compounded']; ?></td>
                                              <td> <?= $sd['payout']; ?></td>
                                              <td> <?= $sd['created_at']; ?></td>
                                              <td> <?= $sd['date_withdrawable']; ?></td>
                                              <td> <?= $sd['lock_in']; ?></td>
                                              <td>  <?= $sd['status'] == "pending" ? '<span class="badge badge-warning"><h6>'.ucfirst($sd['status']).'<h6></span>' : ($sd['status'] == "approved" ? '<span class="badge badge-success"><h6>'.ucfirst($sd['status']).'<h6></span>' : '<span class="badge badge-danger"><h6>'.ucfirst($sd['status']).'<h6></span>' ) ; ?></td>
                                              <td><button type="button" class="btn btn-sm btn-success" onclick="openModal(<?= $sd['payment_id'] ?>)" ><i class="fa fa-eye"></i>View Details</button></td>
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

        <div class="modal fade viewdetails" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">View Details</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="x_panel">
                            <div class="x_title">
                              <h2>Purchase Details</h2>
                              <ul class="nav navbar-right panel_toolbox">
                                </li>
                              </ul>
                              <div class="clearfix"></div>
                            </div>
                               <div class="x_content">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                      <div class="row">
                                                Transaction Number:
                                          <div class="col">
                                                <div id="transaction_number"></div>  
                                          </div>
                                      </div>

                                      <div class="row mt-2">
                                                Created Date and Time:
                                          <div class="col">
                                                <div id="purchase_created_at"></div>  
                                          </div>
                                      </div>

                                      <div class="row mt-2">
                                                Expecting Amount:
                                          <div class="col">
                                                <div id="expecting_amount"></div>  
                                          </div>
                                      </div>
                                    </div>

                                    <div class="col-md-6">
                               

                                      <div class="row mt-2">
                                                Total Expecting Amount:
                                          <div class="col">
                                                <div id="purchase_compounded"></div>  
                                          </div>
                                      </div>

                                      <div class="row mt-2">
                                                Status:
                                          <div class="col">
                                                <div id="purchase_status"></div>  
                                          </div>
                                      </div>

                                    </div>
                                 </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="x_panel">
                            <div class="x_title">
                              <h2>Payment Details</h2>
                              <ul class="nav navbar-right panel_toolbox">
                                </li>
                              </ul>
                              <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                              <div class="col-md-12">
                                  <div class="col-md-6">
                                    <div class="row">
                                              Reference Number:
                                        <div class="col">
                                              <div id="reference_number"></div>  
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                              Amount:
                                        <div class="col">
                                              <div id="payment_amount"></div>  
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                              Method:
                                        <div class="col">
                                              <div id="payment_method"></div>  
                                        </div>
                                    </div>

                                    
                                  </div>

                                    <div class="col-md-6">
                                    <div class="row">
                                              Receipt Date:
                                        <div class="col">
                                              <div id="date_purchased"></div>  
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                              Uploaded Image:
                                        <div class="col">
                                              <div id="payment_image"></div>  
                                        </div>
                                    </div>


                                  </div>
                               </div>
                            </div>
                          </div>
                        </div>
                      </div>               
                    </div>
                 </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>

            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
          <p>©2023 All Rights Reserved</p>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
    <script>
      function openModal(payment_id){
        var img = document.createElement("img");
        img.setAttribute('width', 200);
        img.setAttribute('height', 350);
        $.ajax({
                method: "get",
                dataType: "json",
                url: "../includes/purchase-details.inc.php?paymentid=" + payment_id,
                success: function (response){
                $.each(response, function(index, data) {
                       document.getElementById('transaction_number').innerText = data.transaction_number
                       document.getElementById('purchase_created_at').innerText = data.created_at
                       document.getElementById('expecting_amount').innerText = data.payout
                       document.getElementById('purchase_compounded').innerText = data.compounded
                       document.getElementById('reference_number').innerText = data.payment_reference
                       document.getElementById('payment_amount').innerText = data.payment_amount
                       document.getElementById('date_purchased').innerText = data.date_purchased
                       document.getElementById('payment_method').innerText = data.payment_method

                       
                           img.src = data.payment_image;

                        // var src = document.getElementById("payment_image");
                      
                        $('#payment_image').html(img);
                        if(data.status == 'pending'){
                          $('#purchase_status').html('<span class="badge badge-warning">'+data.status+'</span>');
                        }
                        else if(data.status == 'rejected'){
                          $('#purchase_status').html('<span class="badge badge-danger">'+data.status+'</span>');
                        }
                        else{
                          $('#purchase_status').html('<span class="badge badge-success">'+data.status+'</span>');
                        }
                       
                    
                  });
                  $('.viewdetails').modal(); 
                }
               
            })
     
      }

      function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                  $('#imageResult')
                      .attr('src', e.target.result);
              };
              reader.readAsDataURL(input.files[0]);
          }
      }

      $(function () {
          $('#upload').on('change', function () {
              readURL(input);
          });
      });

      var input = document.getElementById( 'upload' );
      var infoArea = document.getElementById( 'upload-label' );

      input.addEventListener( 'change', showFileName );
      function showFileName( event ) {
        var input = event.srcElement;
        var fileName = input.files[0].name;
        infoArea.textContent = 'File name: ' + fileName;
      }
    </script>
	
  </body>
</html>
<?php
 }
 else{
    header('location: ../login.php?isApproved=false');
 }
}
else{
  header('location: ../login.php');
}

?>