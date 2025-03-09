<?php
// Conectar ao banco de dados
$conn = new mysqli("localhost", "root", "", "SistemaEnsino");

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_materia = $_POST['id_materia'];
    $descricao = $_POST['descricao'];
    $concluida = isset($_POST['concluida']) ? 1 : 0;
    // Preparar a consulta SQL para inserir a tarefa
    $sql_inserir_tarefa = "INSERT INTO Tarefas (id_materia, descricao, concluida) VALUES ('$id_materia', '$descricao', '$concluida')";

    // Executar a consulta SQL
    if ($conn->query($sql_inserir_tarefa) === TRUE) {
        echo "Tarefa inserida com sucesso!";
    } else {
        echo "Erro ao inserir tarefa: " . $conn->error;
    }
}
?>

<!-- Formulário para inserir a tarefa -->
<h2>Adicionar Tarefa</h2>
<form method="POST" action="adicionar_tarefa.php">
    <label for="id_materia">Matéria:</label><br>
    <select name="id_materia" id="id_materia">
        <?php
        $sql_materias = "SELECT id_materia, nome FROM Materia";
        $result_materias = $conn->query($sql_materias);

        if ($result_materias->num_rows > 0) {
            while ($materia = $result_materias->fetch_assoc()) {
                echo "<option value='".$materia['id_materia']."'>".$materia['nome']."</option>";
            }
        } else {
            echo "<option>Sem matérias cadastradas</option>";
        }
        ?>
    </select><br><br>

    <label for="descricao">Descrição da Tarefa:</label><br>
    <textarea name="descricao" id="descricao" required></textarea><br><br>

    <label for="concluida">Está concluída?</label><br>
    <input type="checkbox" name="concluida" id="concluida"><br><br>

    <input type="submit" value="Inserir Tarefa">
</form>

<!-- Mostrar lista de tarefas e permitir edição -->
<h2>Tarefas Cadastradas</h2>
<?php
$sql_tarefas = "SELECT id_tarefa, descricao, concluida FROM tarefas";
$result_tarefas = $conn->query($sql_tarefas);

if ($result_tarefas->num_rows > 0) {
    echo "<ul>";
    while ($tarefa = $result_tarefas->fetch_assoc()) {
        echo "<li>";
        echo $tarefa['descricao'] . " - " . ($tarefa['concluida'] ? "Concluída" : "Pendente") . " ";
        echo "<a href='editar_tarefa.php?id_tarefa=" . $tarefa['id_tarefa'] . "'>Editar</a>";
        echo "</li>";
    }
    echo "</ul>";
} else {
    echo "Nenhuma tarefa cadastrada.";
}
?>
