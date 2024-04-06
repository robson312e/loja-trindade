<?php
use Models\Painel;

?>
<!-- Formulário da etapa 3, cadastrar empresa -->
<form method="POST" action="" enctype="multipart/form-data" class="form-adm">

    <h2 class="title">imagem</h2>

    <?php
    if (isset($_POST['acao'])) {
        $imagem = $_FILES['imagem'];
        if ($imagem['name'] == '') {
            Painel::alert('erro', 'A imagem precisa estar selecionada!');
        } else {
            // Podemos cadastrar!
            if (Painel::imagemValida($imagem) == false) {
                Painel::alert('erro', 'O formato especificado não está correto!');
            } else {
                // Apenas cadastrar no banco de dados!
                $chave = '';
                $imagem = Painel::uploadFile($imagem);
                $sql = MySql::conectar()->prepare('UPDATE `tb_usuarios_login` SET img = ? , chave = ? WHERE id = ?');
                $sql->execute([$imagem, $chave, $_SESSION['usuario_id']]);
                session_destroy();
                Painel::alertJS('Imagem cadastrada com sucesso!');
                Painel::redirect(INCLUD_PATH.'login?cadastrado=sucesso');
            }
        }
    }
?>
    <div class="row-input">
        <div class="column"><div class="input-group w50">
         <div class="labelIn">
             <label for="image_uploads"><p>imagem de perfil</p></label>
             <input type="file" id="image_uploads" name="imagem" accept=".jpg, .jpeg, .png" multiple />
         </div>
         <div class="preview">
             <p>selecione uma imagem</p>
         </div>
         </div>
        </div>
    </div>

   

    <input type="submit" name="acao" class="btn-success" value="Cadastrar" />
    <input type="submit" name="novoUsuario" class="btn-primary" value="Novo Usuario" />

</form>