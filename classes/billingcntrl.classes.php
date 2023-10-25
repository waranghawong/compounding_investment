<?php


class billingCntrl extends billingClass{


    public function insertAccountMethod($accountMethod, $user_id){
        
        return $this->accountMethod($accountMethod, $user_id);
    }
    
    public function getAllAccountMethod(){
        return $this->getAccountMethod();
    }

    public function insertBilling($account_name,  $account_number,  $account_method, $account_address, $user_id){
        return $this->insertBillingMethod($account_name,  $account_number,  $this->getAccountMethodName($account_method)['name'], $account_address, $user_id);
    }

    public function showBillingMethods(){
        return $this->showAllBillingMethods();
    }

    public function deleteBilling($id, $account_name, $account_number, $method){
        $this->delBilling($id, $account_name, $account_number,$method);
        echo json_encode(["statusCode"=>200]);
    }

    public function getAccountMethodName($account_method){
        return $this->AccountMethodName($account_method);
    }
}
?>

