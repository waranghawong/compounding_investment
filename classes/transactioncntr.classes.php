<?php 

class transactionsctnr extends transaction {
    public $id;
    public $name;
    public $method;
    public $datetime;
    public $transaction;
    public $reference;

    public function __construct($id, $name = null, $method=null, $datetime, $transaction = null, $reference = null){
        
        $this->id = $id;
        $this->name = $name;
        $this->method = $method;
        $this->datetime = $datetime;
        $this->transaction = $transaction;
        $this->reference = $reference;
        
        $this->insertTransaction($id, $name, $method, $datetime, $transaction, $reference);
    }

    public function insertTransaction($id, $name, $method, $datetime, $transaction, $reference){
        return $this->setTransaction($id, $name, $method, $datetime, $transaction, $reference);
    }

    public function getTransaction(){
        return $this->getAllTransaction();
    }

}

class getTransaction extends transaction {
    public function getTransaction(){
        return $this->getAllTransaction();
    }
    public function getUserTransaction($id){
        return $this->getTransactionById($id);
    }
}

?>