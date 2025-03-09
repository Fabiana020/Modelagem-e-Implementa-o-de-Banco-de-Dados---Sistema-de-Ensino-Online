<?php
session_start();

// Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "SistemaEnsino");

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$sql_alunos = "SELECT nome, email FROM alunos";
$result_alunos = $conn->query($sql_alunos);

if ($result_alunos->num_rows > 0) {
    echo "<h2>Lista de Alunos</h2>";
    echo "<table border='1'>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
            </tr>";

    while ($row = $result_alunos->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['nome'] . "</td>
                <td>" . $row['email'] . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "Nenhum aluno encontrado.";
}

$conn->close();
?>
