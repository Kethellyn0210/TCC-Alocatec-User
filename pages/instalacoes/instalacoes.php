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
    <link rel="stylesheet" href="instalacoes.css">
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
    <div class="user-info">
        <p class="nome"><?= htmlspecialchars($usuario['nome_usu']) ?></p>
        <p class="cargo"><?= htmlspecialchars($usuario['email']) ?></p>
    </div>

    <a href="../../login/logout.php" class="logout">SAIR</a>
</div>
    </aside>

    <div class="content">
    <div class="page">
      <h1>Busca por Esportes</h1>
      <p>Busque por seu esporte favorito.</p>
    </div>

        <div class="page">
            <h2>Esportes</h2>
        </div>
<script>
document.querySelectorAll(".card").forEach(card => {
    card.addEventListener("click", function () {
        let esporte = this.dataset.esporte;
        window.location.href = "../instalacao_part2/instalacoes.php?tipo_espaco=" + encodeURIComponent(esporte);
    });
});
</script>

        <div class="grid">
    <div class="card" onclick="window.location.href='../instalacao_part2/instalacoes.php?tipo_espaco=[Futebol]'" data-esporte="<?= htmlspecialchars($futebol) ?>">
        <img src="img/futsal.jpg">
        <div class="card-title">FUTEBOL</div>
    </div>

    <div class="card" onclick="window.location.href='../instalacao_part2/instalacoes.php?tipo_espaco=[Vôlei]'" data-esporte="<?= htmlspecialchars($volei) ?>">
        <img src="img/volei.jpg">
        <div class="card-title">VÔLEI</div>
    </div>

    <div class="card" onclick="window.location.href='../instalacao_part2/instalacoes.php?tipo_espaco=[Basquete]'" data-esporte="<?= htmlspecialchars($basquete) ?>">
        <img src="img/futebol.jpg">
        <div class="card-title">BASQUETE</div>
    </div>
</div>

<div class="grid">
    <div class="card" onclick="window.location.href='../instalacao_part2/instalacoes.php?tipo_espaco=[Piscina]'" data-esporte="<?= htmlspecialchars($piscina) ?>">
        <img src="img/piscina.jpg">
        <div class="card-title">PISCINAS</div>
    </div>

    <div class="card" onclick="window.location.href='../instalacao_part2/instalacoes.php?tipo_espaco=[Poliesportivo]'" data-esporte="<?= htmlspecialchars($poliesportivo) ?>">
        <img src="img/areia.jpg">
        <div class="card-title">POLIESPORTIVO</div>
    </div>

    <div class="card" onclick="window.location.href='../instalacao_part2/instalacoes.php?tipo_espaco=[Outros]'" data-esporte="<?= htmlspecialchars($outros) ?>">
        <img src="img/handbol.jpg">
        <div class="card-title">OUTROS</div>
    </div>
</div>
    </div>
</body>
</html>
