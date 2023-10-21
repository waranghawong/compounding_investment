<?php 

include_once '../classes/db.classes.php';
include_once '../classes/billing.classes.php';
include_once '../classes/billingcntrl.classes.php';

$billing = new billingCntrl();

if(isset($_POST['btn_submit_account_method'])){
    $billing_method_name = $_POST['billing_method_name'];
    $billing->insertAccountMethod($billing_method_name);

}

if(isset($_POST['sbmt_billing'])){
    $account_name = $_POST["account_name"];
    $account_number = $_POST["account_number"];
    $account_method = $_POST["account_method"];
    $account_address = $_POST["account_address"];

    $billing->insertBilling($account_name,  $account_number,  $account_method, $account_address);

}

if(isset($_GET['delete_billing'])){
    $billing->deleteBilling($_GET['delete_billing']);
}

?>