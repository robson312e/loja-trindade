<?php

    if(@$_GET["url"] == "" || @$_GET['url'] == 'home'  || @$_GET['url'] == 'cadastreSe' || $_GET['url'] == 'cadasEndereco' || $_GET['url'] == 'conteudos' || $_GET['url'] == 'contato') {
        echo'<footer style="position: relative;" class="rodape" id="contato">';
    }else if(@$_GET["url"] == "carrinho"){
        echo '<footer style="display:none" class="rodape" id="contato">';
    }else{
        echo '<footer class="rodape" id="contato">';
    }
?>

    <div class="rodape-div">

        <div class="rodape-div-1">
            <div class="rodape-div-1-coluna">
                <!-- elemento -->
                <span><b>TRINDADE MAGIA</b></span>
                <p>R. francisco de alvarenga, 566</p>
            </div>
        </div>

        <div class="rodape-div-2">
            <div class="rodape-div-2-coluna">
                <!-- elemento -->
                <span><b>Contatos</b></span>
                <p>magiatrindade@gmail.com</p>
                <p>+55 (14) 99100-0000</p>
            </div>
        </div>

        <div class="rodape-div-3">
            <div class="rodape-div-3-coluna">
                <!-- elemento -->
                <span><b>Links</b></span>
                <p><a href="<?= INCLUD_PATH ?>sobre">Sobre</a></p>
                <p><a href="<?= INCLUD_PATH ?>contato">contato</a></p>
            </div>
        </div>

        <div class="rodape-div-4">
            <div class="rodape-div-4-coluna">
                <!-- elemento -->
                <span><b>Outros</b></span>
                <p>Políticas de Privacidade</p>
            </div>
        </div>

    </div>
    <p class="rodape-direitos">Copyright © 2024 – Todos os Direitos Reservados.</p>
</footer>
<script src="<?= INCLUDE_PATH_FULL ?>js/script.js"></script>
<script src="<?= INCLUDE_PATH_FULL ?>js/conteudos.js"></script>
<script src="https://kit.fontawesome.com/c202815e81.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
</body>