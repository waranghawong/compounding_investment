<?php
include_once '../classes/db.classes.php';
include_once '../classes/user_billing.classes.php';
include_once '../classes/user_billingcntrl.classes.php';
include_once '../includes/transactions.inc.php';

$userBilling = new userBillingCntrl();
if(isset($_POST['billing_submit'])){
   $account_name =  $_POST['account_name'];
   $account_number =  $_POST['account_number'];
   $cashin_method = $_POST['cashin_method'];
   $account_address = $_POST['account_address'];
   $user_id = $_POST['user_id'];


    $userBilling->insertUserBilling($account_name, $account_number,$cashin_method,$account_address,  $user_id);
}

if(isset($_GET['delete_billing'])){
    $userBilling->deleteUserBilling($_GET['delete_billing'],$_GET['user_id'],$_GET['account_method'],$_GET['account_name'],$_GET['account_number']);
}
?>