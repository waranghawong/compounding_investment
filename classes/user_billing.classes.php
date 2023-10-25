<?php


class userBilling extends DB{

    protected function setUserBilling($account_name, $account_number,$cashin_method,$account_address,  $user_id){

        $datetimetoday = date("Y-m-d H:i:s");
        $con = $this->dbOpen();
        $stmt = $con->prepare("INSERT INTO user_billing (user_id, account_name,account_number, account_method, account_address,created_at) VALUES (?,?,?,?,?,?) ");
        if(!$stmt->execute(array($user_id, $account_name, $account_number, $cashin_method,$account_address, $datetimetoday))){
            $stmt = null;
            header("location: ../investors-panel/billing.php?error=stmtfailed");
            exit();
        }
        $transaction = new transactionsctnr($user_id, null, $cashin_method, $datetimetoday,'Added account billing with account name: '.$account_name.' and account number: '.$account_number.'', null);
        header("location: ../investors-panel/billing.php?success=1");
    }

    protected function getUserBilling($id){

        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM user_billing WHERE user_id = ?");
        $stmt->execute([$id]);

        $data = $stmt->fetchall();
        return $data;

    }

    protected function deleteBilling($id, $user_id, $account_method, $account_name, $account_number){
        $datetimetoday = date("Y-m-d H:i:s");
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("DELETE FROM user_billing WHERE id = ?");
        $stmt->execute([$id]);
        $transaction = new transactionsctnr($user_id, null, $account_method, $datetimetoday, 'deleted billing with account name: '.$account_name.' and account number: '.$account_number.'', null);
    }

}






?>