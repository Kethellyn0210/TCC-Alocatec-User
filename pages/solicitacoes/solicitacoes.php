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
  <title>ALOCATEC - Solicitações</title>
  <link rel="stylesheet" href="solicitacoes.css">
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
  <div class="content">
    <div class="page">
      <h1>Minhas Solicitações</h1>
      <p>Lista de todas as solicitações de reserva.</p>
    </div>
    <div class="filters">
      <div class="search">
        <img src="./img/lupa.png" alt="Buscar">
        <input placeholder="Verificar Instalações"/>
      </div>
      
      <div class="chip">
        <select>
          <option>Status</option>
          <option>Pendente</option>
          <option>Autorizado</option>
          <option>Recusado</option>
        </select>
      </div>
    </div>
    
    <?php 
    require_once '../../database/conexao_bd_mysql.php'; 

    $limite = 3;

    $onde_estou = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

    $linha_mysql = ($onde_estou - 1) * $limite;
    $total_query = "SELECT COUNT(*) AS total FROM reserva";
    $total_result = mysqli_query($conexao_servidor_bd, $total_query);
    $total_row = mysqli_fetch_assoc($total_result);
    $total = $total_row['total'];
    $total_pag = ceil($total / $limite);

      $sql = "
        SELECT 
            R.id_reserva,
            R.data,
            R.horario,
            R.status,
            U.nome AS usuario,
            E.tipo AS espaco
        FROM reserva R
        INNER JOIN usuario U ON R.id_usuario = U.id_usuario
        INNER JOIN espaco E ON R.id_espaco = E.id_espaco
        LIMIT 3
      ";

      $reservas = mysqli_query($conexao_servidor_bd, $sql);

      if ($reservas && mysqli_num_rows($reservas) > 0) {
          while ($reserva = mysqli_fetch_assoc($reservas)) {
              echo "
              <div class='solicitacao-card'>
                <div class='topo-solicitacao'>
                  <div class='nome-espaco'>
                    <h2>" . htmlspecialchars($reserva['espaco']) . "</h2>
                  </div>
                  <div class='status-solicitacao " . htmlspecialchars($reserva['status']) . "'>
                    <h2>" . htmlspecialchars($reserva['status']) . "</h2>
                  </div>
                </div>
                <div class='detalhes-solicitacao'>
                  <div class='detalhe'>
                    <h3>Data:</h3>
                    <p>" . htmlspecialchars($reserva['data']) . "</p>
                  </div>
                  <div class='detalhe'>
                    <h3>Horário:</h3>
                    <p>" . htmlspecialchars($reserva['horario']) . "</p>
                  </div>
                </div>
              </div>
              ";
          }
      } else {
          echo "<div class='erro'>
        <h2>Nenhuma solicitação encontrada</h2>
      </div>";
      }
    ?>

    <div class="pagination-dots">
    <?php for ($i = 1; $i <= $total_pag; $i++): ?>
        <?php $class = ($i == $onde_estou) ? 'active' : ''; ?>
        <a href="?page=<?php echo $i; ?>" class="dot <?php echo $class; ?>"></a>
    <?php endfor; ?>
    </div>
  </div>
</body>
</html>