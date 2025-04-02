<?php
class Database {
    private $host = "localhost";
    private $user = "root"; 
    private $password = ""; 
    private $database = "db_peminjaman"; 
    public $connection;
    
    //constructor untuk membuat koneksi ketika objek dibuat
    public function __construct(){
        $this->connect_db();
    }

    //fungsi untuk koneksi ke database
    public function connect_db() {
        $this->connection = new mysqli(
            $this->host,
            $this->user,
            $this->password,
            $this->database
        );

    if ($this->connection->connect_error) {
        die("Koneksi gagal: ". $this->connection->connect_error);
    }

    }

    public function close_connection(){
        $this->connection->close();
    }


}


$db = new Database();
?>
