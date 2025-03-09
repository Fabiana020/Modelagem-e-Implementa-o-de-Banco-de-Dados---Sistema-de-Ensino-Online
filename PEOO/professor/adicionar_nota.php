<?php
// Conectar ao banco de dados
$conn = new mysqli("localhost", "root", "", "SistemaEnsino");

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_aluno = $_POST['id_aluno'];
    $id_materia = $_POST['id_materia'];
    $nota = $_POST['nota'];

    $sql_verificar_alunos = "SELECT id_aluno FROM alunos WHERE id_aluno = '$id_aluno'";
    $sql_verificar_materia = "SELECT id_materia FROM materia WHERE id_materia = '$id_materia'";

    if ($conn->query($sql_verificar_alunos)->num_rows == 0 || $conn->query($sql_verificar_materia)->num_rows == 0) {
        echo "Aluno ou matéria não encontrados!";
    } else {
        // Preparar a consulta SQL para inserir a nota
        $sql_adicionar_nota = "INSERT INTO Notas (id_aluno, id_materia, nota) VALUES ('$id_aluno', '$id_materia', '$nota')";

        // Executar a consulta SQL
        if ($conn->query($sql_adicionar_nota) === TRUE) {
            echo "Nota inserida com sucesso!";
        } else {
            echo "Erro ao inserir nota: " . $conn->error;
        }
    }
}
?>

<!-- Formulário para inserir a nota -->
<h2>Adicionar Nota</h2>
<form method="POST" action="adicionar_nota.php">
    <label for="id_aluno">Aluno:</label><br>
    <select name="id_aluno" id="id_aluno">
        <?php
        $sql_alunos = "SELECT id_aluno, nome FROM alunos";
        $result_alunos = $conn->query($sql_alunos);

        if ($result_alunos->num_rows > 0) {
            while ($row = $result_alunos->fetch_assoc()) {
                echo "<option value='".$row['id_aluno']."'>".$row['nome']."</option>";
            }
        } else {
            echo "<option>Nenhum aluno encontrado</option>";
        }
        ?>
    </select><br><br>

    <label for="id_materia">Matéria:</label><br>
    <select name="id_materia" id="id_materia">
        <?php
        $sql_materias = "SELECT id_materia, nome FROM materia";
        $result_materias = $conn->query($sql_materias);

        if ($result_materias->num_rows > 0) {
            while ($row = $result_materias->fetch_assoc()) {
                echo "<option value='".$row['id_materia']."'>".$row['nome']."</option>";
            }
        } else {
            echo "<option>Nenhuma matéria encontrada</option>";
        }
        ?>
    </select><br><br>

    <label for="nota">Nota:</label><br>
    <input type="number" name="nota" required><br><br>

    <input type="submit" value="Adicionar">
</form>

<!-- Lista de alunos e notas -->
<h2>Notas dos Alunos</h2>
<table border="1">
    <thead>
        <tr>
            <th>Aluno</th>
            <th>Nota</th>
            <th>Ação</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql_notas = "SELECT n.id_nota, a.nome AS aluno, n.nota, m.nome AS materia 
                      FROM Notas n 
                      JOIN alunos a ON n.id_aluno = a.id_aluno 
                      JOIN materia m ON n.id_materia = m.id_materia";
        $result_notas = $conn->query($sql_notas);

        if ($result_notas->num_rows > 0) {
            while ($row = $result_notas->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['aluno'] . " (" . $row['materia'] . ")</td>";
                echo "<td>" . $row['nota'] . "</td>";
                echo "<td><a href='editar_nota.php?id_nota=" . $row['id_nota'] . "'>Editar</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Nenhuma nota encontrada</td></tr>";
        }
        ?>
    </tbody>
</table>
