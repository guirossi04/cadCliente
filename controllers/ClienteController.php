<?php

require_once '../models/Cliente.php';

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
}
