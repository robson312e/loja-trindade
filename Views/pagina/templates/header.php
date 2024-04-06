<?php
use Models\Site;

Site::updateUsuarioOnline();
Site::contador();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if (isset($_GET['url'][0]) == 'carrinho') { ?>
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH_FULL; ?>css/carrinho.css">
    <?php } ?>
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH_FULL; ?>css/estilo.css">
    <title><?php echo $arr['titulo']; ?></title>
</head>
<body>

    <div class="header">
        <div class="header-container">
            <div class="icones ">
                <a href="#"><i class="fa-brands fa-facebook"></i></a>
                <a href="https://www.instagram.com/pvd_silva__011/"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-tiktok"></i></a>
            </div>

            <div class="buscar">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" placeholder="Buscar">
            </div>

            <div class="cadastrar-login color-white">
                    <i class="fa-regular fa-user"></i>
                    <a href="<?php echo INCLUD_PATH; ?>cadastreSe">CADASTRE-SE</a>
                    <span>|</span>
                    <a href="<?php echo INCLUD_PATH; ?>login">LOGIN</a>
            </div>
        </div>
    </div>
        
    <div class="menu-logo">
        <div class="logo">
            <img src="<?php echo INCLUDE_PATH_FULL; ?>img/logo1.png" alt="">
        </div>
        <div class="links-menu">
            <nav>
                <ul>
                    <li><a href="<?php echo INCLUD_PATH; ?>">home</a></li>
                    <p></p>
                    <li><a href="<?php echo INCLUD_PATH; ?>camisas">camisas</a></li>
                    <p></p>
                    <li><a href="<?php echo INCLUD_PATH; ?>azuleijos">Azulejos</a></li>
                    <p></p>
                    <li><a href="<?php echo INCLUD_PATH; ?>kit_caneca">Kit caneca + toalha</a></li>
                    <p></p>
                    <li><a href="<?php echo INCLUD_PATH; ?>etiqueta">Etiqueta</a></li>
                    <p></p>
                    <li><a href="<?php echo INCLUD_PATH; ?>tubete">Tubete caixinha</a></li>
                    <p></p>
                    <li><a href="<?php echo INCLUD_PATH; ?>pegue_monte">Pegue e Monte</a></li>
                    <p></p>
                    <li><a href="<?php echo INCLUD_PATH; ?>pegue_monte_completo">Pegue e Monte completo</a></li>
                    <select onchange="location.href=this.value">
                        <option value="">Copos Personalizados</option>
                        <option value="<?php echo INCLUD_PATH; ?>caneca">caneca</option>
                        <option value="<?php echo INCLUD_PATH; ?>copo_long">Copo Long Drink</option>
                        <option value="<?php echo INCLUD_PATH; ?>copo_canudo">Copo Canudo</option>
                        <option value="<?php echo INCLUD_PATH; ?>taca_gin">Taça Gin</option>
                    </select>
                </ul>
            </nav>
        </div>

        
        
        <div class="carrinho">
        <a href="<?php echo INCLUD_PATH; ?>carrinho">
        <i class="fa-solid fa-cart-shopping"></i>
            <div class="preco-car">
            <a href="javascript:void(0);"> (<?php echo \models\homeModel::getTotalItemsCarrinho(); ?>)</a>
            </div>
            
        </a>
            
        </div>
    </div>
    <div class="barra"></div>
    <div class="mobeli-links">
            <i class="fa fa-bars"></i>
            <nav>
                <ul>
                    <li><a href="<?php echo INCLUD_PATH; ?>">home</a></li>
                    <li><a href="<?php echo INCLUD_PATH; ?>camisas">camisas</a></li>
                    <li><a href="<?php echo INCLUD_PATH; ?>azuleijos">Azulejos</a></li>
                    <li><a href="<?php echo INCLUD_PATH; ?>kit_caneca">Kit caneca + toalha</a></li>
                    <li><a href="<?php echo INCLUD_PATH; ?>etiqueta">Etiqueta</a></li>
                    <li><a href="<?php echo INCLUD_PATH; ?>tubete">Tubete caixinha</a></li>
                    <li><a href="<?php echo INCLUD_PATH; ?>pegue_monte">Pegue e Monte</a></li>
                    <li><a href="<?php echo INCLUD_PATH; ?>pegue_monte_completo">Pegue e Monte completo</a></li>
                    <li><a href="<?php echo INCLUD_PATH; ?>caneca">Caneca</a></li>
                    <li><a href="<?php echo INCLUD_PATH; ?>copo_long">Copo Long</a></li>
                    <li><a href="<?php echo INCLUD_PATH; ?>copo_canudo">Copo Canudo</a></li>
                    <li><a href="<?php echo INCLUD_PATH; ?>taca_gin">Taça gin</a></li>
                    
                </ul>
            </nav>
        </div>
    <?php
     $url = explode('/', @$_GET['url']);
$str = join($url);
$produto = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` WHERE nome LIKE '%$str%' OR descricao LIKE '%$str%'");
$produto->execute();
$modelos = $produto->fetchall();
?>

