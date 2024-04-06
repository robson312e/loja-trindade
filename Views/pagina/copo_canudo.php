<div class="pecas-totais">
    <?php
    use Models\Painel;
        foreach ($modelos as $key => $value)  { 
       
        $produto = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = ? ");
        $produto->execute(array($value['id']));
        $imagem = $produto->fetchAll();
        foreach ($imagem as $key2 => $value2) {
        ?>
    <div class="pecas">
        <img src="<?= INCLUDE_PATH_PAINEL ?>uploads/<?= $value2['imagem'] ?>" alt="">
       
        <p><?= Painel::tiraSlug($value['nome']) ?> Personalizados</p>
        
        <br>
        <form action="<?= INCLUD_PATH ?>conteudos" method="get">
        <input type="hidden" name="produto" value="<?= $value['nome'] ?>">
        <input type="hidden" name="id" value="<?= $value['id'] ?>">
            <input type="submit" name="janela_mod" value="peça ja!" />
        </form>
            
    </div>
    <?php } } ?>
</div>