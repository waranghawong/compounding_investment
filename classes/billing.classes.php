<?php


class billingClass extends DB{
    

    protected function accountMethod($methodName, $user_id){
        
        $datetimetoday = date("Y-m-d H:i:s");
        $con = $this->dbOpen();
        $stmt = $con->prepare("INSERT INTO account_method (name,created_at) VALUES (?,?) ");
        if(!$stmt->execute(array($methodName, $datetimetoday))){
            $stmt = null;
            header("location: ../admin-page/billing_method.php?error=stmtfailed");
            exit();
        }
        $transaction = new transactionsctnr($user_id, null,$methodName, $datetimetoday, 'added account method '.$methodName.'', $cashin_reference);
        header("location: ../admin-page/billing_method.php?success=1");
    }

    protected function getAccountMethod(){

        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM account_method");
        $stmt->execute();

        $data = $stmt->fetchall();
        return $data;
    }

    protected function insertBillingMethod($account_name,  $account_number,  $account_method, $account_address, $user_id){
        $datetimetoday = date("Y-m-d H:i:s");
        $con = $this->dbOpen();
        $stmt = $con->prepare("INSERT INTO admin_billing (account_name,account_number, account_method, account_address,created_at) VALUES (?,?,?,?,?) ");
        if(!$stmt->execute(array($account_name,  $account_number,  $account_method, $account_address,$datetimetoday))){
            $stmt = null;
            header("location: ../admin-page/billing_method.php?error=stmtfailed");
            exit();
        }
        $transaction = new transactionsctnr($user_id, null ,$account_method, $datetimetoday, 'added account method with account name: "'.$account_name.'" and account number with "'.$account_number.'" ', $cashin_reference);
        header("location: ../admin-page/billing_method.php?success=1");
    }

    protected function showAllBillingMethods(){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM admin_billing");
        $stmt->execute();

        $data = $stmt->fetchall();
        return $data;
    }

    protected function delBilling($id, $account_name, $account_number,$method){
        $datetimetoday = date("Y-m-d H:i:s");
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("DELETE FROM admin_billing WHERE id = ?");
        $stmt->execute([$id]);

        $transaction = new transactionsctnr(null, null ,$method, $datetimetoday, 'successfully deleted payment method with account name: '.$account_name.' and account number: '.$account_number.'', null);
    }

    protected function AccountMethodName($account_method){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT name FROM account_method WHERE id = ?");
        $stmt->execute([$account_method]);

        $data = $stmt->fetch();
        return $data;
    }
}
?>