<?php 
class functions
{
    public function valida_cpf($cpf){
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (strlen($cpf) != 11) {
            return false;
        }
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }

    public function valida_cep($cep){
        $cep = preg_replace('/[^0-9]/', '', $cep);

        if (strlen($cep) != 8) {
            return false;
        }

        $url = "https://viacep.com.br/ws/$cep/json/";
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        // Retorna os dados obtidos
        if (isset($data['erro'])) {
            return ['erro' => true, 'mensagem' => 'CEP não encontrado.'];
        }

        return $data;
    }
}