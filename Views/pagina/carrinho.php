<h1>Carrinho de compras</h1>

<div class="table-responsive">
		<div class="row">
			<div style="width: 30%;" class="col">
				<span>Produto</span>
			</div><!--col-->
			<div class="col">
				<span>valor</span>
			</div><!--col-->
			<div class="col">
				<span>quantidade</span>
			</div><!--col-->
			<div class="col">
				<span>total</span>
			</div><!--col-->
			<div class="clear"></div>
		</div><!--row-->
		<?php
        if (!isset($_SESSION['carrinho']) || $_SESSION['carrinho'] == []) {
            echo '<h2>carrinho vazio</h2>';
        }
        if (isset($_SESSION['carrinho'])) {
            $itemsCarrinho = $_SESSION['carrinho'];
            $total = 0;
            foreach ($itemsCarrinho as $key => $value) {
                $idProduto = $key;
                $produto = \MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` WHERE id = $idProduto");
                $produto->execute();
                $produto = $produto->fetch();
                $valor = $value * $produto['valor'];
                $total += $valor;

                ?>
        <div class="row">
		<div class="descri">
			<div class="col">
			<?php
                    $imagem = \MySql::conectar()->prepare('SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = ?');
                $imagem->execute([$idProduto]);
                $imagem = $imagem->fetch();

                ?>
            <img src="<?php echo INCLUDE_PATH_PAINEL; ?>uploads/<?php echo $imagem['imagem']; ?>" alt="">
			
				</div><!--col-->
				<div id="col" class="col">
					<span><?php echo $produto['nome']; ?> personalizado</span>
				</div>
				<div id="col" class="col">
					<span>R$ <?php echo number_format((int) $produto['valor'], 2, ',', '.'); ?></span>
				</div><!--col-->
				<div id="col" style="display: inline-flex;" class="col">
						<a href="<?php echo INCLUD_PATH; ?>carrinho?produto=<?php echo @$_GET['produto']; ?>&id=<?php echo @$_GET['id']; ?>&del=<?php echo $produto['id']; ?>" >-</a>
							<span id="produto" class="entry value"><?php if ($value == 0) {
							    Painel::redirect(INCLUD_PATH.'carrinho?deletar='.$key.'&addCart='.$key);
							} else {
							    echo $value;
							} ?></span> 
						<a href="<?php echo INCLUD_PATH; ?>carrinho?produto=<?php echo @$_GET['produto']; ?>&id=<?php echo @$_GET['id']; ?>&addCart=<?php echo $produto['id']; ?>">+</a>
				</div><!--col-->
				<div id="col" class="col">
					<span>R$ <?php echo number_format((int) $valor, 2, ',', '.'); ?></span>
				</div><!--col-->
				<div id="col" class="col">
				<?php // $id = $_GET['addCart'];?>
					<form  method="get">
						<a href="<?php echo INCLUD_PATH; ?>carrinho?deletar=<?php echo $key; ?>&addCart=<?php echo $key; ?>"> Excluir </a> 
						
					</form>
				</div><!--col-->
			</div>
			<div class="clear"></div>
		</div><!--row-->
		<?php }
            }?>
		<div class="finalizar-pedido">
			<div class="container">
			<p>Total: <h2>R$ <?php echo number_format((int) @$total, 2, ',', '.'); ?></h2></p>
				<div class="clear"></div>
        
			<a href="" class="btn-pagamento">Pagar Agora!</a>
			</div>
		</div><!--finalizar-pedido-->
</div>
	<div class="contiCompra">
		<a href="">Continua comprando</a>
	</div>


	<div class="finalizar-pedido">
		<div class="container">
			<div class="clear"></div>
			<div class="clear"></div>
		</div>
	</div><!--finalizar-pedido-->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>
<script>
  $(function(){
	

	$('a.btn-pagamento').click(function(e){
		e.preventDefault();
		$.ajax({
			url: 'http://localhost/loja_virtual/ajax/finalizarPagamento.php'
		}).done(function(data){
				
				console.log(data)
				
				var isOpenLightBox = PagSeguroLightbox({
					code:data
				},{
					success: function(transactionCode){
						location.href=include_path;
					},
					abort:function(){
						location.href=include_path;
					}
				});

				console.log(isOpenLightBox);
				
		})

		
	})
	
})
</script>