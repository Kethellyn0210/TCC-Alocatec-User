<?php

$local_servidor = "localhost:3306";
$usuario = "root";
$senha = "root";

$bd_procurado = "sistema_reservas";

$conexao_servidor_bd = 
mysqli_connect($local_servidor, $usuario, $senha,  $bd_procurado);

$conn = mysqli_connect("localhost", "root", "root", "sistema_reservas");

if (!$conn) {
    die("Erro ao conectar com o banco: " . mysqli_connect_error());
}
?>