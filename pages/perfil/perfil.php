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
    <link rel="stylesheet" href="perfil.css">
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

  <div class="content-wrapper">
    <div class="profile-container">

      <div class="warning">
        <span>Verificação Pendente</span>
        <button class="inline-btn">Enviar documentos</button>
      </div>

      <div class="section-title">Dados Pessoais</div>

      <div class="box">
      <div class="form-group">
        <label>Nome do Usuário</label>
        <input type="text" />
      </div>

      <div class="form-group">
        <label>CPF</label>
        <input type="text" />
      </div>

      <div class="form-group">
        <label>Data de Nascimento</label>
        <input type="date" />
      </div>

      <div class="form-group">
        <label>Telefone</label>
        <input type="text" />
      </div>
      </div>

      <div class="section-title">Localização Pessoal</div>

      <div class="box">
      <div class="form-group">
        <label>Estado</label>
        <input type="text" />
      </div>

      <div class="form-group">
        <label>Cidade</label>
        <input type="text" />
      </div>

      <div class="form-group">
        <label>CEP</label>
        <input type="text" />
      </div>

      <div class="form-group">
        <label>Endereço</label>
        <input type="text" />
      </div>
      </div>

      <div class="section-title">Dados de Acesso a Conta:</div>

      <div class= "box">
      <div class="form-group">
        <label>E-mail</label>
        <input type="text" />
      </div>

      <div class="form-group">
        <label>Senha</label>
        <input type="text"/>
      </div>

      <div class="actions">
        <button class="alterar-senha">Alterar</button>
      </div>
      </div>

      <div class="actions">
        <button class="save-btn"><a  class="link "href="./meusdocumentos.php">Salvar</a></button>
        <button class="cancel-btn">Cancelar</button>
      </div>

    </div>
  </div>
</body>
</html>
