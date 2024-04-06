<?php

use Models\Painel;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// Verificar se o usuário clicou no botão cadastrar usuário
if (isset($dados['cadUsuario'])) {
    // Verificar se os campos estão preenchidos
    if (empty($dados['cadnome'])) {
        $mensagem = "<div class='alert-danger'>Erro: Necessário preencher o campo nome!</div>";
    } elseif (empty($dados['cademail'])) {
        $mensagem = "<div class='alert-danger'>Erro: Necessário preencher o campo e-mail!</div>";
    } else {
        // Criar a QUERY cadastrar no banco de dados

        require 'vendor/autoload.php';

        include_once 'conexao.php';

        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (empty($dados['cadnome'])) {
            $retorna = ['erro' => true, 'msg' => Painel::alertJS('Necessário preencher o campo nome!')];
        } elseif (empty($dados['cademail'])) {
            $retorna = ['erro' => true, 'msg' => Painel::alertJS('Necessário preencher o campo e-mail!')];
        } elseif (empty($dados['cadsenha'])) {
            $retorna = ['erro' => true, 'msg' => Painel::alertJS('Necessário preencher o campo senha!')];
        } else {
            $query_usuario_pes = 'SELECT id FROM `tb_usuarios_login` WHERE email=:email LIMIT 1';
            $result_usuario = $conn->prepare($query_usuario_pes);
            $result_usuario->bindParam(':email', $dados['cademail'], PDO::PARAM_STR);
            $result_usuario->execute();

            if ($result_usuario and ($result_usuario->rowCount() != 0)) {
                $retorna = ['erro' => true, 'msg' => Painel::alertJS('O e-mail já está cadastrado!')];
            } else {
                $query_usuario = 'INSERT INTO `tb_usuarios_login` (id, email, senha,  nome,  chave, cargo, tele, cpf) VALUES (null, :email, :senha, :nome, :chave, "0", :tele, :cpf)';
                $cad_usuario = $conn->prepare($query_usuario);
                $cad_usuario->bindParam(':email', $dados['cademail'], PDO::PARAM_STR);
                $cad_usuario->bindParam(':senha', $dados['cadsenha'], PDO::PARAM_STR);
                $cad_usuario->bindParam(':nome', $dados['cadnome'], PDO::PARAM_STR);
                $chave = password_hash($dados['cademail'].date('Y-m-d H:i:s'), PASSWORD_DEFAULT);
                $cad_usuario->bindParam(':chave', $chave, PDO::PARAM_STR);
                $cad_usuario->bindParam(':tele', $dados['cadtele'], PDO::PARAM_STR);
                $cad_usuario->bindParam(':cpf', $dados['cadcpf'], PDO::PARAM_STR);

                $cad_usuario->execute();

                if ($cad_usuario->rowCount()) {
                    $mail = new PHPMailer(true);

                    try {
                        // Server settings
                        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                        $mail->CharSet = 'UTF-8';
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';                     // Set the SMTP server to send through
                        $mail->SMTPAuth = true;                                   // Enable SMTP authentication
                        $mail->Username = 'robson.silvaaaaaaao@gmail.com';                     // SMTP username
                        $mail->Password = 'efqr wqld tqyj sjgu';                               // SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable implicit TLS encryption
                        $mail->Port = 465;

                        // Recipients
                        $mail->setFrom('robson.silvaaaaaaao@gmail.com', 'loja_grafica');
                        $mail->addAddress($dados['cademail'], $dados['cadnome']);

                        $mail->isHTML(true);                                  // Set email format to HTML
                        $mail->Subject = 'Confirma o e-mail';
                        $mail->Body = 'Prezado(a) '.$dados['cadnome'].". Agradecemos a sua solicitação de cadastramento em nosso site! Para que possamos liberar o seu cadastro em nosso sistema, solicitamos a confirmação do e-mail clicanco no link abaixo: a href='http://localhost/loja_virtual/confirmar_email?chave=$chave'>Clique aqui</a> Esta mensagem foi enviada a você pela empresa XXX.Você está recebendo porque está cadastrado no banco de dados da empresa XXX. Nenhum e-mail enviado pela empresa XXX tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais.";
                        $mail->AltBody = 'Prezado(a) '.$dados['cadnome']." Agradecemos a sua solicitação de cadastramento em nosso site! Para que possamos liberar o seu cadastro em nosso sistema, solicitamos a confirmação do e-mail clicanco no link abaixo:  http://localhost/loja_virtual/confirmar_email?chave=$chave Esta mensagem foi enviada a você pela empresa XXX. Você está recebendo porque está cadastrado no banco de dados da empresa XXX. Nenhum e-mail enviado pela empresa XXX tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais.";

                        $mail->send();

                        $retorna = ['erro' => false, 'msg' => Painel::alertJS('Usuário cadastrado com sucesso. Necessário acessar a caixa de e-mail para confimar o e-mail!')];
                    } catch (Exception $e) {
                        // $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário não cadastrado com sucesso!</div>"];

                        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário não cadastrado com sucesso.</div>"];
                    }
                } else {
                    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário não cadastrado com sucesso!</div>"];
                }
            }
        }
    }
}
