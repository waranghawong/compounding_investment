<?php 

class cashIn extends DB{


    protected function getBilling(){

        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT admin_billing.id,admin_billing.account_number, admin_billing.account_name, admin_billing.account_address, admin_billing.created_at, account_method.name FROM admin_billing INNER JOIN account_method ON account_method.id = admin_billing.account_method");
        $stmt->execute();

        $data = $stmt->fetchall();
        return $data;
        
    }

    protected function insertPayment($cashin_amount, $cashin_method, $cashin_reference, $cashin_date, $cashin_time, $cashin_image, $user_id){

        $datetimetoday = date("Y-m-d H:i:s");
        $con = $this->dbOpen();
        $stmt = $con->prepare("INSERT INTO payment_details (user_id,payment_amount, payment_method, payment_reference, date_purchased, time_purchased, payment_image, created_at) VALUES (?,?,?,?,?,?,?,?) ");
        // $transaction = new transactionsctnr($user_id, null,'cash-in',)

        if(!$stmt->execute(array($user_id, $cashin_amount, $cashin_method, $cashin_reference, $cashin_date, $cashin_time, $cashin_image, $datetimetoday))){
            $stmt = null;
            header("location: ../investors-panel/cashin.php?error=stmtfailed");
            exit();
        }


        $percentage = 35;
        $id = $con->lastInsertId();
        $tran_id = 'JM-'.str_pad($id,8,"0",STR_PAD_LEFT);
        $payout = ($percentage / 100) * intval($cashin_amount);
        $compounded = intval($cashin_amount ) + intval($payout);

        $stmt2 = $con->prepare("INSERT INTO purchase_details (payment_id, transaction_number, compounded, payout, initial_investment, total_amount, created_at) VALUES (?,?,?,?,?,?,?)");
        if(!$stmt2->execute(array($id, $tran_id, $cashin_amount, $payout, $cashin_amount, $compounded, $datetimetoday))){
            $stmt2 = null;
            header("location: ../investors-panel/cashin.php?error=stmtfailed");
            exit();
        }
        else{
            header("location: ../investors-panel/cashin.php?success=1");
        }

    }

    protected function paymentDetails($id){

        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM purchase_details INNER JOIN payment_details ON purchase_details.payment_id = payment_details.id WHERE user_id = ?");
        $stmt->execute([$id]);

        $data = $stmt->fetchall();
        return $data;
    }

    protected function paymentDetailsId($paymentid){

        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT purchase_details.payment_id,purchase_details.transaction_number, purchase_details.compounded, purchase_details.payout, purchase_details.initial_investment, purchase_details.status, purchase_details.created_at, payment_details.payment_amount, payment_details.payment_method, payment_details.payment_reference, payment_details.date_purchased, payment_details.time_purchased, payment_details.payment_image FROM purchase_details INNER JOIN payment_details ON purchase_details.payment_id = payment_details.id WHERE payment_id = ?");
        $stmt->execute([$paymentid]);

        $data = $stmt->fetchall();
        $total = $stmt->rowCount();
        if($total > 0){
            return $data;
        }
        else{
            return false;
        }
    }


    protected function allCashins(){

        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT purchase_details.payment_id,purchase_details.transaction_number, purchase_details.compounded, purchase_details.payout, purchase_details.initial_investment, purchase_details.status, purchase_details.created_at, payment_details.payment_amount, payment_details.payment_method, payment_details.payment_reference, payment_details.date_purchased, payment_details.time_purchased, payment_details.payment_image FROM purchase_details INNER JOIN payment_details ON purchase_details.payment_id = payment_details.id");
        $stmt->execute();

        $data = $stmt->fetchall();
        $total = $stmt->rowCount();
        if($total > 0){
            return $data;
        }
        else{
            return false;
        }
    }

    protected function approveUserPayment($id){
        $datetimetoday = date("Y-m-d");
        $date_withdrawable = date("Y-m-d", strtotime("+1 month", strtotime($datetimetoday)));
        $date_withdrawable2 = date("Y-m-d", strtotime("+2 day", strtotime($datetimetoday)));
        $lockindate = date("Y-m-d", strtotime("+1 year", strtotime($datetimetoday)));

        $connection = $this->dbOpen();
        $stmt = $connection->prepare("UPDATE purchase_details SET status = ?, date_withdrawable = ?, lock_in = ? WHERE payment_id = ?");
        if(!$stmt->execute(['approved',$date_withdrawable2, $lockindate ,$id])){
            $stmt2 = null;
            header("location: ../admin-page/cash-ins.php?error=stmtfailed");
            exit();
        }
        else{
            echo json_encode(array("status"=>"Approved"));
        }

    }

    protected function rejectUserPayment($id){

        $connection = $this->dbOpen();
        $stmt = $connection->prepare("UPDATE purchase_details SET status = ? WHERE payment_id = ?");
        if(!$stmt->execute(['rejected', $id])){
            $stmt2 = null;
            header("location: ../admin-page/cash-ins.php?error=stmtfailed");
            exit();
        }
        else{
            echo json_encode(array("status"=>"Rejected"));
        }
    }

    protected function userInvestmentUpdate($user){
        $percentage = 35;
        
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT purchase_details.payment_id, purchase_details.payout as withdrawable, purchase_details.compounded,purchase_details.date_withdrawable FROM purchase_details INNER JOIN payment_details ON payment_details.id = purchase_details.payment_id WHERE payment_details.user_id = ? and status = 'approved' AND purchase_details.date_withdrawable < CURDATE()");
        $stmt->execute([$user['id']]);

        $data = $stmt->fetchall();
        
        foreach($data as $ud){
            $id = $ud['payment_id'];
            $new_amount = $ud['compounded'] + $ud['withdrawable'];
            $payout = ($percentage / 100) * intval($new_amount);
            $date_withdrawable = date("Y-m-d", strtotime("+1 month", strtotime($ud['date_withdrawable'])));

            $stmt1 = $connection->prepare("UPDATE purchase_details SET compounded = ?, payout = ?, date_withdrawable = ? WHERE payment_id = ?");
            $stmt1->execute([$new_amount,$payout,$date_withdrawable , $id]);
         
   
        }
       
    }
}



?>