<?php

$local_servidor = "localhost:3306";
$usuario = "root";
$senha = "root";

$bd_procurado = "sistema_reservas";

$conexao_servidor_bd = 
mysqli_connect($local_servidor, $usuario, $senha,  $bd_procurado);

?>