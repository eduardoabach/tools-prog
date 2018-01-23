<?php

class Conexao {

    private $drive = 'mysql';
    private $db    = 'crud_novo';
    private $host  = 'localhost';
    private $user  = 'root';
    private $pass  = '';
    private $conn  = null;

    
    public function conectar() {
        try {
            $this->conn = new PDO($this->drive . ':host=' . $this->host . '; dbname=' . $this->db, $this->user, $this->pass);
            return $this->conn;
        } catch (Exception $e) {
            die("Erro ao tentar conectar " . $e->getMessage());
        }
    }

        public static function desconectar() {
        $this->conn = null;
    }
  
}
