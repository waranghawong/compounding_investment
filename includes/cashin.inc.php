<?php

include_once '../classes/db.classes.php';
include_once '../classes/cashin.classes.php';
include_once '../classes/cashincntrl.classes.php';
include_once 'transactions.inc.php';
$cash_ins = new cashInCntrl();

if(isset($_POST['cashin_submit'])){

    $cashin_amount = $_POST['cashin_amount'];
    $cashin_method = $_POST['cashin_method'];
    $cashin_reference = $_POST['cashin_reference'];
    $cashin_date = $_POST['cashin_date'];
    $cashin_time = $_POST['cashin_time'];
    $cashin_image = $_FILES['cashin_image'];
    $user_id = $_POST['user_id'];
    $account_name = $_POST['account_name'];
    $account_number = $_POST['account_number'];
    $account_method = $_POST['cash_in_method'];


    $cash_ins->insertCashin($cashin_amount, $cashin_method, $cashin_reference, $cashin_date, $cashin_time, $cashin_image, $user_id, $account_name, $account_number,$account_method);

}

if(isset($_GET['approve_payment'])){

    $cash_ins->approvePayment($_GET['approve_payment'], $_GET['account_name'],$_GET['account_number'],$_GET['account_method'],$_GET['user_id'],$_GET['transaction_number']);
 
}
if(isset($_GET['reject_payment'])){

    $cash_ins->rejectPayment($_GET['reject_payment'], $_GET['account_name'],$_GET['account_number'],$_GET['account_method'],$_GET['user_id'],$_GET['transaction_number']);
}




?>