<?php

class userBillingCntrl extends userBilling{

    public function insertUserBilling($account_name,$account_number, $cashin_method,$account_address,  $user_id){

        return $this->setUserBilling($account_name, $account_number, $cashin_method,$account_address,  $user_id);

    }

    public function UserBilling($id){
        return $this->getUserBilling($id);
    }

    public function deleteUserBilling($id, $user_id, $account_method, $account_name, $account_number){
        $this->deleteBilling($id, $user_id, $account_method, $account_name, $account_number);
        echo json_encode(["statusCode"=>200]);
    }

}


?>