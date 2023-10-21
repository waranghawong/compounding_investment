<?php 

class transaction extends DB{
    protected function setTransaction($id, $name, $method, $datetime, $transaction, $reference){

        $con = $this->dbOpen();
        $stmt = $con->prepare("INSERT INTO transaction_history (user_id,name, method, transaction, created_at) VALUES (?,?,?,?,?) ");
        if(!$stmt->execute(array($id, $name, $method, $datetime, $transaction, $reference))){
            $stmt = null;
            header("location: ../admin-page/billing_method.php?error=stmtfailed");
            exit();
        }
    }
}