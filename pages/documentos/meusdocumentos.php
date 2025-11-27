<?php
require_once '../../login/login.php';

if (!Store::isLogged()) {
    header("Location: ../../index.php");
    exit();
}

$usuario = Store::get('usuario');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALOCATEC</title>
    <link rel="stylesheet" href="meusdocumentos.css">
    <link rel="icon" href="img/logo.png">
    <link rel="shortcut icon" href="img/logo.png">
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
          <li><a href="../documentos/meusdocumentos.php">MEUS DOCUMENTOS</a></li>
      </ul>
    </nav>

<div class="user" data-usuario="<?= $usuario['id'] ?>"
     onclick="window.location.href='../perfil/perfil.php?usuario=<?= $usuario['id'] ?>'">
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
      <h2>Enviar Documentação</h2>

      <div class="upload-section">
        <label class="upload-label">Foto do Registro Geral (RG)</label>
        <div class="upload-box"><i></i></div>
      </div>

      <div class="upload-section">
        <label class="upload-label">Foto do Comprovante de Endereço</label>
        <div class="upload-box"><i></i></div>
      </div>

      <div class="upload-section">
        <label class="upload-label">Selfie com Registro Geral (RG)</label>
        <div class="upload-box oval-box"><i></i></div>
      </div>

      <button class="submit-button"><a href="Buscainformativo.php">Enviar Documentação</a></button>
    </div>
  </main>
</body>
</html>