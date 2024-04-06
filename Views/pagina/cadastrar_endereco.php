<?php

// Verificar se o usuário clicou no botão cadastrar endereço
if (isset($dados['cadEndereco'])) {
    // Verificar se os campos estão preenchidos
    if (empty($dados['cep'])) {
        $mensagem = "<div class='alert-danger'>Erro: Necessário preencher o campo Cep!</div>";
    } elseif (empty($dados['cidade'])) {
        $mensagem = "<div class='alert-danger'>Erro: Necessário preencher o campo Cidade!</div>";
    } elseif (empty($dados['estado'])) {
        $mensagem = "<div class='alert-danger'>Erro: Necessário preencher o campo Estado!</div>";
    } elseif (empty($dados['bairro'])) {
        $mensagem = "<div class='alert-danger'>Erro: Necessário preencher o campo Bairro!</div>";
    } elseif (empty($dados['rua'])) {
        $mensagem = "<div class='alert-danger'>Erro: Necessário preencher o campo Rua!</div>";
    } elseif (empty($dados['numero'])) {
        $mensagem = "<div class='alert-danger'>Erro: Necessário preencher o campo Numero!</div>";
    } else {
        // Criar a QUERY cadastrar no banco de dados
        $query_endereco = 'INSERT INTO `tb_cadastro.endereco` (usuario_id, cep, cidade, estado, bairro, rua, numero) VALUES (:usuario_id, :cep, :cidade, :estado, :bairro, :rua, :numero)';

        // Preparar a QUERY
        $cad_endereco = $conn->prepare($query_endereco);

        // Substituir os links pelos valores do formulário
        $cad_endereco->bindParam(':usuario_id', $_SESSION['usuario_id']);
        $cad_endereco->bindParam(':cep', $dados['cep']);
        $cad_endereco->bindParam(':cidade', $dados['cidade']);
        $cad_endereco->bindParam(':estado', $dados['estado']);
        $cad_endereco->bindParam(':bairro', $dados['bairro']);
        $cad_endereco->bindParam(':rua', $dados['rua']);
        $cad_endereco->bindParam(':numero', $dados['numero']);

        // Executar a QUERY
        $cad_endereco->execute();

        // Verificar se cadastrou no banco de dados
        if ($cad_endereco->rowCount()) {
            // Salvar o número da próxima etapa na sessão
            $_SESSION['etapa'] = 3;

            // Criar mensagem de sucesso
            $mensagem = "<div class='alert-success'>Endereço cadastrado com sucesso!</div>";
        } else {
            // Criar mensagem de sucesso
            $mensagem = "<div class='alert-danger'>Endereço não cadastrado!</div>";
        }
    }
}
