<?php

require_once 'model'.DS.'Conexao.php';

class CrudModel {

    private $conn;

    public function __construct() {
        $conn = new Conexao();
        $this->conn = $conn->conectar();
    }

    public function createModel($nome, $email, $telefone) {
        $sql = $this->conn->prepare('INSERT INTO contatos (nome, email, telefone) VALUES (:nome, :email, :telefone);');
        $sql->bindValue(':nome', $nome, PDO::PARAM_STR);
        $sql->bindValue(':email', $email, PDO::PARAM_STR);
        $sql->bindValue(':telefone', $telefone, PDO::PARAM_INT);
        $sql->execute();
    }

    public function readModel($id) {
        $sql = $this->conn->prepare("SELECT * FROM contatos WHERE id=:id");
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        $dados = $sql->fetch(PDO::FETCH_OBJ);
        return $dados;
    }

    public function updateModel($id, $nome, $email, $telefone) {

        $sql = $this->conn->prepare("UPDATE contatos SET nome=:nome, email=:email, telefone=:telefone WHERE id=:id LIMIT 1");
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->bindValue(':nome', $nome, PDO::PARAM_STR);
        $sql->bindValue(':email', $email, PDO::PARAM_STR);
        $sql->bindValue(':telefone', $telefone, PDO::PARAM_INT);
        $sql->execute();
        
    }

    public function deleteModel($id) {
        $sql = $this->conn->prepare("DELETE FROM contatos WHERE id=:id");
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->execute();
    }

    public function readAllModel() {
        $sql = $this->conn->prepare("SELECT * FROM contatos");
        $sql->execute();

        $dados = array();
        while ($obj = $sql->fetch(PDO::FETCH_OBJ)) {
            $dados[] = $obj;
        }
        return $dados;

    }

}
