<?php
session_start();

// Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "SistemaEnsino");

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$sql_materias = "SELECT nome FROM Materia";
$result_materias = $conn->query($sql_materias);

// Verifica se há matérias na tabela
if ($result_materias->num_rows > 0) {
    echo "<h2>Lista de Matérias</h2>";
    echo "<table border='1'>
            <tr>
                <th>Nome da Matéria</th>
            </tr>";

    // Exibe as matérias
    while ($row = $result_materias->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['nome'] . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "Nenhuma matéria encontrada.";
}

$conn->close();
?>
