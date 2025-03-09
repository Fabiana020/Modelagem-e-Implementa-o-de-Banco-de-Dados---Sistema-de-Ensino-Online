<?php
session_start();

// Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "SistemaEnsino");

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$sql_tarefas = "SELECT id_tarefa, descricao, concluida FROM tarefas";
$result_tarefas = $conn->query($sql_tarefas);

// Verifica se há tarefas na tabela
if ($result_tarefas->num_rows > 0) {
    echo "<h2>Lista de Tarefas</h2>";
    echo "<table border='1'>
            <tr>
                <th>Descrição</th>
                <th>Status</th>
                <th>Ação</th>
            </tr>";

    // Exibe as tarefas
    while ($row = $result_tarefas->fetch_assoc()) {
        $status = $row['concluida'] ? 'Concluída' : 'Pendente';
        echo "<tr>
                <td>" . $row['descricao'] . "</td>
                <td>" . $status . "</td>
                <td>";

        if (!$row['concluida']) {
            echo "<a href='marcar_concluida.php?id_tarefa=" . $row['id_tarefa'] . "'>Marcar como concluída</a>";
        } else {
            echo "Já concluída";
        }

        echo "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "Nenhuma tarefa encontrada.";
}

$conn->close();
?>
