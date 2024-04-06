<?php
    use Models\Painel;

    

       $url = $_GET['produto'];
       $produto = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` WHERE id = ? ");
       $produto->execute(array($_GET["id"]));
       $modelos = $produto->fetchAll();
?>
<div class="conteudos-produto">
    <?php
         foreach ($modelos as $key => $value)  { 
       
            $produto = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = ? ");
            $produto->execute(array($_GET['id']));
            $imagem = $produto->fetchAll();
            foreach ($imagem as $key2 => $value2) {
            
    ?>
        <div class="especificacoes">
            <h2><?= Painel::tiraSlug($value['nome']) ?> Personalizados</h2>
        </div>
    <div class="imagem-produto">
        <div style="display: none;" class="gallery" onclick="openLightbox(event)">
            <img src="<?= INCLUDE_PATH_PAINEL ?>uploads/<?= $value2['imagem']?>" alt="Image <?= $key2 ?>">

        </div>

        <!-- Lightbox container -->
        <div id="lightbox" style="display: flex;">
            <!-- Close button -->

            <!-- Main lightbox image -->
            <img id="lightbox-img" src="" alt="lightbox image">

            <!-- Thumbnails container -->
            <div id="thumbnail-container">
                <!-- Thumbnails will be added dynamically using JavaScript -->
            </div>

            <!-- Previous and Next buttons -->
        </div>
    </div>
        <div class="informa">
            <p>Os detalhes da personalização é feito conforme sua escolha após confirmação da compra ou se  tiver qualquer duvida. No botão Fale Conosco via Whatsapp, ao lado esquerdo da página.</p>
            <h3>Preço</h3>
            <h4>R$ <p> <?= $value['valor'] ?>,00</p></h4>
            <div class="encomenda">
                <h3><i class='fas fa-history'></i> Feito sob encomenda</h3>
                <p>dependendo da quantia ate 5 dias úteis para produção</p>
            </div>
           
           <form method="get" action="<?= INCLUD_PATH ?>conteudos?produto=<?= @$_GET['produto'] ?>&id=<?= @$_GET['id'] ?>&quant=<?= @$_GET['quant'] ?>&addCart=<?= @$_GET['id'] ?>">
           <?php
           ?>
            <div class="quantidade">
                <div data-app="product.quantity" id="quantidade">
                    <span id="span_erro_carrinho" class="blocoAlerta" style="display:none;">Selecione uma opção para variação do produto</span>
                    <label for="">Quantidade:</label>      
                    <input style="background: white;border: 0;font-size:35px;" type="button" id="plus" value='-' onclick="process(-1)" />
                    <input style="width: 50px; height: 50px;text-align: center;margin: 0 10px;" id="quant" name="quant" class="text" size="1" type="text" value="1" maxlength="5" />
                    <input style="background: white;border: 0;font-size:35px;margin-top:5px" type="button" id="minus" value='+' onclick="process(1)">
                    <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                    <input type="hidden" name="produto" value="<?= @$_GET['produto'] ?>">
                    <input type="hidden" name="addCart" value="<?= $_GET['id'] ?>">
                </div>
            </div>

            <div class="botao-car">
            <div class="wrap">
                <button class="button" name="acao" type="submit">Adicionar ao carrinho!</button>
                </div>
            </div>
           </form>
        </div>
        
            <?php }}?>
</div>



