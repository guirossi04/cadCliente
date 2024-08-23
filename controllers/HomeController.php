<?php
require_once '../config/functions.php';

class HomeController
{
    public function index()
    {
        require_once '../views/home.php';
    }

    public function validaCpf()
    {
        $func = new functions();
        echo json_encode(['valid' => $func->valida_cpf($_POST['cpf'])], 200);
    }

    public function buscaCEP()
    {
        $func = new functions();
        echo json_encode(['dados' => $func->valida_cep($_POST['cep'])], 200);
    }
}
