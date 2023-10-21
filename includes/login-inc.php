<?php 
include "../classes/session.class.php";
include_once '../classes/db.classes.php';
include_once '../classes/login.classes.php';
include_once '../classes/logincntrl.classes.php';
include_once '../classes/cashin.classes.php';
include_once '../classes/cashincntrl.classes.php';

if(isset($_POST["btn_submit"])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $login = new LoginContr($email, $password);
    $login->loginUser();
}
if(isset($_POST["btn_submit_register"])){
    $first_name = $_POST["f_name"];
    $last_name = $_POST["l_name"];
    $contact = $_POST["contact"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $password = $_POST["password"];


    $register = new registerUserCntrlr($first_name, $last_name, $address, $contact, $email, $password);

    $register->regUser();
}



?>