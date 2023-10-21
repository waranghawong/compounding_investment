<?php

class activeUsers extends DB{


    protected function activeUsers(){

        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM users WHERE role = '0' and isApproved = '1'");
        $stmt->execute();

        $data = $stmt->fetchall();
        return $data;
    }
}


?>