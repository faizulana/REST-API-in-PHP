<?php
require '/home/milana/backend/rest api/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$pass = $_ENV['MYSQL_PASSWORD'];
$user = $_ENV['MYSQL_USER'];
$database = $_ENV['DATABASE_NAME'];
$hostname = $_ENV['MYSQL_HOST'];

class Database
{
        private string $host;
        private string $db_name;
        private string $username;
        private string $password;
        public ?PDO $conn = null;
        public function __construct($host, $db_name, $username, $password) {
            $this->host = $host;
            $this->db_name = $db_name;
            $this->username = $username;
            $this->password = $password;
        }
        public function getConnection(): ?PDO
    {

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");

        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>