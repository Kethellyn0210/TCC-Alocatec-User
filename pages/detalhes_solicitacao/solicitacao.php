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
    <link rel="stylesheet" href="solicitacao.css">
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

     <main class="content">
       <div class="page-title">
      <div class="titulo-pagina">
        <h1>Solicitação</h1>
    </div>
  <div class="acoes-topo">
  <button class="botao-acao voltar" onclick="window.location.href='../instalacoes/instalacoes.php'">
    <img src="./img/voltar.png">
    <span>VOLTAR</span>
  </button>
</div>
</div>
<div class="card-content">
    <div class="card-1">
        <div class="card-detalhe">
          <div class="info">
            <div class="title-card">
                <h4>Data Escolhida</h4>
            </div>
            <div class="info">
                <p>20 de Setembro</p>
            </div>

            <div class="title-card">
                <h4>Hora de Entrada/Saída</h4>
            </div>
            <div class="info">
                <p>14:00 hrs - 15:00</p>
            </div>
            
            <div class="title-card">
                <h4>Quantidade de Participantes</h4>
            </div>
            <div class="info">
                <p>10 Participantes</p>
            </div>
          </div>
        </div>
      </div>
        <div class="card-2">
            <div class="card-detalhe">
          <div class="title-card">Localização</div>

          <img src="img/img.webp" class="img">
            </div>
        <div class="card-detalhe">
        <div class="title-card">
            <h4>INSTITUIÇÃO DE TATUÍ</h4>
        </div>
        <div class="info">
             <p>São Paulo</p>
             <p>CEP: 09865600</p>
            <p>Rua do Falcão, nº36</p>
            <p>Jardim das Nações</p>
        </div>
        </div>
          </div>
      </div>
    </div>
  </div>
    <div class="page-title">
      <div class="titulo-pagina">
        <h1>Solicitação Status</h1>
      </div>
    </div>
    <div class="card">
      <div class="card-detalhe">
        <div class="title-card">
            <h4>Data do Agendamento</h4>
        </div>
        <div class="info">
            <p>13 de Setembro</p>
        </div>
            <br>
        <div class="title-card">
            <h4>Data e Hora da Solicitação</h4>
        </div>
        <div class="info">
            <p>Segunda-feira às 15:32:15</p>
        </div>
      </div>
      <div class="card-info">
        <div class="status-box">Aprovado</div>

          <div class="admin-info">
            <img src="https://cdn-icons-png.flaticon.com/512/4333/4333609.png">
            <div class="info">
              Administrador: José Alberto
            </div>
          </div>
</div>
        </div>
      </div>
    </div>
  </main>
</body>
</html>