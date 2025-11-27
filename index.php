<?php
require_once './database/conexao_bd_mysql.php';
require_once './login/login.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!empty($_POST['email']) && !empty($_POST['senha'])) {
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);

    $sql = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
    $result = mysqli_query($conexao_servidor_bd, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
      $dados = mysqli_fetch_assoc($result);

      Store::set('usuario', [
        'id' => $dados['id_usario'],
        'nome_usu' => $dados['nome_usu'],
        'email' => $dados['email']
      ]);

      header("Location: ./pages/instalacao/instalacao.php");
      exit();
    } else {
      echo "<script>alert('Usuário ou senha incorretos!');</script>";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ALOCATEC - Login</title>
  <link rel="stylesheet" href="./index.css">
  <link rel="icon" href="./img/logo.png">
  <link rel="shortcut icon" href="./img/logo.png">
</head>
<body>

<div class="container">

    <aside class="left-panel">

        <div class="logo">
            <img src="./img/logo.png" alt="Logo">
        </div>
            <h2>ALOCATEC</h2>
            <hr></hr>

        <form class="form-box" method="POST" action="">
            <label for="email" class="rotulo">Email</label>
            <input type="text" id="email" name="email" class="input" placeholder="Digite seu email" required>

            <label for="senha" class="rotulo">Senha</label>
            <input type="password" id="senha" name="senha" class="input" placeholder="Digite sua senha" required>

            <a class="cadastro" href="./pages/cadastro/cadastro.php">Cadastre-se</a>

            <button class="btn-enter">  
                <a  class="link" href="./pages/instalacoes/instalacoes.php">ENTRAR</a>
            </button>

            <a href="#" class="recupere-senha">Esqueceu sua senha?</a>
        </form>

        <div class="divider">
            <span></span>
            <p>OU</p>
            <span></span>
        </div>

        <div class="social-icons">
            <img src="./img/facebook.png" alt="Facebook">
            <img src="./img/google.png" alt="Google">
            <img src="./img/instagram.png" alt="Instagram">
        </div>

    </aside>

    <section class="right-panel">
        <img src="./img/foto_login.jpg" alt="" class="foto_login">
    </section>
</div>
</body>
</html>