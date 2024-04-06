<!-- Formulário da etapa 2, cadastrar endereço -->
<form method="POST" action="" class="form-adm">

    <h2 class="title">Endereço</h2>

    <?php
    $cep = '';
    if (isset($dados['cep'])) {
        $cep = $dados['cep'];
    }
    ?>
    <div class="row-input">
        <div class="column">
            <label class="title-input">Cep: </label><br>
            <input type="text" name="cep" class="input-adm" placeholder="Cep.." value="<?php echo $cep; ?>">
        </div>
    </div>

    <?php
    $cidade = '';
    if (isset($dados['cidade'])) {
        $cidade = $dados['cidade'];
    }
    ?>
    <div class="row-input">
        <div class="column">
            <label class="title-input">Cidade: </label>
            <input type="text" name="cidade" class="input-adm" placeholder="Cidade..." value="<?php echo $cidade; ?>">
        </div>
    </div>

    <?php
    $estado = '';
    if (isset($dados['estado'])) {
        $estado = $dados['estado'];
    }
    ?>
    <div class="row-input">
        <div class="column">
            <label class="title-input">Estado: </label>
            <input type="text" name="estado" class="input-adm" placeholder="Estado..." value="<?php echo $estado; ?>">
        </div>
    </div>

    <?php
    $bairro = '';
    if (isset($dados['bairro'])) {
        $bairro = $dados['bairro'];
    }
    ?>
    <div class="row-input">
        <div class="column">
            <label class="title-input">Bairro: </label>
            <input type="text" name="bairro" class="input-adm" placeholder="bairro..." value="<?php echo $bairro; ?>">
        </div>
    </div>

    <?php
    $rua = '';
    if (isset($dados['rua'])) {
        $rua = $dados['rua'];
    }
    ?>
    <div class="row-input">
        <div class="column">
            <label class="title-input">Rua: </label><br>
            <input type="text" name="rua" class="input-adm" placeholder="Av, rua..." value="<?php echo $rua; ?>">
        </div>
    </div>


    <?php
    $numero = '';
    if (isset($dados['numero'])) {
        $numero = $dados['numero'];
    }
    ?>
    <div class="row-input">
        <div class="column">
            <label class="title-input">Número: </label>
            <input type="text" name="numero" class="input-adm" placeholder="Número da residência" value="<?php echo $numero; ?>">
        </div>
    </div>


    <input type="submit" name="cadEndereco" class="btn-success" value="Cadastrar" />
    <input type="submit" name="novoUsuario" class="btn-primary" value="NovoUsuario" />

</form>