<?php

class wallet extends DB{

    protected function getWithdrawalMethod($id){

        
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM user_billing WHERE user_id = ?");
        $stmt->execute([$id]);

        $data = $stmt->fetchall();
        return $data;

    }

    protected function getUserBilling($cashin_method){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT id, user_id ,account_name, account_number, account_method,account_address FROM user_billing WHERE id = ?");
        $stmt->execute([$cashin_method]);

        $data = $stmt->fetchall();
        return $data;
    }

    protected function userBalance($id){

        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT sum(purchase_details.payout) as withdrawable, purchase_details.date_withdrawable FROM purchase_details INNER JOIN payment_details ON payment_details.id = purchase_details.payment_id WHERE payment_details.user_id = ? and status = 'approved' AND purchase_details.date_withdrawable >= CURDATE()");
        $stmt->execute([$id]);

        $data = $stmt->fetch();
        return $data;
    }

    protected function userWithdrawal($array, $amount, $payment_breakdown, $remaining_balance, $purchase_method, $user_id){
        $datetimetoday = date("Y-m-d H:m:s");
        $updated_payout = $remaining_balance['payout'] - $amount;
        $tran_id = 'JMW-'.str_pad($purchase_method,8,"0",STR_PAD_LEFT);
        $connection = $this->dbOpen();
        if($remaining_balance <= 0){
            echo 'zero balance';
        }
        else{
            $stmt = $connection->prepare("UPDATE purchase_details SET payout = ? WHERE id = ?");
            if(!$stmt->execute([$updated_payout ,$purchase_method])){
                $stmt1 = null;
                header("location: ../admin-page/cash-ins.php?error=stmtfailed");
                exit();
            }
            else{
                    
                foreach($array as $sd){

                    $stmt1 = $connection->prepare("INSERT INTO withdrawable (user_id, purchase_details_id,transaction_id, account_name, account_number, account_method, account_address, amount, created_at) VALUES (?,?,?,?,?,?,?,?,?)");
                    if(!$stmt1->execute([$sd['user_id'],$purchase_method ,$tran_id, $sd['account_name'], $sd['account_number'], $sd['account_method'], $sd['account_address'],$amount, $datetimetoday])){
                        $stmt1 = null;
                        header("location: ../investors-panel/wallet.php?error=stmtfailed");
                        exit();
                    }
                    else{
                        $transaction = new transactionsctnr($sd['user_id'], null, $sd['account_method'],$datetimetoday,'withdrawal with the amount of '.$amount.' and account name: '.$sd['account_name'].' account number: '.$sd['account_number'].' method using:  '.$sd['account_method'].'', null);
                        header("location: ../investors-panel/wallet.php");
                    }

                }
                // var_dump($array);
             
            }
   
         
        }
   
      
    }

    protected function getPaymentBreakdown($id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT purchase_details.payment_id FROM purchase_details INNER JOIN payment_details ON payment_details.id = purchase_details.payment_id WHERE payment_details.user_id = ? and status = 'approved';");
        $stmt->execute([$id]);

        $data = $stmt->fetchall();
        return $data;
    }

    protected function getUserPurchase($id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT purchase_details.id, purchase_details.transaction_number,purchase_details.payout FROM purchase_details INNER JOIN payment_details ON payment_details.id = purchase_details.payment_id WHERE payment_details.user_id = ? and status = 'approved' AND purchase_details.date_withdrawable >= CURDATE();");
        $stmt->execute([$id]);

        $data = $stmt->fetchall();
        return $data;
    }
    
    protected function payoutBalance($purchase_method){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT payout FROM purchase_details WHERE id = ?");
        $stmt->execute([$purchase_method]);

        $data = $stmt->fetch();
        return $data;
    }

