<?php 

class accountApproval extends DB{

    protected function forApproval(){

        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM users WHERE role = '0' and isApproved = '0'");
        $stmt->execute();

        $data = $stmt->fetchall();
        return $data;

    }


    protected function delete($id){

        $connection = $this->dbOpen();
        $stmt = $connection->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);

    }

    protected function approve($id){

        $connection = $this->dbOpen();
        $stmt = $connection->prepare("UPDATE users SET isApproved = ? WHERE id = ?");
        $stmt->execute(['1', $id]);

    }
}