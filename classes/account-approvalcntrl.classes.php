<?php

class accountApprovalCntrl extends accountApproval {


    public function getForApproval(){

        return $this->forApproval();

    }

    public function deleteUser($id){

       $this->delete($id);
       echo json_encode(array("statusCode"=>200));
        
    }

    public function approveUser($id){

        $this->approve($id);
        echo json_encode(["statusCode"=>200]);
    }

}