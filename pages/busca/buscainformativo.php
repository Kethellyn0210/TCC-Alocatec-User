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
    <link rel="stylesheet" href="buscainformativo.css">
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

        <div class="user">
            <div class="avatar"></div>
            <div class="user-info">
                <p class="nome"><?= htmlspecialchars($usuario['nome']) ?></p>
                <p class="cargo"><?= htmlspecialchars($usuario['email']) ?></p>
            </div>
            <a href="../../login/logout.php" class="logout">SAIR</a>
        </div>
    </aside>

  <main class="main-content">
    <div class="conteudo-central">
<?php

require_once '../../database/conexao_bd_mysql.php';

if (!isset($_GET['id'])) {
    die("Estabelecimento não especificado.");
}

$id_estabelecimento = intval($_GET['id']);

$sql = "SELECT 
    e.nome_est,
    s.cobertura,
    s.largura,
    s.comprimento,
    s.descricao_adicional
FROM espaco s
INNER JOIN estabelecimento e ON s.id_estabelecimento = e.id_estabelecimento
WHERE s.id_estabelecimento = $id_estabelecimento;
";

$reservas = mysqli_query($conexao_servidor_bd, $sql);

// Buscar o registro
$value = mysqli_fetch_assoc($reservas);

// Verificar se encontrou algo
if (!$value) {
    die("Nenhum espaço encontrado.");
}

echo "
<h1 class='titulo-principal'>" . htmlspecialchars($value['nome_est']) . "</h1>

<div class='container-fotos'>
  <img class='quadro-maior' src='img/quadra.png' alt='foto1'>
  <img class='quadro-medio' src='img/quadra.png' alt='foto2'>
  <img class='quadro-pequeno' src='img/quadra.png' alt='foto3'>
  <img class='quadro-pequeno' src='img/quadra.png' alt='foto4'> 
</div>

<button class='mostrar-fotos'>Mostrar todas as fotos</button> 

<div class='descricao'>
  <p><strong>Quadra com cobertura</strong></p>
  <p>" . htmlspecialchars($value['cobertura']) . "</p><br>
  <p>Tamanho: " . htmlspecialchars($value['largura']) . "m x " . htmlspecialchars($value['comprimento']) . "m</p>

  <h3>Informações adicionais sobre o espaço</h3>
  <p>" . htmlspecialchars($value['descricao_adicional']) . "</p>
</div>
";
?>


      <div class="box">
        <form class="reserva">
          <h3>Reserve agora</h3>
          <label>Data Escolhida</label>
          <input type="date" />
          <label>Hora Entrada</label>
          <input type="time" />
          <label>Hora Saída</label>
          <input type="time" />
          <button type="submit">RESERVE AGORA</button>
        </form>
      </div>

    </div> 
  </main>
</body>
</html>