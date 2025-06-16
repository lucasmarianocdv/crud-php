<?php
require_once __DIR__ . '/../config/database.php'; 

class DatabaseService
{
    private static $instance = null;
    private $conn;

    private function __construct()
    {
        
        $dsn = DB_CONNECTION_TYPE . ":host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_DATABASE;
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $this->conn = new PDO($dsn, DB_USERNAME, DB_PASSWORD, $options);
        } catch (PDOException $e) {
            error_log("Erro de Conexão com o Banco de Dados: " . $e->getMessage());
            echo "<p>Detalhes: " . $e->getMessage() . "</p>";
            die();
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->conn;
    }
}