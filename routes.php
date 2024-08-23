<?php

$routes = [
    '/AdminCad/public/' => 'HomeController@index',
    '/AdminCad/public/cadastro' => 'ClienteController@create',
    '/AdminCad/public/clientes' => 'ClienteController@index',
    '/AdminCad/public/validaCpf' => 'ClienteController@validaCpf',
];