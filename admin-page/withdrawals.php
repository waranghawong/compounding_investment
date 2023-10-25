<?php
  include "../classes/userContr.classes.php";
  include "../includes/wallet.inc.php";
  $userdata = new UserCntr();
  $user = $userdata->get_userdata();

  $withdrawals = new walletCntrl();
  $data = $withdrawals->getWithdrawables();


if(isset($user)){
      
  $name = ucfirst($user['first_name']).' ' .ucfirst($user['last_name']);
  $email = $user['email'];
  $role = $user['role'];
  if(isset($role) == '1'){


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

    <title>Transactions</title>

    <!-- Bootstrap -->
    <link href="cdn.datatables.net/1.10.20/js/jquery.dataTables.min.css">
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <style>
      .buttons-print{
        background-color: #26B99A;
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
                <h2><?= $name; ?> </h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                   <?php include "../includes/sidemenu.php"; ?>
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
                    <img src="../images/img.jpg" alt=""><?= $name; ?>
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item"  href="javascript:;"><?=  $email; ?></a>
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
                        <span class="image"><img src="../images/img.jpg" alt="Profile Image" /></span>
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
        

        <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                   <h5>List of approval users</h5>
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                  <div class="table-responsive">
                  <table id="example-table" class="table table-striped table-bordered dt-responsive nowrap payment_table" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Transaction ID</th>
                          <th>Name</th>
                          <th>Contact Number</th>
                          <th>Account Method</th>
                          <th>Withdrawal Amount</th>
                          <th>Date of Payout</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        

                                         <?php
                                          if($data == false){
                                              
                                          }
                                          else{
                                          foreach($data as $sd){ ?>
                                              <tr id="data_<?= $sd['id'];?>">
                                                <td> <?= $sd['transaction_id']?></td>
                                                <td> <?= ucwords(strtolower($sd['account_name']), '\',. ')?></td>
                                                <td> <?= $sd['account_number']?></td>
                                                <td> <?= $sd['account_method']; ?></td>
                                                <td> <?= $sd['amount'];  ?></td>
                                                <td> <?= $sd['updated_at'];  ?></td>
                                                <td> <span class="status_id_<?=  $sd['id']; ?>"> <?= $sd['status'] == "pending" ? '<span class="badge badge-warning"><h6>'.ucfirst($sd['status']).'<h6></span>' : ($sd['status'] == "approved" ? '<span class="badge badge-success"><h6>'.ucfirst($sd['status']).'<h6></span>' : '<span class="badge badge-danger"><h6>'.ucfirst($sd['status']).'<h6></span>' ) ; ?> </span></td>
                                                <td><button type="button" class="btn btn-sm btn-success"  onclick="approveWithdrawal(<?= $sd['id'] ?>, '<?= $sd['transaction_id']?>', '<?= ucwords(strtolower($sd['account_name']), '\',. ')?>','<?= $sd['account_number']?>', '<?= $sd['account_method']; ?>', '<?= $sd['amount'];  ?>', '<?= $sd['user_id']; ?>')">Approve</button><button type="button" class="btn btn-sm btn-danger"  onclick="rejectWithdrawal(<?= $sd['id'] ?>, '<?= $sd['transaction_id']?>', '<?= ucwords(strtolower($sd['account_name']), '\',. ')?>','<?= $sd['account_number']?>', '<?= $sd['account_method']; ?>', '<?= $sd['amount'];  ?>', '<?= $sd['user_id']; ?>')">Reject</button></td>
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
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
        <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>


    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

    <script>
         function approveWithdrawal(id, trans_id, accnt_name, accnt_number, accnt_method, amount, user_id){
        var confirmation = confirm("confirm approval");

        if(confirmation){
            $.ajax({
                method: "get",
                url: "../includes/wallet.inc.php?approve_withdrawal=" + id+'&&transaction_id='+trans_id+'&&accnt_name='+accnt_name+'&&acccnt_number='+accnt_number+'&&accnt_method='+accnt_method+'&&amount='+amount+'&&user_id='+user_id,
                success: function (response){
                  var data = $.parseJSON(response)
                  $('.status_id_'+id+'').html('<span class="badge badge-success"><h6>'+data.status+'<h6></span>')

                  
                }
            })
        }

      }


      function rejectWithdrawal(id, trans_id, accnt_name, accnt_number, accnt_method, amount, user_id){

        var confirmation = confirm("are you sure you want to reject payment?");

        if(confirmation){
            $.ajax({
                method: "get",
                url: "../includes/wallet.inc.php?reject_withdrawal=" + id+'&&transaction_id='+trans_id+'&&accnt_name='+accnt_name+'&&acccnt_number='+accnt_number+'&&accnt_method='+accnt_method+'&&amount='+amount+'&&user_id='+user_id,
                success: function (response){
                  var data = $.parseJSON(response)
                  $('.status_id_'+id+'').html('<span class="badge badge-danger"><h6>'+data.status+'<h6></span>')
                }
            })
        }

      }
      $(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#example-table thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#example-table thead');
 
    var table = $('#example-table').DataTable({
      
        orderCellsTop: true,
        fixedHeader: true,
        
        initComplete: function () {
            var api = this.api();
 
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
 
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('change', function (e) {
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
                        })
                        .on('keyup', function (e) {
                            e.stopPropagation();
 
                            $(this).trigger('change');
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    });
});
    </script>
	
  </body>
</html>
<?php
 }
 else{
    header('location: ../login.php');
 }
}
else{
  header('location: ../login.php');
}

?>