<?php

class userBillingCntrl extends userBilling{

    public function insertUserBilling($account_name,$account_number, $cashin_method,$account_address,  $user_id){

        return $this->setUserBilling($account_name, $account_number, $cashin_method,$account_address,  $user_id);

    }

    public function UserBilling($id){
        return $this->getUserBilling($id);
    }

    public function deleteUserBilling($id){
        $this->deleteBilling($id);
        echo json_encode(["statusCode"=>200]);
    }

}


?>