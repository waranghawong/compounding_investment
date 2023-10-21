<?php


class billingCntrl extends billingClass{


    public function insertAccountMethod($accountMethod){
        
        return $this->accountMethod($accountMethod);
    }
    
    public function getAllAccountMethod(){
        return $this->getAccountMethod();
    }

    public function insertBilling($account_name,  $account_number,  $account_method, $account_address){
        return $this->insertBillingMethod($account_name,  $account_number,  $account_method, $account_address);
    }

    public function showBillingMethods(){
        return $this->showAllBillingMethods();
    }

    public function deleteBilling($id){
        $this->delBilling($id);
        echo json_encode(["statusCode"=>200]);
    }
}
?>

