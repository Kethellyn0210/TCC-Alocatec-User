<?php
session_start();
require '../../login/login.php';
require_once '../../database/conexao_bd_mysql.php';

// RECEBE OS DADOS
$nome      = $_POST['nome_usu'];
$email     = $_POST['email'];
$telefone  = $_POST['telefone'];
$data_nas  = $_POST['data_nas'];
$cpf       = $_POST['cpf'];
$genero    = $_POST['genero'];
$estado    = $_POST['estado'];
$cidade    = $_POST['cidade'];
$cep       = $_POST['cep'];
$endereco  = $_POST['endereco'];
$senha     = $_POST['senha'];
$confirm   = $_POST['confirm_senha'];

if ($senha !== $confirm) {
    $_SESSION['mensagem'] = "As senhas não coincidem!";
    $_SESSION['tipo_mensagem'] = "Erro";
    header("Location: cadastro.php");
    exit;
}

$sql = "INSERT INTO usuario 
(nome_usu, email, telefone, data_nas, estado, cidade, cep, cpf, endereco, senha, genero)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conexao_servidor_bd->prepare($sql);

$stmt->bind_param(
    "sssssssssss",
    $nome, $email, $telefone, $data_nas, $estado, $cidade, $cep, $cpf, $endereco, $senha, $genero
);

if ($stmt->execute()) {
    $_SESSION['mensagem'] = "Usuário cadastrado com sucesso!";
    $_SESSION['tipo_mensagem'] = "Sucesso";
} else {
    $_SESSION['mensagem'] = "Erro ao cadastrar usuário: " . $stmt->error;
    $_SESSION['tipo_mensagem'] = "Erro";
}

$stmt->close();

header("Location: cadastro.php");
exit;
