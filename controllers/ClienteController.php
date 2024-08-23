<?php

require_once '../models/Cliente.php';
require_once '../config/functions.php';

class ClienteController
{
    public function index()
    {
        $userModel = new Cliente();
        $users = $userModel->getClientes();
        require_once '../views/clientes.php';
    }

    public function create()
    {
        if(isset($_POST) && !empty($_POST)){
            $newCliente = new Cliente();
            $result = $newCliente->newCliente($_POST);
        }
        
        require_once '../views/cadastro.php';
    }

    public function validaCpf(){
        $func = new functions();
        echo json_encode(['valid' => $func->valida_cpf($_POST['cpf'])], 200);
    }
}
