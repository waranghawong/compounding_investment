<?php

class index extends DB{
    

    protected function countActiveUser(){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM users WHERE role = '0' and isApproved = '1'");
        $stmt->execute();
        $count = $stmt->rowCount();
     
        return $count;
    }

    protected function cashInAverage(){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT sum(initial_investment) as total_amount,initial_investment,created_at FROM purchase_details WHERE status = 'approved' and MONTH(created_at) = MONTH(now()) and YEAR(created_at) = YEAR(now());");
        $stmt->execute();
        $count = $stmt->fetch();
     
        return $count;
    }

    protected function avgWithdrawals(){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT sum(amount) as total_amount,created_at FROM withdrawable WHERE status = 'approved' and MONTH(created_at) = MONTH(now()) and YEAR(created_at) = YEAR(now())");
        $stmt->execute();
        $count = $stmt->fetch();
     
        return $count;
    }

    protected function avgRejectedWithdrawals(){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT sum(amount) as total_amount,created_at FROM withdrawable WHERE status = 'rejected' and MONTH(created_at) = MONTH(now()) and YEAR(created_at) = YEAR(now())");
        $stmt->execute();
        $count = $stmt->fetch();
     
        return $count;
    }

    protected function cashInAverageByUser($id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT users.id as user_id,sum(purchase_details.compounded) as compounded, sum(purchase_details.payout) as payout, sum(purchase_details.initial_investment) as initial_investment, purchase_details.status, purchase_details.created_at FROM purchase_details INNER JOIN payment_details ON purchase_details.payment_id = payment_details.id LEFT JOIN users ON users.id = payment_details.user_id INNER JOIN admin_billing ON admin_billing.id = payment_details.payment_method WHERE purchase_details.status = 'approved' and MONTH(purchase_details.created_at) = MONTH(now()) and YEAR(purchase_details.created_at) = YEAR(now()) and user_id = ?");
        $stmt->execute([$id]);
        $count = $stmt->fetch();
     
        return $count;
    }
}


?>