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

        // PAGINAÇÃO
        $limite = 3;
        $onde_estou = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $linha_mysql = ($onde_estou - 1) * $limite;

        // Total de registros
        $total_query = "SELECT COUNT(*) AS total FROM reserva";
        $total_result = mysqli_query($conexao_servidor_bd, $total_query);
        $total_row = mysqli_fetch_assoc($total_result);
        $total_pag = ceil($total_row['total'] / $limite);
  

    
$sql_reserva = "
    SELECT 
        R.id_reserva,
        R.data,
        R.horario_inicio,
        R.horario_fim,
        R.status,
        U.nome_usu AS usuario,
        E.nome_est AS nome_est
    FROM reserva R
    INNER JOIN usuario U ON R.id_usuario = U.id_usuario
    INNER JOIN estabelecimento E ON R.id_estabelecimento = E.id_estabelecimento
    LIMIT $linha_mysql, $limite
";


        $result_reserva = mysqli_query($conexao_servidor_bd, $sql_reserva);
        $dados_reserva = mysqli_fetch_all($result_reserva, MYSQLI_ASSOC);

        if (!empty($dados_reserva)) {
            foreach ($dados_reserva as $reserva) {
                echo "
                <div class='solicitacao-card'>
                    <div class='topo-solicitacao'>
                        <div class='nome-espaco'>
                            <h2>" . htmlspecialchars($reserva['nome_est']) . "</h2>
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
                            <p>" . htmlspecialchars($reserva['horario_inicio']) . " - ". htmlspecialchars($reserva['horario_fim']) ."</p>
                        </div>

                        <button class='ver-mais-btn' 
                                onclick=\"window.location.href='../detalhes_solicitacao/solicitacao.php?id=" . htmlspecialchars($reserva['id_reserva']) . "';\">
                            Ver Mais
                        </button>
                    </div>
                </div>
                ";
            }
        } else {
            echo "
            <div class='erro'>
                <h2>Nenhuma solicitação encontrada</h2>
            </div>";
        }
        ?>

        <div class="pagination-dots">
            <?php for ($i = 1; $i <= $total_pag; $i++): ?>
                <a href="?page=<?php echo $i; ?>" 
                   class="dot <?= ($i == $onde_estou) ? 'active' : '' ?>">
                </a>
            <?php endfor; ?>
        </div>
    </div>

</body>
</html>