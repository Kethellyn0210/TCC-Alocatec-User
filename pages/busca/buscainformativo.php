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
                <li><a href="../home/home.php">INÍCIO</a></li>
                <li><a href="../solicitacoes/solicitacoes.php">MINHAS SOLICITAÇÕES</a></li>
                <li><a href="../instalacoes/instalacoes.php">INSTALAÇÕES</a></li>
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
            <h1>Busca por Esportes</h1>
            <p>Busque por seu esporte favorito.</p>
        </div>

        <div class="pesquisa">
            <img src="img/lupa.png">
            <input type="text" placeholder="Pesquise Nome do Esporte">
        </div>

        <div class="page">
            <h2>Instalações</h2>
        </div>

        <?php
        require_once '../../database/conexao_bd_mysql.php';

        $limite = 3;
        $onde_estou = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $linha_mysql = ($onde_estou - 1) * $limite;

        $tipo_espaco = isset($_GET['tipo_espaco']) ? $_GET['tipo_espaco'] : null;

        if ($tipo_espaco) {
            $total_query = "SELECT COUNT(*) AS total FROM estabelecimento WHERE tipo = '" . mysqli_real_escape_string($conexao_servidor_bd, $tipo_espaco) . "'";
        } else {
            $total_query = "SELECT COUNT(*) AS total FROM estabelecimento";
        }

        $total_result = mysqli_query($conexao_servidor_bd, $total_query);
        $total_row = mysqli_fetch_assoc($total_result);
        $total = $total_row['total'];
        $total_pag = ceil($total / $limite);

        if ($tipo_espaco) {
            $sql = "SELECT DISTINCT id_estabelecimento, nome, endereco, numero, bairro, cidade, uf, tipo
                    FROM estabelecimento
                    WHERE tipo = '$tipo_espaco'
                    LIMIT $linha_mysql, $limite";
        } else {
            $sql = "SELECT id_estabelecimento, nome, endereco, numero, bairro, cidade, uf, tipo
                    FROM estabelecimento
                    LIMIT $linha_mysql, $limite";
        }

        $instalacao = mysqli_query($conexao_servidor_bd, $sql);

        if ($instalacao && mysqli_num_rows($instalacao) > 0) {
            while ($value = mysqli_fetch_assoc($instalacao)) {
                $tipo_espaco = htmlspecialchars($value['tipo'] ?? 'Não informado');

                echo "
                <div class='solicitacao-card' data-esporte='$tipo_espaco' onclick=\"window.location.href='../detalhes_solicitacao/solicitacao.php?tipo_espaco=$tipo_espaco'\">
                    <div class='conteudo-lateral'>
                        <div class='topo-solicitacao'>
                            <div class='nome-espaco'>
                                <h2>" . htmlspecialchars($value['nome']) . "</h2>
                            </div>
                        </div>

                        <div class='detalhes-solicitacao'>
                            <div class='detalhe'>
                                <h3>Endereço:</h3>
                                <p>" . htmlspecialchars($value['endereco']) . ", " . htmlspecialchars($value['numero']) . " - " . htmlspecialchars($value['bairro']) . ", " . htmlspecialchars($value['cidade']) . " - " . htmlspecialchars($value['uf']) . "</p>
                            </div>

                            <div class='detalhe'>
                                <h3>Tipo:</h3>
                                <p>" . htmlspecialchars($value['tipo'] ?? 'Não informado') . "</p>
                            </div>
                        </div>

                        <button class='ver-detalhes'>Ver Detalhes</button>
                    </div>

                    <div class='img-container'>
                        <div class='img-wrap'>
                            <img src='img/img.webp'>
                        </div>
                    </div>
                </div>
                ";
            }
        } else {
            echo "<div class='erro'><h2>Nenhuma instalação encontrada</h2></div>";
        }
        ?>

        <div class="pagination-dots">
            <?php for ($i = 1; $i <= $total_pag; $i++): ?>
                <?php
                $class = ($i == $onde_estou) ? 'active' : '';
                $extra = $tipo_espaco ? "&tipo_espaco=$tipo_espaco" : "";
                ?>
                <a href="?page=<?= $i . $extra ?>" class="dot <?= $class ?>"></a>
            <?php endfor; ?>
        </div>
    </div>
</body>
</html>
