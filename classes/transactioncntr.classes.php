<?php 
include_once 'transaction.classes.php';


class transactionsctnr extends transaction {
    public $id;
    public $name;
    public $method;
    public $datetime;
    public $transaction;
    public $reference;

    public function __construct($id, $name, $method, $datetime, $transaction, $reference){
        
        $this->id = $id;
        $this->name = $name;
        $this->method = $method;
        $this->datetime = $datetime;
        $this->transaction = $transaction;
        $this->reference = $reference;

    }

    public function insertTransaction($id, $name, $method, $datetime, $transaction, $reference){
        return $this->setTransaction($id, $name, $method, $datetime, $transaction, $reference);
    }

}

?>