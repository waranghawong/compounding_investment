<?php
class LoginContr extends Login{
    private $email;
    private $pwd;

    public function __construct($email, $pwd){
        $this->email = $email;
        $this->pwd = $pwd;
    }

    public function loginUser(){
        if($this->emptyInput() == false){
            header('location: ../index.php?error=emptyInput');
            exit();
        }

        $this->getUser($this->email, $this->pwd);
    }

    public function emptyInput(){
        $result;

        if(empty($this->email || empty($this->pwd))){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }
}

class registerUserCntrlr extends Login{
    private $first_name;
    private $last_namme;
    private $address;
    private $contact;
    private $email;
    private $password;

    public function __construct($first_name, $last_namme, $address , $contact, $email, $password){
        $this->first_name = $first_name;
        $this->last_namme = $last_namme;
        $this->address = $address;
        $this->contact = $contact;
        $this->email = $email;
        $this->password = $password;
    }

    public function regUser(){
        if($this->verifyEmail($this->email) == true){
            header('location: ../login.php?error=email-already-exist');
            exit();
        }
        else{
            $this->insertRegisteredUser($this->first_name, $this->last_namme, $this->address, $this->contact, $this->email, $this->password);
        }
       
    }

    public function verifyEmail($email){
        $result;

        if($this->checkEmailExist($email) == false){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
        
    }
}