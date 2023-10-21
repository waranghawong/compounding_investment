<?php

include_once '../classes/db.classes.php';
include_once '../classes/wallet.classes.php';
include_once '../classes/walletcntrl.classes.php';

$wallet = new walletCntrl();

if(isset($_POST['submit_withdrawal'])){
    $user_id = $_POST['user_id'];
    $amount = $_POST['withdrawal_amount'];
    $cashin_method = $_POST['cashin_method'];
    $purchase_method = $_POST['purchase_option'];

    $wallet->withdrawWallet($user_id, $amount, $cashin_method, $purchase_method);

}

if(isset($_GET['undo_withdrawal_id'])){
    $wallet->getUndoWithdrawal($_GET['undo_withdrawal_id'], $_GET['amount'],$_GET['id']);
}
?>