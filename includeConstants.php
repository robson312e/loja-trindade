<?php

define('INCLUDE_PATH', 'http://localhost/loja_virtual/');
define('INCLUDE_PATH_PAINEL', INCLUDE_PATH.'painel/');

define('BASE_DIR_PAINEL', __DIR__.'/painel');
// Conectar com banco de dados!
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE', 'loja_virtual');

// Constantes para o painel de controle
define('NOME_EMPRESA', 'Danki Code');

function logado()
{
    return isset($_SESSION['login']) ? true : false;
}
