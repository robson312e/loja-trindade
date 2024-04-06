<?php

include '../includeConstants.php';
$data['token'] = '02BB3C5F19054EF5B56DB406FA1D67F3';
$data['email'] = 'robson.patricio1234@gmail.com';
$data['currency'] = 'BRL';
$data['notificationURL'] = 'http://localhost/cartaoCredito/retorno.php';
$data['reference'] = uniqid();
$index = 1;
$itemsCarrinho = $_SESSION['carrinho'];
foreach ($itemsCarrinho as $key => $value) {
    $idProduto = $key;
    $produto = \MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` WHERE id = $idProduto");
    $produto->execute();
    $produto = $produto->fetch();
    $valor = $produto['valor'];
    $data["itemId$index"] = $index;
    $data["itemQuantity$index"] = $value;
    $data["itemDescription$index"] = $produto['nome'];
    $data["itemAmount$index"] = number_format($produto['valor'], 2, '.', '');
    ++$index;
    $sql = \MySql::conectar()->prepare('INSERT INTO `tb_admin.pedidos` VALUES (null,?,?,?,?,?)');
    $sql->execute([$data['reference'], $_SESSION['user'], $produto['id'], $value, 'pendente']);
}

$url = 'https://pagseguro.uol.com.br/v2/checkout';
$data = http_build_query($data);

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
echo $xml = curl_exec($curl);
print_r($curl);
curl_close($curl);
$xml = simplexml_load_string($xml);

echo $xml->code;

$_SESSION['carrinho'] = [];
