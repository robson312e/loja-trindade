<?php
namespace Views;

use Models\Painel;
use MySql;

class MainView
{
    private $faleName;
    private $header;
    private $footer;
    public $menuItens = ['home','sobre','contato'];
    public function __construct($faleName,$header = 'header',$footer = 'footer'){
        $this->faleName = $faleName;
        $this->header = $header;
        $this->footer = $footer;
    }
    public function render($arr = []){
        include_once'pagina/templates/'.$this->header.'.php';
        include_once'pagina/'.$this->faleName.'.php';
        include_once'pagina/templates/'.$this->footer.'.php';
    }
}