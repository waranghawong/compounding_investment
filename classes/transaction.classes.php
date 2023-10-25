<?php 

class transaction extends DB{
    protected function setTransaction($id, $name, $method, $datetime, $transaction , $reference ){

        $con = $this->dbOpen();
        $stmt = $con->prepare("INSERT INTO transaction_history (user_id, name, method, transaction,reference,  created_at) VALUES (?,?,?,?,?,?) ");
        if(!$stmt->execute(array($id, $name, $method, $transaction, $reference, $datetime))){
            $stmt = null;
            header("location: ../admin-page/billing_method.php?error=stmtfailed");
            exit();
        }
    }

    protected function getAllTransaction(){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT method, transaction, created_at FROM transaction_history  ORDER BY created_at");
        $stmt->execute();

        $data = $stmt->fetchall();
        return $data;
        
    }

    protected function getTransactionById($id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT method, transaction, created_at FROM transaction_history WHERE user_id = ? ORDER BY created_at");
        $stmt->execute([$id]);

        $data = $stmt->fetchall();
        return $data;
    }
}