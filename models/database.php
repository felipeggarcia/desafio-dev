
<?php
Class Database
{
    private $user ;
    private $host;
    private $pass ;
    private $db;

    public function __construct()
    {
        $this->user = "root";
        $this->host = "localhost";
        $this->pass = "";
        $this->db = "desafio-dev";
    }
    public function connect()
    {
        $conn =  new PDO('mysql:host='.$this->host .';dbname='.$this->db, $this->user, $this->pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return  $conn;
    }
}
?>