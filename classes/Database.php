<?php 


  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  class Database{
    private $host = "localhost"; // Host
    private $db_name = "moviex"; // DB Name
    private $username = "root"; // DB Username
    private $password = ""; // DB Password

    private static $instance = null; // Instanca klase
    public $connection = null; // Konekcija

    private function __construct(){    
        $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->db_name);
    }

    public function getConnection(){
        return $this->connection;
    }
    
    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new Database();
        }

        return self::$instance;
    }   
  }