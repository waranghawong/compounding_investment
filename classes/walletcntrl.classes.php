<?php

class walletCntrl extends wallet{

    public function withdrawalMethod($id){

        return $this->getWithdrawalMethod($id);
        
    }

    public function selectPurchase($id){
        return $this->getUserPurchase($id);
    }

    public function showAvailableBalance($id){
        return $this->userBalance($id);

    }

    public function withdrawWallet($user_id, $amount, $cashin_method, $purchase_method){
        if( $this->getPayoutBalance($purchase_method)['payout'] > $amount){
           $remaining_total =  $this->getPayoutBalance($purchase_method);
            return $this->userWithdrawal($this->getUserWithdrawal($cashin_method), $amount, $this->getBreakdownAmount($user_id), $remaining_total, $purchase_method);
        }
        else{
            header('location: ../investors-panel/wallet.php?warning=not-enough-balance');
            exit();
        }
     

    }

    public function getUserWithdrawal($cashin_method){
        return $this->getUserBilling($cashin_method);
    }

    public function getBreakdownAmount($id){
        return $this->getPaymentBreakdown($id);
    }

    public function getPayoutBalance($purchase_method){
        return $this->payoutBalance($purchase_method);
    }

    public function getWallet($id){
        return $this->getWalletHistory($id);
    }

    public function getUndoWithdrawal($purchase_id, $amount,$id){
       return $this->undoWithdrawal($purchase_id, $amount, $id, $this->getCurrentUserPayout($purchase_id));
    }

    public function getCurrentUserPayout($purchase_id){
        return $this->currentUserPayout($purchase_id);
    }


}


?>