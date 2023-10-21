<?php

if(isset($_GET['paymentid'])){
    include_once '../classes/db.classes.php';
    include_once '../classes/cashin.classes.php';
    include_once '../classes/cashincntrl.classes.php';

    $paymentDetails = new cashInCntrl();
    
    $paymentDetails->getPaymentDetailsById($_GET['paymentid']);

}


?>