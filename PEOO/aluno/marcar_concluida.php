<?php
// Conectar ao banco de dados
$conn = new mysqli("localhost", "root", "", "SistemaEnsino");

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Verificar se o id_tarefa foi enviado
if (isset($_GET['id_tarefa'])) {
    $id_tarefa = $_GET['id_tarefa'];

    // Consulta SQL para atualizar a tarefa como concluída
    $sql_concluir_tarefa = "UPDATE tarefas SET concluida = 1 WHERE id_tarefa = $id_tarefa";
    if ($conn->query($sql_concluir_tarefa) === TRUE) {
        echo "Tarefa marcada como concluída!";
    } else {
        echo "Erro ao concluir tarefa: " . $conn->error;
    }
} else {
    echo "ID da tarefa não fornecido.";
}

$conn->close();
?>
