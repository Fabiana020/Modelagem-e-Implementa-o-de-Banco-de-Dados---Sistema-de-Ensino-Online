<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistemaensino";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Checar a conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>