    protected function getWalletHistory($id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT withdrawable.id, withdrawable.purchase_details_id,withdrawable.transaction_id,withdrawable.account_name, withdrawable.amount, withdrawable.recieve, withdrawable.account_method, withdrawable.status, withdrawable.created_at FROM withdrawable INNER JOIN purchase_details ON purchase_details.id = withdrawable.purchase_details_id INNER JOIN payment_details ON payment_details.id = purchase_details.payment_id WHERE payment_details.user_id = ?");
        $stmt->execute([$id]);

        $data = $stmt->fetchall();
        return $data;
    }

    protected function undoWithdrawal( $purchase_id, $amount, $id, $current_payout, $user_id, $account_method){
        $datetimetoday = date("Y-m-d H:m:s");
        $total_amount = $amount + $current_payout['payout'];
        $connection = $this->dbOpen();
        $stmt1 = $connection->prepare("UPDATE purchase_details SET payout = ? WHERE id = ?");
        if(!$stmt1->execute([$total_amount, $purchase_id])){
            $stmt1 = null;
            header("location: ../investors-panel/wallet.php?error=stmtfailed");
            exit();
        }
    
        $stmt2 = $connection->prepare("DELETE FROM withdrawable WHERE id = ?");
        $stmt2->execute([$id]);
        $transaction = new transactionsctnr($user_id, null, $account_method, $datetimetoday,'deleted withdrawal with amount: '.$amount.'', null);
       

      
    }

    protected function currentUserPayout($purchase_id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT payout FROM purchase_details WHERE id = ?");
        $stmt->execute([$purchase_id]);

        $data = $stmt->fetch();
        return $data;
    }

    protected function getWalletWithdrawal(){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM withdrawable");
        $stmt->execute();

        $data = $stmt->fetchall();
        return $data;
    }

    protected function approveUserWithdrawal($id, $trans_id, $accnt_name, $accnt_number, $accnt_method, $amount, $user_id){
        $datetimetoday = date("Y-m-d H:m:s");

        $connection = $this->dbOpen();
        $stmt = $connection->prepare("UPDATE withdrawable SET status = ? WHERE id = ?");
        if(!$stmt->execute(['approved',$id])){
            $stmt2 = null;
            header("location: ../admin-page/cash-ins.php?error=stmtfailed");
            exit();
        }
        else{
            echo json_encode(array("status"=>"Approved"));
            $transaction = new transactionsctnr($user_id, null, $accnt_method, $datetimetoday,'withdrawal have been approved with transaction # '.$trans_id.' with account number: '.$accnt_name.' and account number' . $accnt_number.' with total amount of '.$amount.'', null);
        }
    }

    protected function rejectUserWithdrawal($id, $trans_id, $accnt_name, $accnt_number, $accnt_method, $amount, $user_id){
        $datetimetoday = date("Y-m-d H:m:s");
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("UPDATE withdrawable SET status = ? WHERE id = ?");
        if(!$stmt->execute(['rejected', $id])){
            $stmt2 = null;
            header("location: ../admin-page/cash-ins.php?error=stmtfailed");
            exit();
        }
        else{
            echo json_encode(array("status"=>"Rejected"));
            $transaction = new transactionsctnr($user_id, null, $accnt_method, $datetimetoday,'withdrawal have been rejected with transaction # '.$trans_id.' with account number: '.$accnt_name.' and account number' . $accnt_number.' with total amount of '.$amount.'', null);
        }
    }

    protected function totalPendingWithdrawal($id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT sum(amount) as total_withdrawals FROM withdrawable WHERE user_id = ? and status = 'pending' and MONTH(created_at) = MONTH(now()) and YEAR(created_at) = YEAR(now())");
        $stmt->execute([$id]);

        $data = $stmt->fetch();
        return $data;
    }

    protected function totalApprovedWithdrawal($id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT sum(amount) as total_withdrawals FROM withdrawable WHERE user_id = ? and status = 'approved' and MONTH(created_at) = MONTH(now()) and YEAR(created_at) = YEAR(now())");
        $stmt->execute([$id]);

        $data = $stmt->fetch();
        return $data;
    }

}


?>