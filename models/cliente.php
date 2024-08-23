<?php

class Cliente
{
    private $db;

    public function __construct()
    {
        require_once '../config/config.php';
        $this->db = $pdo;
    }

    public function getClientes()
    {
        $stmt = $this->db->query("SELECT * FROM dados_cliente");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function newCliente($dados)
    {
        

        $sql = "call novo_cliente(?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(1, $dados["cpf"]);
        $stmt->bindParam(2, $dados["rg"]);
        $stmt->bindParam(3, $dados["nome"]);
        $stmt->bindParam(4, $dados["apelido"]);
        $stmt->bindParam(5, $dados["email"]);
        $stmt->bindParam(6, $dados["telefone"]);
        $stmt->bindParam(7, $dados["logradouro"]);
        $stmt->bindParam(8, $dados["numero"]);
        $stmt->bindParam(9, $dados["complemento"]);
        $stmt->bindParam(10, $dados["bairro"]);
        $stmt->bindParam(11, $dados["cidade"]);
        $stmt->bindParam(12, $dados["cep"]);
        $stmt->bindParam(13, $dados["uf"]);


        return $stmt->execute();
    }
}
