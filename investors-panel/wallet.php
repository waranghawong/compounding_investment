<?php
  include "../classes/userContr.classes.php";
  include "../includes/wallet.inc.php";

  $userdata = new UserCntr();
  $user = $userdata->get_userdata();

  $withdrawal_method = new walletCntrl();


if(isset($user)){
  $id = $user['id'];
  $name = ucfirst($user['first_name']).' ' .ucfirst($user['last_name']);
  $email = $user['email'];
  $role = $user['role'];
  $isApproved = $user['isApproved'];

  $getWithdrawalMethod =   $withdrawal_method->withdrawalMethod($id);
  $select_purchase = $withdrawal_method->selectPurchase($id);
  $balance =   $withdrawal_method->showAvailableBalance($id);
  $wallet = $withdrawal_method->getWallet($id);

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

    <title>Wallet</title>

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
              <div class="alert alert-dark justify-content-center" role="alert"><h4>Wallet Information<h4></div>
                <div class="col-md-12">

                <div class="x_panel">
                    <div class="x_content">
                      <br />
                          <h4>Withdrawable Balance:<small><b> Php <?=  $balance['withdrawable']; ?></b></small></h4>
                    </div>
                  </div>

                  <div class="alert alert-primary">
                          <ul class="fa-ul">
                            <li>
                              <i class="fa fa-info-circle fa-lg fa-li"></i> If there's no available withdrawal method. Please update or create your  <a href="billing.php" class="alert-link">Billing Information</a> for you to submit your Withdrawal Reques.
                            
                            </li>
                          </ul>
                  </div>

                  <div class="x_panel">
                    <div class="x_content">
                      <br />

                      
                      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="../includes/wallet.inc.php" enctype="multipart/form-data">

                        <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="amount"> <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 ">
                            <input type="number" name="withdrawal_amount" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Amount" required>
                            <span class="form-control-feedback left" aria-hidden="true">₱</span>
                          </div>
                        </div>


                        <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="method"> <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 ">
                            <select class="form-control  has-feedback-left" name="cashin_method" required>
                              <option value=''>Select Account Method</option>
                              <?php
                                foreach($getWithdrawalMethod as $sd){
                                  echo '<option value='.$sd['id'].'>'.$sd["account_method"].' ('.$sd['account_name'].' - '.$sd['account_number'].')</option>';
                                }
                              
                              ?>

                            </select>
                            <span class=" fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                          </div>
                        </div>

                        <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="method"> <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 ">
                            <select class="form-control  has-feedback-left" name="purchase_option" required>
                              <option value=''>Select Purchase Withdrawal</option>
                              <?php
                                foreach($select_purchase as $sd){
                                 echo '<option value='.$sd['id'].'>'.$sd["transaction_number"].' (Php '.$sd['payout'].')</option>';
                           
                                }
                              
                              ?>

                            </select>
                            <span class="form-control-feedback left" aria-hidden="true">#</span>
                          </div>
                        </div>
                        <div class="item form-group">
                           <div class="col-md-9 col-sm-9  offset-md-3">
                            <button type="submit" name="submit_withdrawal" class="btn btn-primary">Submit</button>
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
                                      <th>Transaction ID</th>
                                      <th>Amount</th>
                                      <th>Account Name</th>
                                      <th>Mode of Payment</th>
                                      <th>Status</th>
                                      <th>Created At</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                    <?php
                                        if($wallet == false){
                                            
                                        }
                                        else{
                                        foreach($wallet as $sd){ ?>
                                            <tr id="data_<?= $sd['id'];?>">
                                              <td> <?= $sd['transaction_id']; ?></td>
                                              <td> <?= $sd['amount']; ?></td>
                                              <td> <?= $sd['account_name']; ?></td>
                                              <td> <?= $sd['account_method']; ?></td>
                                              <td> <span class="status_id_<?=  $sd['id']; ?>"> <?= $sd['status'] == "pending" ? '<span class="badge badge-warning">'.ucfirst($sd['status']).'</span>' : ($sd['status'] == "approved" ? '<span class="badge badge-success">'.ucfirst($sd['status']).'</span>' : '<span class="badge badge-danger">'.ucfirst($sd['status']).'</span>' ) ; ?> </span></td>
                                              <td> <?= $sd['created_at']; ?></td>
                                              <td><button type="button" class="btn btn-sm btn-danger" onclick="undoWithdrawal(<?= $sd['purchase_details_id'] ?>, <?= $sd['amount'] ?>, <?= $sd['id'] ?>,<?= $user['id']?>, '<?= $sd['account_method']; ?>',)" ><i class="fa fa-trash"></i></button></td>
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

    <div class="modal fade" id="show_not_enough_balance" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                <div class="alert alert-danger alert-dismissible " role="alert">
                    <strong>OOPS!</strong> You don't have enough balance to make a withdrawal
                  </div>
          </div>
          <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
          </div>
        </div>
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <script src="../vendors/dropzone/dist/min/dropzone.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
    <?php 
     if(isset($_GET['warning'])){
      echo '<script> $("#show_not_enough_balance").modal(); </script>';
     }
    ?>                                     
    <script>

      function deleteUserBilling(id){
        var confirmation = confirm("are you sure you want to delete this?");

          if(confirmation){
              $.ajax({
                  method: "get",
                  url: "../includes/user_billing.inc.php?delete_billing=" + id,
                  success: function (response){
                  $("#data_"+id).remove();
                  alert('successfully deleted!');
                  }
              })
          }
      }

      function undoWithdrawal(purchase_id, amount, id, user_id, account_method){
        var confirmation = confirm("are you sure you want to undo withdrawal?");

          if(confirmation){
              $.ajax({
                  method: "get",
                  url: "../includes/wallet.inc.php?undo_withdrawal_id=" + purchase_id +'&&amount='+amount+'&&id='+id+'&&user_id=' +user_id +'&&account_method=' +account_method ,
                  success: function (response){
                  $("#data_"+id).remove();
                  alert('successfully deleted!');
                  // location.reload();
                  }
              })
          }
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