<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    echo "Você não está logado.";
    exit;
}

$id_usuario = $_SESSION['id_usuario'];
$id_materia = 1;

// Conectar ao banco de dados
$conn = new mysqli("localhost", "root", "", "SistemaEnsino");

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Consulta para obter a nota do aluno na matéria e o nome da matéria
$sql_notas = "
    SELECT 
        notas.nota, 
        alunos.nome AS aluno_nome, 
        materia.nome AS materia_nome 
    FROM 
        Notas AS notas
    JOIN 
        alunos ON notas.id_aluno = alunos.id_aluno
    JOIN 
        materia ON notas.id_materia = materia.id_materia
    WHERE 
        notas.id_aluno = $id_usuario AND notas.id_materia = $id_materia
";
$result_notas = $conn->query($sql_notas);

if ($result_notas->num_rows > 0) {
    $row = $result_notas->fetch_assoc();
    echo "Nota: " . $row['nota'] . "<br>";
    echo "Aluno: " . $row['aluno_nome'] . "<br>";
    echo "Matéria: " . $row['materia_nome'] . "<br>";
} else {
    echo "Nota não encontrada.";
}

$conn->close();