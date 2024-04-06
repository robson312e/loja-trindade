<?php

use Models\Painel;

include_once 'conexao.php';

$chave = filter_input(INPUT_GET, 'chave', FILTER_SANITIZE_STRING);

// $chave = $_GET['chave'];

if (!empty($chave)) {
    // echo "Chave: $chave <br>";

    $query_usuario = 'SELECT id FROM `tb_usuarios_login` WHERE chave=:chave LIMIT 1';
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->bindParam(':chave', $chave, PDO::PARAM_STR);
    $result_usuario->execute();

    if ($result_usuario and ($result_usuario->rowCount() != 0)) {
        $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
        extract($row_usuario);

        $query_up_usuario = "UPDATE `tb_usuarios_login` SET sits_usuario_id = 1 WHERE id=$id";
        $up_usuario = $conn->prepare($query_up_usuario);
        // $up_usuario->bindParam(':chave', $chave, PDO::PARAM_STR);

        if ($up_usuario->execute()) {
            $sql = MySql::conectar()->prepare('SELECT * FROM `tb_usuarios_login` WHERE chave=? ');
            $sql->execute([$_GET['chave']]);
            $iduser = $sql->fetch();
            $_SESSION['usuario_id'] = $iduser['id'];
            $_SESSION['msg'] = '<script>alert("E-mail confirmado.")</script>';
            $_SESSION['etapa'] = 2;
            Painel::redirect(INCLUD_PATH.'cadastreSe?confirm=confirmado');
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: E-mail confirmado.</div>";
            Painel::redirect(INCLUD_PATH.'cadastreSe');
        }
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Endereço inválido.</div>";
        Painel::redirect(INCLUD_PATH.'cadastreSe');
    }
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Endereço inválido.</div>";
    Painel::redirect(INCLUD_PATH.'cadastreSe');
}
