<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastro - ALOCATEC</title>
    <link rel="stylesheet" href="cadastro.css" />
    <link rel="icon" href="img/logo.png">
    <link rel="shortcut icon" href="img/logo.png">
    <style>
.resuldado-Sucesso, .resuldado-Erro {
  width: 100%;
  max-width: 900px;
  margin: 10px auto;
  padding: 20px 10px;
  border-radius: 10px;
  font-size: 15px;
}

.resuldado-Sucesso {
  background-color: #e6ffee;
  border-left: 6px solid #00c853;
  color: #007a33;
  font-size: 1rem;
  font-weight: 600;
}

.resuldado-Erro {
  background-color: #ffeaea;
  border-left: 6px solid #e53935;
  color: #b71c1c;
  font-size: 1rem;
  font-weight: 600;
}
</style>

</head>
<body>

<div class="container">

    <aside class="left-panel">
        <div class="logo">
            <img src="./img/logo.png" alt="Logo">
        </div>
        <h2>ALOCATEC</h2>
        <hr>

        <h3>BEM-VINDO</h3>

        <p>Caso possua uma conta<br>acesse ela agora!</p>

        <button class="btn-enter">
            <a class="link" href="../../index.php">ENTRAR</a>
        </button>
        <a href="#" class="recupere-senha">Esqueceu sua senha?</a>

        <div class="divider">
            <span></span>
            <p>OU</p>
            <span></span>
        </div>

        <div class="social-icons">
            <img src="../img/facebook.png" alt="">
            <img src="../img/google.png" alt="">
            <img src="../img/instagram.png" alt="">
        </div>

    </aside>

    <div class="content">
<?php 
session_start();
$mensagem = $_SESSION['mensagem'] ?? '';
$tipo_mensagem = $_SESSION['tipo_mensagem'] ?? '';
unset($_SESSION['mensagem'], $_SESSION['tipo_mensagem']);
?>
<section class="right-panel">
<?php if (!empty($mensagem)): ?>
    <div class="resuldado<?= $tipo_mensagem === 'Sucesso' ? '-Sucesso' : '-Erro' ?>">
        <?= htmlspecialchars($mensagem) ?>
    </div>
<?php endif; ?>

            <div class="page">
                <h1>CADASTRE-SE</h1>
            </div>

            <form class="form" action="processa_cadastro.php" method="POST">

                <div class="photo-area">
                    <div class="photo-circle"></div>
                    <p>Adicione sua foto</p>
                </div>

                <label>Nome de Usuário</label>
                <input type="text" name="nome_usu" required />

                <label>E-mail de login</label>
                <input type="email" name="email" required />

                <label>Telefone</label>
                <input type="tel" name="telefone" required />

                <label>Data Nascimento</label>
                <input type="date" name="data_nas" required />

                <label>CPF</label>
                <input type="text" name="cpf" required />

                <label>Gênero</label>
                <div class="gender">
                    <label><input type="radio" name="genero" value="M" required /> Masculino</label>
                    <label><input type="radio" name="genero" value="F" required /> Feminino</label>
                </div>

                <label>Estado</label>
                <input type="text" name="estado" required />

                <label>Cidade</label>
                <input type="text" name="cidade" required />

                <label>CEP</label>
                <input type="text" name="cep" required />

                <label>Endereço</label>
                <input type="text" name="endereco" required />

                <label>Senha</label>
                <input type="password" name="senha" required />

                <label>Confirmação de Senha</label>
                <input type="password" name="confirm_senha" required />

                <div class="div-cadastro">
                    <button class="btn-register" type="submit">CADASTRAR-SE</button>
                </div>

            </form>
        </section>
    </div>
</div>

<!-- ======= VALIDAÇÃO DE SENHA NO NAVEGADOR ======= -->
<script>
document.querySelector(".form").addEventListener("submit", function(e){
    const senha = document.querySelector("input[name='senha']").value;
    const confirm = document.querySelector("input[name='confirm_senha']").value;

    if (senha !== confirm) {
        e.preventDefault();
        alert("As senhas não coincidem!");
    }
});
</script>

</body>
</html>
