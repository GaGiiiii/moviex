<?php


if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

class Database {
  private $host = "localhost"; // Host
  private $db_name = "moviex"; // DB Name
  private $username = "root"; // DB Username
  private $password = ""; // DB Password

  private static $instance = null; // Instanca klase
  public $connection = null; // Konekcija

  private function __construct() {
    if ($_SERVER['SERVER_NAME'] != "localhost") {
      $this->host = $_ENV['dbhost']; // Host
      $this->db_name = $_ENV['dbname']; // DB Name
      $this->username = $_ENV['dbusername']; // DB Username
      $this->password = $_ENV['dbpassword']; // DB Password    
    }

    $this->connection = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name . ';charset=utf8mb4', $this->username, $this->password);
    $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->db_name);
  }

  public function getConnection() {
    return $this->connection;
  }

  public static function getInstance() {
    if (!isset(self::$instance)) {
      self::$instance = new Database();
    }

    return self::$instance;
  }
}
