<?php
session_start();

// Conexão com o banco
require_once "../../database/conexao_bd_mysql.php";
require_once "../../login/login.php";

// Verifica login
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../index.php");
    exit();
}

// Dados do usuário logado
$usuario = $_SESSION['usuario'];

if (!is_array($usuario)) {
    die("Erro interno: dados do usuário inválidos.");
}

$id_usuario = $usuario['id'];

// Busca documentos do usuário
$sql = "SELECT * FROM documentos WHERE id_usuario = '$id_usuario'";

$result = mysqli_query($conn, $sql);

$doc = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALOCATEC</title>
    <link rel="stylesheet" href="meusdocumentos.css">
    <link rel="icon" href="img/logo.png">

<style>
.resultado-Sucesso,
.resultado-Erro {
    width: 100%;
    max-width: 1200px;
    margin: 10px auto;
    margin-bottom: 40px;
    padding: 20px 15px;
    border-radius: 10px;
    font-size: 15px;
    box-shadow: 0px 2px 6px rgba(0,0,0,0.1);
}

/* SUCESSO */
.resultado-Sucesso {
    background-color: #e6ffee;
    border-left: 6px solid #00c853;
    color: #007a33;
    font-size: 1rem;
    font-weight: 600;
}

/* ERRO */
.resultado-Erro {
    background-color: #ecc1c1ff;
    border-left: 6px solid #e53935;
    color: #b71c1c;
    font-size: 1rem;
    font-weight: 600;
}
</style>
</head>
<body>

    <aside class="sidebar">
        <div class="logo">
            <div class="icone-logo">
                <img src="./img/logo.png" alt="Logo ALOCATEC">
            </div>
            <h2>ALOCATEC</h2>
            <br>
            <hr>
        </div>

        <nav>
            <ul>
                <li><a href="../instalacoes/instalacoes.php">INSTALAÇÕES</a></li>
                <li><a href="../solicitacoes/solicitacoes.php">MINHAS SOLICITAÇÕES</a></li>
                <li><a href="../documentos/meusdocumentos.php" class="active">MEUS DOCUMENTOS</a></li>
            </ul>
        </nav>

        <div class="user">
            <div class="avatar"></div>
            <div class="user-info">
                <p class="nome"><?= htmlspecialchars($usuario['nome_usu']) ?></p>
                <p class="cargo"><?= htmlspecialchars($usuario['email']) ?></p>
            </div>
            <a href="../../login/logout.php" class="logout">SAIR</a>
        </div>
    </aside>

    <main class="main-content">
        <div class="documentos">

            
            <!-- MENSAGENS DE ERRO OU SUCESSO -->
            <?php if (isset($_SESSION['upload_sucesso'])): ?>
                <div class="resultado-Sucesso">
                    <?= $_SESSION['upload_sucesso'] ?>
                </div>
                <?php unset($_SESSION['upload_sucesso']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['erro_upload'])): ?>
                <div class="resultado-Erro">
                    <?php foreach ($_SESSION['erro_upload'] as $erro): ?>
                        <p><?= $erro ?></p>
                    <?php endforeach; ?>
                </div>
                <?php unset($_SESSION['erro_upload']); ?>
            <?php endif; ?>

            <h2>Enviar Documentação</h2>

            <form action="upload_documentos.php" method="POST" enctype="multipart/form-data">

                <!-- RG -->
                <div class="upload-section">
                    <label class="upload-label">Foto do Registro Geral (RG)</label>
                    <div class="upload-box">
                        <input type="file" name="rg_foto" id="rg_foto" hidden>
                        <label for="rg_foto" class="btn-upload">Clique aqui para selecionar um arquivo</label>
                        <p class="nome-arquivo" id="nome-rg"></p>
                    </div>
                </div>

                <!-- Comprovante de Endereço -->
                <div class="upload-section">
                    <label class="upload-label">Foto do Comprovante de Endereço</label>
                    <div class="upload-box">
                        <input type="file" name="endereco_foto" id="endereco_foto" hidden>
                        <label for="endereco_foto" class="btn-upload">Clique aqui para selecionar um arquivo</label>
                        <p class="nome-arquivo" id="nome-endereco"></p>
                    </div>
                </div>

                <!-- Selfie com RG -->
                <div class="upload-section">
                    <label class="upload-label">Selfie com RG</label>
                    <div class="upload-box oval-box">
                        <input type="file" name="selfie_rg" id="selfie_rg" hidden>
                        <label for="selfie_rg" class="btn-upload-circle">Selfie com RG</label>
                    </div>
                </div>

                <button class="submit-button" name="enviar" type="submit">
                    Enviar Documentação
                </button>

            </form>
        </div>
    </main>
</body>
</html>
