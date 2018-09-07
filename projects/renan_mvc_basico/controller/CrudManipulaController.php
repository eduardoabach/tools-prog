<?php

require_once 'model'.DS.'CrudModel.php';

class CrudManipulaController extends CrudModel
{
    
    private $crudModel = null;
    
    public function __construct() 
    {
        $this->crudModel = new CrudModel();
    }
    
    public function createManipula($nome, $email, $telefone)
    {
        $dados = $this->crudModel->createModel($nome, $email, $telefone);
        return $dados;
    }
    
    public function readManipula($id) 
    {
        $dados = $this->crudModel->readModel($id);
        return $dados;
    }

    public function updateManipula($id, $nome, $email, $telefone) 
    {
        $dados = $this->crudModel->updateModel($id, $nome, $email, $telefone);
        //return $dados;
    }

    public function deleteManipula($id) 
    {
        $this->crudModel->deleteModel($id);
    }

    public function readAllManipula() 
    {
        $dados = $this->crudModel->readAllModel();
        return $dados;
    }
}
