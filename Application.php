<?php

use Models\Painel;

session_start();
define('INCLUD_PATH', 'http://localhost/loja_virtual/');
define('INCLUDE_PATH_FULL', 'http://localhost/loja_virtual/Views/pagina/');
define('INCLUDE_PATH_PAINEL', INCLUD_PATH.'painel/');
define('BASE_DIR_PAINEL', __DIR__.'/painel');

function pegaCargo($indice)
{
    return Painel::$cargos[$indice];
}
class Application
{
    public function executar()
    {
        $url = isset($_GET['url']) ? explode('/', $_GET['url'])[0] : 'Home';
        $url = ucfirst($url);
        $url .= 'Controller';
        if (file_exists('Controllers/'.$url.'.php')) {
            // code...
            $className = 'Controllers\\'.$url;
            $controler = new $className();
            $controler->executar();
        } elseif (isset($_GET['url'])) {
            $url = ''.$_GET['url'];
            $url = explode('/', $url);
            if (file_exists('painel'.$url[1].'.php')) {
                include_once 'painel/'.$url[1].'.php';
            }
            include_once 'painel/'.$url[1].'.php';
        } else {
            exit('Não existe essa pagina!');
        }
    }
}

date_default_timezone_set('America/Sao_Paulo');
require 'vendor/autoload.php';
