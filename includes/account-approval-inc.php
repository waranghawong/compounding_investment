<?php

include_once '../classes/db.classes.php';
include_once '../classes/account-approval.classes.php';
include_once '../classes/account-approvalcntrl.classes.php';

$accounts = new accountApprovalCntrl();



if(isset($_GET['delete_user'])){
    $accounts->deleteUser($_GET['delete_user']);
}

if(isset($_GET['approve'])){

    $accounts->approveUser($_GET['approve']);
}
?>