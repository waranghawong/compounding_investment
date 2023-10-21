<?php


class cashInCntrl extends cashIn{

    public function getAdminBilling(){

        return $this->getBilling();

    }

    public function insertCashin($cashin_amount, $cashin_method, $cashin_reference, $cashin_date, $cashin_time, $cashin_image, $user_id){

            if($this->checkPaymentMethod($cashin_method) == true){
                header("location: cashin.php?error=payment_method_required");
                exit();
            }
            $imageFile = $this->uploadImage($cashin_image);

            return $this->insertPayment($cashin_amount, $cashin_method, $cashin_reference, $cashin_date, $cashin_time, $imageFile, $user_id);

    }

    public function checkPaymentMethod($cashin_method){
        $result;
        if(empty($cashin_method)){
            $result = true;
        }
        else{
            $result = false;
        }

        return $result;

    }

    public function uploadImage($cashin_image){
        $target_dir = "../uploads/";
        $uploadErr = "";
        $target_file = $target_dir . basename($cashin_image["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if(file_exists($target_file)) {
            $target_file  = $target_dir .$this->random_string(). basename($cashin_image["name"]);
            $uploadOk = 1;
        }
        
        $check = getimagesize($cashin_image["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        }
        else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

     

        if($cashin_image["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }


        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
        }

         // Check if $uploadOk is set to 0 by an error
         if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($cashin_image["tmp_name"], $target_file)) {
               return $target_file;
            } else {
            echo "Sorry, there was an error uploading your file.";
            }
        }

    }

    function random_string($length = 10) {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));
    
        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }
    
        return $key;
    }

    public function getPaymentDetails($id){
        return $this->paymentDetails($id);
    }

    public function getPaymentDetailsById($paymentid){
        echo json_encode($this->paymentDetailsId($paymentid));
    }

    public function getAllCashin(){
        return $this->allCashins();
    }

    public function approvePayment($id){

        return $this->approveUserPayment($id);

    }

    public function rejectPayment($id){
        return $this->rejectUserPayment($id);
    }

    public function getUserPurchaseDetail($user){
        return $this->userInvestmentUpdate($user);
    }
    
}


?>