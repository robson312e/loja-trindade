<?php

// Incluir o arquivo com conexão ao banco de dados
include_once 'conexao.php';

// Verificar se está criada a sessão para controlar as etapas
if (!isset($_SESSION['etapa'])) {
    // Criar a sessão para armazenar a etapa
    $_SESSION['etapa'] = 1;
}
?>
<div style="background-image: url('<?php echo INCLUDE_PATH_FULL; ?>img/background_cadas.png');" class="cadastro">
        <div class="box">
            <div class="img-box">
                <img src="<?php echo INCLUDE_PATH_FULL; ?>img/img-formulario.png">
            </div>
            <div class="form-box">
                <h2>Criar Conta</h2>
                <p> Já é um membro? <a href="<?php echo INCLUD_PATH; ?>login"> Login </a> </p>
             
                <div class="form-container">
        <?php

        // Criar a variável para receber as mensagens de erro ou sucesso
        $mensagem = '';

// Receber os dados do formulário
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

// Verificar se o usuário clicou no botão novo usuário
if (isset($dados['novoUsuario'])) {
    // Atribuir a etapa um para cadastrar novo usuário
    $_SESSION['etapa'] = 1;
}

/************* SALVAR OS DADOS DO USUÁRIO ***************/
include_once 'cadastrar_usuario.php';

/************* SALVAR OS DADOS DA EMPRESA ***************/

/************* SALVAR OS DADOS DO ENDEREÇO ***************/
include_once 'cadastrar_endereco.php';

// Incluir o arquivo com as etapas
include_once 'etapas.php';

?>
        <div class="content">
            <?php

    // Imprimir as mensagens de erro ou sucesso
    echo $mensagem;
$mensagem = '';

// Verificar se deve carregar o formulário da etapa 1
if ($_SESSION['etapa'] == 1) {
    // Incluir o arquivo com o formulário cadastrar usuário
    include_once 'formulario_cadastrar_usuario.php';
} elseif ($_SESSION['etapa'] == 2) {  // Verificar se deve carregar o formulário da etapa 2
    // Incluir o arquivo com o formulário cadastrar endereço
    include_once 'formulario_cadastrar_endereco.php';
} elseif ($_SESSION['etapa'] == 3) {  // Verificar se deve carregar o formulário da etapa 3
    // Incluir o arquivo com o formulário cadastrar empresa
    include_once 'formulario_cadastrar_imagem.php';
}
?>
        </div>
    </div>
            </div>
        </div>
</div>
<script>


    const input = document.querySelector("input[type=file]");
    const preview = document.querySelector(".preview");

    input.style.opacity = 0;
    input.addEventListener("change", updateImageDisplay);

    function updateImageDisplay() {
    while (preview.firstChild) {
        preview.removeChild(preview.firstChild);
    }

    const curFiles = input.files;
    if (curFiles.length === 0) {
        const para = document.createElement("p");
        para.textContent = "No files currently selected for upload";
        preview.appendChild(para);
    } else {
        const list = document.createElement("ol");
        preview.appendChild(list);

        for (const file of curFiles) {
        const listItem = document.createElement("li");
        const para = document.createElement("p");
        if (validFileType(file)) {
          
            const image = document.createElement("img");
            image.src = URL.createObjectURL(file);
            image.alt = image.title = file.name;

            listItem.appendChild(image);
            listItem.appendChild(para);
        } else {
            para.textContent = `File name ${file.name}: Not a valid file type. Update your selection.`;
            listItem.appendChild(para);
        }

        list.appendChild(listItem);
        }
    }
    }

    const fileTypes = [
    "image/apng",
    "image/bmp",
    "image/gif",
    "image/jpeg",
    "image/pjpeg",
    "image/png",
    "image/svg+xml",
    "image/tiff",
    "image/webp",
    "image/x-icon",
    ];

    function validFileType(file) {
    return fileTypes.includes(file.type);
    }

    function returnFileSize(number) {
        console.log(number)
        if (number < 1024) {
            return `${number} bytes`;
        } else if (number >= 1024 && number < 1048576) {
            return `${(number / 1024).toFixed(1)} KB`;
        } else if (number >= 1048576) {
            return `${(number / 1048576).toFixed(1)} MB`;
        }
    }
</script>