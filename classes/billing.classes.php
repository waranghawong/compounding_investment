<?php


class billingClass extends DB{
    

    protected function accountMethod($methodName){
        
        $datetimetoday = date("Y-m-d H:i:s");
        $con = $this->dbOpen();
        $stmt = $con->prepare("INSERT INTO account_method (name,created_at) VALUES (?,?) ");
        if(!$stmt->execute(array($methodName, $datetimetoday))){
            $stmt = null;
            header("location: ../admin-page/billing_method.php?error=stmtfailed");
            exit();
        }
        header("location: ../admin-page/billing_method.php?success=1");
    }

    protected function getAccountMethod(){

        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM account_method");
        $stmt->execute();

        $data = $stmt->fetchall();
        return $data;
    }

    protected function insertBillingMethod($account_name,  $account_number,  $account_method, $account_address){
        $datetimetoday = date("Y-m-d H:i:s");
        $con = $this->dbOpen();
        $stmt = $con->prepare("INSERT INTO admin_billing (account_name,account_number, account_method, account_address,created_at) VALUES (?,?,?,?,?) ");
        if(!$stmt->execute(array($account_name,  $account_number,  $account_method, $account_address,$datetimetoday))){
            $stmt = null;
            header("location: ../admin-page/billing_method.php?error=stmtfailed");
            exit();
        }
        header("location: ../admin-page/billing_method.php?success=1");
    }

    protected function showAllBillingMethods(){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT admin_billing.id,admin_billing.account_number, admin_billing.account_name, admin_billing.account_address, admin_billing.created_at, account_method.name FROM admin_billing INNER JOIN account_method ON account_method.id = admin_billing.account_method");
        $stmt->execute();

        $data = $stmt->fetchall();
        return $data;
    }

    protected function delBilling($id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("DELETE FROM admin_billing WHERE id = ?");
        $stmt->execute([$id]);
    }
}
?>