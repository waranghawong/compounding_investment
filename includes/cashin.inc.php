<?php

include_once '../classes/db.classes.php';
include_once '../classes/cashin.classes.php';
include_once '../classes/cashincntrl.classes.php';
include "../classes/transactioncntr.classes.php";
$cash_ins = new cashInCntrl();

if(isset($_POST['cashin_submit'])){

    $cashin_amount = $_POST['cashin_amount'];
    $cashin_method = $_POST['cashin_method'];
    $cashin_reference = $_POST['cashin_reference'];
    $cashin_date = $_POST['cashin_date'];
    $cashin_time = $_POST['cashin_time'];
    $cashin_image = $_FILES['cashin_image'];
    $user_id = $_POST['user_id'];


    $cash_ins->insertCashin($cashin_amount, $cashin_method, $cashin_reference, $cashin_date, $cashin_time, $cashin_image, $user_id);

}

if(isset($_GET['approve_payment'])){

    $cash_ins->approvePayment($_GET['approve_payment']);

}
if(isset($_GET['reject_payment'])){

    $cash_ins->rejectPayment($_GET['reject_payment']);
}




?>