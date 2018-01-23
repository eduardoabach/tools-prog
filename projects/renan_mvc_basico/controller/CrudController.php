<?php

include_once 'CrudManipulaController.php';

class CrudController {

    private $crudManipulaController = null;

    public function __construct() {
        $this->crudManipulaController = new CrudManipulaController();
    }

    public function request() {

        $op = isset($_GET['op']) ? $_GET['op'] : null;

        try {

            switch ($op) {
                case 'listar':
                    $this->read();
                    break;
                case 'novo':
                    $this->create();
                    break;
                case 'editar':
                    $this->update();
                    break;
                case 'deletar':
                    $this->delete();
                    break;
                default:
                    $this->readAll();
                    break;
            }
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    public function create() {

        $nome = '';
        $email = '';
        $telefone = '';

        if (isset($_POST['form-submitted'])) {

            $nome = isset($_POST['nome']) ? trim($_POST['nome']) : null;
            $email = isset($_POST['email']) ? trim($_POST['email']) : null;
            $telefone = isset($_POST['telefone']) ? trim($_POST['telefone']) : null;

            $dados = $this->crudManipulaController->createManipula($nome, $email, $telefone);
            header('Location: index.php');

            return $dados;
        }

        include_once 'view' . DS . 'create.php';
    }

    public function read() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        $dados = $this->crudManipulaController->readManipula($id);
        include_once 'view' . DS . 'read.php';
    }

    public function update() {

        $nome = '';
        $email = '';
        $telefone = '';
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        $dados = $this->crudManipulaController->readManipula($id);

        if (isset($_POST['form-submitted'])) {

            $nome = isset($_POST['nome']) ? trim($_POST['nome']) : null;
            $email = isset($_POST['email']) ? trim($_POST['email']) : null;
            $telefone = isset($_POST['telefone']) ? trim($_POST['telefone']) : null;

            $dados = $this->crudManipulaController->updateManipula($id, $nome, $email, $telefone);
            header('Location: index.php');
            return $dados;
        }

        include_once 'view' . DS . 'update.php';
    }

    public function delete() {

        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if (isset($_POST['form-submitted'])) {
            $dados = $this->crudManipulaController->deleteManipula($id);
            header('Location: index.php');
        }

        $dados = $this->crudManipulaController->readManipula($id);
        include_once 'view' . DS . 'delete.php';
    }

    public function readAll() {
        $dados = $this->crudManipulaController->readAllManipula();
        include_once 'view' . DS . 'readAll.php';
    }

}
