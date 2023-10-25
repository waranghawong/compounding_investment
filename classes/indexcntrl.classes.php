<?php

class indexCntrlr extends index{

    public function countActiveUsers(){
        return $this->countActiveUser();
    }

    public function cashInAvg(){
        return $this->cashInAverage();
    }

    public function totalWithdrawals(){
        return $this->avgWithdrawals();
    }
    public function totalRejectedWithdrawals(){
        return $this->avgRejectedWithdrawals();
    }

    public function countUserCashIn($id){
        return $this->cashInAverageByUser($id);
    }
}



?>