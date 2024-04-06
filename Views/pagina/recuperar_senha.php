<?php
use Models\Painel;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if (isset($_GET['chave'])) { ?>
    <div class="page">
    <form method="post" action="" class="formLogin">
    <?php
    if (isset($_POST['acao'])) {
        $senha = $_POST['senha'];
        $confirSenha = $_POST['confirme'];
        $chave = '';
        if ($senha != $confirSenha) {
            echo '<div class="erro-box"><i class="fa fa-times"></i> Erro: Necessário a senha se igual a outra!</div>';
        }
        $sql = MySql::conectar()->prepare('SELECT * FROM `tb_usuarios_login` WHERE chave = ?');
        $sql->execute([$_GET['chave']]);
        $info = $sql->fetch();
        // $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $atua = MySql::conectar()->prepare('UPDATE `tb_usuarios_login` SET senha = ?, chave = ? WHERE id=?');
        $atua->execute([$senha, $chave, $info['id']]);
        if (isset($_GET['compra']) == true) {
            Painel::alert('sucesso', 'Atualizado com sucesso, Você sera redirecionado a tela de login!');
            echo '<script>setTimeout(() => {
                location.href="'.INCLUD_PATH.'loginCompra"
              }, "3000");setTimeout();</script>';
        } else {
            Painel::alert('sucesso', 'Atualizado com sucesso, Você sera redirecionado a tela de login!');
            echo '<script>setTimeout(() => {
                location.href="'.INCLUD_PATH.'login"
              }, "3000");setTimeout();</script>';
        }
    }
    ?>
    <h1>Nova Senha!</h1>
    <p>Digite a nova senha no campo abaixo.</p>
    <label for="senha">Senha</label>
    <input name="senha" type="password" placeholder="Digite sua nova senha" autofocus="true" />
    <br>
    <label for="Confirma">Confirme sua nova senha</label>
    <input name="confirme" type="password" placeholder="Confirme a senha" autofocus="true" />
    <input type="submit" value="Atualizar!" name="acao" class="btn" />
    
</form>
<?php } else { ?>
    
    <div class="page">
        <form method="post" action="" class="formLogin">
        <?php

        if (isset($_POST['acao'])) {
            if (isset($_GET['compra']) == 'false') {
                $email = $_POST['email'];
                $chave = password_hash($email.date('Y-m-d H:i:s'), PASSWORD_DEFAULT);
                $sql = MySql::conectar()->prepare('SELECT * FROM `tb_usuarios_login` WHERE email = ?');
                $sql->execute([$email]);
                $info = $sql->fetch();
                $atua = MySql::conectar()->prepare('UPDATE `tb_usuarios_login` SET chave = ? WHERE id=?');
                $atua->execute([$chave, $info['id']]);
                if ($sql->rowCount()) {
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
                        $mail->addAddress($_POST['email']);

                        $mail->isHTML(true);                                  // Set email format to HTML
                        $mail->Subject = 'Confirma o e-mail';

                        $mail->Body = 'Prezado(a) '.$info['nome'].". Agradecemos a sua solicitação de recuperação de senha em nosso site! Para que possamos liberar a atualização da senha em nosso sistema, solicitamos a confirmação do e-mail clicanco no link abaixo: a href='".INCLUD_PATH."recuperar_senha?chave=$chave&compra=true'>Clique aqui</a> Esta mensagem foi enviada a você pela empresa loja_grafica .Você está recebendo porque Você solicitou recuperar a senha na empresa loja grafica. Nenhum e-mail enviado pela empresa XXX tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais.";
                        $mail->AltBody = 'Prezado(a) '.$info['nome']." Agradecemos a sua solicitação de cadastramento em nosso site! Para que possamos liberar o seu cadastro em nosso sistema, solicitamos a confirmação do e-mail clicanco no link abaixo:  http://localhost/loja_virtual/confirmar_email?chave=$chave&compra Esta mensagem foi enviada a você pela empresa XXX. Você está recebendo porque está cadastrado no banco de dados da empresa XXX. Nenhum e-mail enviado pela empresa XXX tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais.";

                        $mail->send();

                        $retorna = ['erro' => false, 'msg' => Painel::alertJS(' Necessário acessar a caixa de e-mail para confimar o e-mail!')];
                    } catch (Exception $e) {
                        // $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário não cadastrado com sucesso!</div>"];

                        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário não cadastrado com sucesso.</div>"];
                    }
                }
            } else {
                $email = $_POST['email'];
                $chave = password_hash($email.date('Y-m-d H:i:s'), PASSWORD_DEFAULT);
                $sql = MySql::conectar()->prepare('SELECT * FROM `tb_usuarios_login` WHERE email = ?');
                $sql->execute([$email]);
                $info = $sql->fetch();
                $atua = MySql::conectar()->prepare('UPDATE `tb_usuarios_login` SET chave = ? WHERE id=?');
                $atua->execute([$chave, $info['id']]);
                if ($sql->rowCount()) {
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
                        $mail->addAddress($_POST['email']);

                        $mail->isHTML(true);                                  // Set email format to HTML
                        $mail->Subject = 'Confirma o e-mail';

                        $mail->Body = 'Prezado(a) '.$info['nome'].". Agradecemos a sua solicitação de recuperação de senha em nosso site! Para que possamos liberar a atualização da senha em nosso sistema, solicitamos a confirmação do e-mail clicanco no link abaixo: a href='".INCLUD_PATH."recuperar_senha?chave=$chave'>Clique aqui</a> Esta mensagem foi enviada a você pela empresa loja_grafica .Você está recebendo porque Você solicitou recuperar a senha na empresa loja grafica. Nenhum e-mail enviado pela empresa XXX tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais.";
                        $mail->AltBody = 'Prezado(a) '.$info['nome']." Agradecemos a sua solicitação de cadastramento em nosso site! Para que possamos liberar o seu cadastro em nosso sistema, solicitamos a confirmação do e-mail clicanco no link abaixo:  http://localhost/loja_virtual/confirmar_email?chave=$chave Esta mensagem foi enviada a você pela empresa XXX. Você está recebendo porque está cadastrado no banco de dados da empresa XXX. Nenhum e-mail enviado pela empresa XXX tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais.";

                        $mail->send();

                        $retorna = ['erro' => false, 'msg' => Painel::alertJS(' Necessário acessar a caixa de e-mail para confimar o e-mail!')];
                    } catch (Exception $e) {
                        // $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário não cadastrado com sucesso!</div>"];

                        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário não cadastrado com sucesso.</div>"];
                    }
                }
            }
        }
    ?>
            <h1>Recuperar Senha!</h1>
            <p>Digite os seus dados de acesso no campo abaixo.</p>
            <label for="email">E-mail</label>
            <input name="email" type="email" placeholder="Digite seu e-mail" autofocus="true" />
            <input type="submit" value="Recuperar!" name="acao" class="btn" />
        </form>
    </div>
    <?php } ?>