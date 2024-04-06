

<!-- Formulário da etapa 1, cadastrar usuário -->
<form enctype="multipart/form-data" method="POST" id="login-usuario-form" action="" class="form-adm">

    <h2 class="title">Dados do Usuário</h2>

    <?php
   $nome = '';
    if (isset($dados['cadnome'])) {
        $nome = $dados['cadnome'];
    }
    ?>
    <div class="row-input">
        <div class="column">
            <label class="title-input">Nome: <span class="text-danger">*</span></label>
            <input type="text" name="cadnome" class="input-adm" placeholder="Nome completo" value="<?php echo $nome; ?>">
        </div>
    </div>

    <?php
    $email = '';
    if (isset($dados['cademail'])) {
        $email = $dados['cademail'];
    }
    ?>
    <div class="row-input">
        <div class="column">
            <label class="title-input">E-mail: <span class="text-danger">*</span></label>
            <input type="email" name="cademail" class="input-adm" placeholder="Melhor e-mail" value="<?php echo $email; ?>">
        </div>
    </div>

    <?php
    $senha = '';
    if (isset($dados['cadsenha'])) {
        $email = $dados['cadsenha'];
    }
    ?>
    <div class="row-input">
        <div class="column">
            <label class="title-input">Senha: <span class="text-danger">*</span></label>
            <input type="password" name="cadsenha" class="input-adm" placeholder="senha...." value="<?php echo $senha; ?>">
        </div>
    </div>

    <?php
    $tele = '';
    if (isset($dados['cadtele'])) {
        $tele = $dados['cadtele'];
    }
    ?>
    <div class="row-input">
        <div class="column">
            <label class="title-input">Numero: <span class="text-danger">*</span></label>
            <input type="text" name="cadtele" class="input-adm" placeholder="Numero Celular..." value="<?php echo $senha; ?>">
        </div>
    </div>

    <?php
    $cpf = '';
    if (isset($dados['cadcpf'])) {
        $cpf = $dados['cadcpf'];
    }
    ?>
    <div class="row-input">
        <div class="column">
            <label class="title-input">cpf: <span class="text-danger">*</span></label>
            <input type="text" name="cadcpf" maxlength="11" class="input-adm" placeholder="Numero cpf..." value="<?php echo $cpf; ?>">
        </div>
    </div>

 

    <p class="obrigatorio">* Campo Obrigatório</p>
<div >
    <input  type="submit" id="cad-usuario-form" name="cadUsuario"  class="btn-success" value="Cadastrar" />
</div>

</form>

<script>
    
    const cadForm = document.getElementById("cad-usuario-form");
    cadForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    document.getElementById("cad-usuario-btn").value = "Salvando...";

    const dadosForm = new FormData(cadForm);

    const dados = await fetch("cadastrar.php", {
        method: "POST",
        ectype: "multipart/form-data",
        body: dadosForm
    });

    const resposta = await dados.json();

    console.log(resposta);

    if(resposta['erro']){
        msgAlertErroCad.innerHTML = resposta['msg'];
    }else{
        msgAlert.innerHTML = resposta['msg'];
        cadForm.reset();
        cadModal.hide();
    }   

    document.getElementById("cad-usuario-btn").value = "Cadastrar";
});
</script>