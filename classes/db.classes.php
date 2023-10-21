<?php
date_default_timezone_set('Asia/Manila');
Class DB{

    private $server = "mysql:host=localhost;dbname=jona_inv";
    private $dbusername = 'root';
    private $password = '';
    private $options = array(PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE =>PDO::FETCH_ASSOC);
    private $con;


    public function dbOpen(){
        try{    
           $this->con = new PDO($this->server, $this->dbusername, $this->password, $this->options);

           return $this->con;
        }catch(PDOExeption $e){
            die("Connection Failed:" . $e->getMessage());
        }
    }

    public function dbClose(){
        $this->con = null;
    }

}

$db = new DB();



?>