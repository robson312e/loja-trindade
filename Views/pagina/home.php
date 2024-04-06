
<div class="slider-todo">
    <div class="slider" style="background-image: url('<?php echo INCLUDE_PATH_FULL; ?>img/loja-online.png');"></div>
    <div class="slider" style="background-image: url('<?php echo INCLUDE_PATH_FULL; ?>img/azuleijo-personalizados.png');"></div>
    <div class="slider" style="background-image: url('<?php echo INCLUDE_PATH_FULL; ?>img/illegenix.png');"></div>
</div>

<div class="pecas-totais">
    <?php for( $i = 0; $i < 10; $i++ ) { ?>
    <div class="pecas">
        <img src="<?= INCLUDE_PATH_FULL ?>img/coposs2.jpg" alt="">
        <p>copo canudo canudo canudo</p>
        <select name="" id="">
            <option value="">Tamanho</option>
            <option value="">P</option>
            <option value="">G</option>
        </select>
        <br>
        <input type="submit" value="Peça já!">
    </div>
    <?php } ?>
</div>

