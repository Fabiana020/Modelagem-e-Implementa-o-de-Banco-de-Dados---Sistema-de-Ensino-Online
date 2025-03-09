<?php
session_start();

// Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "SistemaEnsino");

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$sql_professores = "SELECT nome, email FROM Professor";
$result_professores = $conn->query($sql_professores);

// Verifica se há professores na tabela
if ($result_professores->num_rows > 0) {
    echo "<h2>Lista de Professores</h2>";
    echo "<table border='1'>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
            </tr>";

    // Exibe os professores
    while ($row = $result_professores->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['nome'] . "</td>
                <td>" . $row['email'] . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "Nenhum professor encontrado.";
}

$conn->close();
?>
