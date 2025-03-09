<?php
// Conectar ao banco de dados
$conn = new mysqli("localhost", "root", "", "SistemaEnsino");

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $id_materia = $_POST['id_materia'];

    $sql_inserir_aluno = "INSERT INTO alunos (nome, id_materia) VALUES ('$nome', '$id_materia')";

    if ($conn->query($sql_inserir_aluno) === TRUE) {
        echo "Aluno cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar aluno: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Aluno</title>
</head>
<body>
<h2>Cadastrar Aluno</h2>
<form method="POST" action="cadastrar_aluno.php">
    <label for="nome">Nome do Aluno:</label>
    <input type="text" name="nome" required><br><br>

    <label for="id_materia">Matéria:</label>
    <select name="id_materia" required>
        <?php
        $sql_materias = "SELECT id_materia, nome FROM materia"; 
        $result = $conn->query($sql_materias);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id_materia'] . "'>" . $row['nome'] . "</option>";
            }
        } else {
            echo "<option>Sem matérias cadastradas</option>";
        }
        ?>
    </select><br><br>

    <input type="submit" value="Cadastrar">
</form>
</body>
</html>

<?php
$conn->close();
?>
