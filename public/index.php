<?php

// Inclui o arquivo de rotas
require_once '../routes.php';

// Obtém a URI da requisição
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestUri = str_replace("/index.php", "", $requestUri);
// Verifica se a rota existe no array de rotas
if (array_key_exists($requestUri, $routes)) {
    // Divide o valor da rota para obter o controlador e o método
    list($controller, $method) = explode('@', $routes[$requestUri]);

    // Inclui o controlador
    require_once "../controllers/{$controller}.php";

    // Instancia o controlador e chama o método
    $controllerObject = new $controller();
    $controllerObject->$method();
} else {
    // Rota não encontrada (404)
    http_response_code(404);
    echo "Página não encontrada!";
}
