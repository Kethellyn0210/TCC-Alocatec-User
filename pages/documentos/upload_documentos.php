<?php
session_start();
require_once "../../database/conexao_bd_mysql.php";

// -----------------------------------------------
// VERIFICA LOGIN
// -----------------------------------------------
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../index.php");
    exit();
}

$usuario = $_SESSION['usuario'];
$id_usuario = $usuario['id'];

// -----------------------------------------------
// VERIFICA SE FORM FOI ENVIADO
// -----------------------------------------------
if (!isset($_POST['enviar'])) {
    header("Location: meusdocumentos.php");
    exit();
}

// -----------------------------------------------
// FUNÇÃO PARA VALIDAR ARQUIVOS
// -----------------------------------------------
function validarArquivo($campo, &$erros)
{
    if (!isset($_FILES[$campo]) || $_FILES[$campo]['error'] === UPLOAD_ERR_NO_FILE) {
        $erros[] = "O arquivo '$campo' não foi enviado.";
        return false;
    }

    if ($_FILES[$campo]['error'] !== UPLOAD_ERR_OK) {
        $erros[] = "Erro ao enviar o arquivo '$campo'.";
        return false;
    }

    return true;
}

// -----------------------------------------------
// 1) VALIDAR OS ARQUIVOS
// -----------------------------------------------
$erros = [];

validarArquivo('rg_foto', $erros);
validarArquivo('endereco_foto', $erros);
validarArquivo('selfie_rg', $erros);

if (!empty($erros)) {
    $_SESSION['erro_upload'] = $erros;
    header("Location: meusdocumentos.php");
    exit();
}

// -----------------------------------------------
// 2) FAZER UPLOAD DOS ARQUIVOS
// -----------------------------------------------
$uploadDir = "../upload_arquivos/";

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

function salvarArquivo($campo, $uploadDir)
{
    $nomeTmp = $_FILES[$campo]['tmp_name'];
    $nomeOriginal = basename($_FILES[$campo]['name']);
    $novoNome = uniqid() . "-" . $nomeOriginal;
    $destino = $uploadDir . $novoNome;

    move_uploaded_file($nomeTmp, $destino);

    return $novoNome;
}

$rg_foto = salvarArquivo("rg_foto", $uploadDir);
$endereco_foto = salvarArquivo("endereco_foto", $uploadDir);
$selfie_rg = salvarArquivo("selfie_rg", $uploadDir);

// -----------------------------------------------
// 3) INSERIR OU ATUALIZAR NO BANCO
// -----------------------------------------------
$sql_check = "SELECT id_usuario FROM documentos WHERE id_usuario = '$id_usuario'";
$result = mysqli_query($conn, $sql_check);

if (mysqli_num_rows($result) > 0) {

    // Atualizar
    $sql = "UPDATE documentos SET 
                rg_foto = '$rg_foto',
                endereco_foto = '$endereco_foto',
                selfie_rg = '$selfie_rg'
            WHERE id_usuario = '$id_usuario'";

} else {

    // Inserir novo
    $sql = "INSERT INTO documentos (id_usuario, rg_foto, endereco_foto, selfie_rg)
            VALUES ('$id_usuario', '$rg_foto', '$endereco_foto', '$selfie_rg')";
}

mysqli_query($conn, $sql);

// -----------------------------------------------
// 4) REDIRECIONAR COM SUCESSO
// -----------------------------------------------
$_SESSION['upload_sucesso'] = "Documentos enviados com sucesso!";
$_SESSION['documentos_enviados'] = true; // <<< AQUI FAZ SUMIR O AVISO NO PERFIL

header("Location: meusdocumentos.php");
exit();
?>