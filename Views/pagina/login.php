<?php

use Models\Painel;

if (isset($_GET['cadastrado']) == 'sucesso') {
    Painel::alertJS('cadastro realizado com sucesso');
    Painel::redirect(INCLUD_PATH.'login');
}
?>
<div class="page">
        <form method="post" class="formLogin">
        <?php

if (isset($_POST['acao'])) {
    $user = $_POST['email'];
    $password = $_POST['senha'];
    $sql = MySql::conectar()->prepare('SELECT * FROM `tb_usuarios_login` WHERE email = ?');
    $sql->execute([$user]);
    if ($sql->rowCount() == 1) {
        $info = $sql->fetch();
        // Logamos com sucesso.
        $_SESSION['login'] = true;
        $_SESSION['user'] = $user;
        $_SESSION['password'] = $password;
        $_SESSION['cargo'] = $info['cargo'];
        $_SESSION['tele'] = $info['tele'];
        $_SESSION['nome'] = $info['nome'];
        $_SESSION['img'] = $info['img'];
        $_SESSION['id'] = $info['id'];
        // if(isset($_POST['lembrar'])){
        //     setcookie('lembrar',true,time()+(60*60*24),'/');
        //     setcookie('user',$user,time()+(60*60*24),'/');
        //     setcookie('password',$password,time()+(60*60*24),'/');
        // }
        if ($info['sits_usuario_id'] != '1') {
            echo '<div class="erro-box"><i class="fa fa-times"></i>Erro: Necessário confirma o e-mail!</div>';
        } else {
            Painel::redirect(INCLUDE_PATH_PAINEL.'main');
        }
    } else {
        // Falhou
        echo '<div class="erro-box"><i class="fa fa-times"></i> Usuário ou senha incorretos!</div>';
    }
}
?>
            <h1>Login</h1>
            <p>Digite os seus dados de acesso no campo abaixo.</p>
            <label for="email">E-mail</label>
            <input name="email" type="email" placeholder="Digite seu e-mail" autofocus="true" />
            <label for="password">Senha</label>
            <input name="senha" type="password" placeholder="Digite sua Senha" />
            <a href="<?php echo INCLUD_PATH; ?>recuperar_senha">Esqueci minha senha</a>
            <input type="submit" value="Acessar" name="acao" class="btn" />
        </form>
    </div>