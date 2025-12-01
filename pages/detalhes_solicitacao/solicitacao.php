<?php
require_once '../../login/login.php';
require_once '../../database/conexao_bd_mysql.php';

if (!Store::isLogged()) {
    header("Location: ../../index.php");
    exit();
}

$usuario = Store::get('usuario');

// ID da reserva vindo pela URL
$id_reserva = isset($_GET['id']) ? intval($_GET['id']) : 0;

// SQL UNIFICADO
$sql = "
SELECT 
    R.id_reserva,
    R.data,
    R.horario_inicio,
    R.horario_fim,
    R.status,
    R.capacidade,
    R.motivo_recusa,

    U.nome_usu AS nome_usuario,
    U.email AS email_usuario,

    A.nome_adm AS nome_administrador,

    E.nome_est,
    E.endereco,
    E.numero,
    E.bairro,
    E.cidade,
    E.cep,
    E.uf,

    S.cobertura,
    S.largura,
    S.comprimento,
    S.localidade

FROM reserva R
INNER JOIN usuario U ON U.id_usuario = R.id_usuario
INNER JOIN administrador A ON A.id_administrador = R.id_administrador
INNER JOIN estabelecimento E ON E.id_estabelecimento = R.id_estabelecimento
INNER JOIN espaco S ON S.id_espaco = R.id_espaco

WHERE R.id_reserva = $id_reserva
";

$result = mysqli_query($conexao_servidor_bd, $sql);



if (!$result) {
    die("Erro ao buscar os dados: " . mysqli_error($conexao_servidor_bd));
}

$info = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitação</title>
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

    <main class="content">

        <!-- TÍTULO + BOTÃO VOLTAR -->
        <div class="page-title">
            <div class="titulo-pagina">
                <h1>Solicitação</h1>
            </div>
            <div class="acoes-topo">
                <button class="botao-acao voltar" onclick="window.location.href='../solicitacoes/solicitacoes.php'">
                    <img src="./img/voltar.png">
                    <span>VOLTAR</span>
                </button>
            </div>
        </div>

        <!-- PRIMEIRO BLOCO DE CARDS -->
        <div class="card-content">

            <!-- CARD 1 – INFORMAÇÕES DA RESERVA -->
            <div class="card-1">
                <div class="card-detalhe">

                    <div class="title-card">
                        <h4>Data Escolhida</h4>
                    </div>
                    <div class="info">
                        <p><?= date("d/m/Y", strtotime($info['data'])) ?></p>
                    </div>

                    <div class="title-card">
                        <h4>Hora de Entrada/Saída</h4>
                    </div>
                    <div class="info">
                        <p><?= $info['horario_inicio'] . " - " . $info['horario_fim'] ?></p>
                    </div>

                    <div class="title-card">
                        <h4>Quantidade de Participantes</h4>
                    </div>
                    <div class="info">
                        <p><?= htmlspecialchars($info['capacidade']) ?> Participantes</p>
                    </div>

                </div>
            </div>

            <!-- CARD 2 – LOCALIZAÇÃO -->
            <div class="card-2">
                <div class="card-detalhe">
                    <div class="title-card">Localização</div>

                    <img src="img/volei.jpg" class="img">
                </div>

                <div class="card-detalhe">
                    <div class="title-card">
                        <h4><?= htmlspecialchars($info['nome_est']) ?></h4>
                    </div>

                    <div class="info">
                        <p><?= htmlspecialchars($info['cidade']) ?> - <?= htmlspecialchars($info['uf']) ?></p>
                        <p>CEP: <?= htmlspecialchars($info['cep']) ?></p>
                        <p><?= htmlspecialchars($info['endereco']) ?>, nº <?= htmlspecialchars($info['numero']) ?></p>
                        <p><?= htmlspecialchars($info['bairro']) ?></p>
                    </div>
                </div>
            </div>

        </div>

        <!-- SEGUNDO BLOCO — STATUS -->
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
                    <p><?= date("d/m/Y", strtotime($info['data'])) ?></p>
                </div>

                <br>

                <div class="title-card">
                    <h4>Data e Hora da Solicitação</h4>
                </div>
                <div class="info">
                    <p><?= date("d/m/Y \à\s H:i:s") ?></p>
                </div>

            </div>

            <div class="card-info">
                <div class="status-box <?= htmlspecialchars($info['status']) ?>">
                    <?= ucfirst($info['status']) ?>
                </div>

                <?php
                $motivos = [
                    1 => "Quantidade de pessoa ultrapassa limite",
                    2 => "Foto de RG ilegível",
                    3 => "Foto de Endereço ilegível",
                    4 => "Foto de Selfie com RG distorcida",
                    5 => "Falta de todos os Documentos",
                    6 => "Outros"
                ];

                if ($info['status'] === 'cancelada' && isset($motivos[$info['motivo_recusa']])) {
                    echo "
        <div class='motivo-recusa'>
            Motivo da recusa: <strong>" . $motivos[$info['motivo_recusa']] . "</strong>
        </div>";
                }
                ?>

                <div class="admin-info">
                    <img src="https://cdn-icons-png.flaticon.com/512/4333/4333609.png">
                    <div class="info">
                        Administrador: <?= htmlspecialchars($info['nome_administrador']) ?>
                    </div>
                </div>
            </div>

        </div>

    </main>

</body>

</html>