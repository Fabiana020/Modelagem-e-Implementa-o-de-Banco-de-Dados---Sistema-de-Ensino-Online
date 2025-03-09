<?php
// Conectar ao banco de dados
$conn = new mysqli("localhost", "root", "", "SistemaEnsino");

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Inicializa a variável $tarefa
$tarefa = null;

// Verificar se o ID da tarefa foi passado via GET
if (isset($_GET['id_tarefa'])) {
    $id_tarefa = $_GET['id_tarefa'];

    $sql_tarefa = "SELECT id_tarefa, descricao, concluida FROM tarefas WHERE id_tarefa = $id_tarefa";
    $result = $conn->query($sql_tarefa);

    if ($result->num_rows > 0) {
        $tarefa = $result->fetch_assoc();
    } else {
        echo "Tarefa não encontrada.";
    }

    // Processar a atualização da tarefa
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $descricao = $_POST['descricao'];
        $concluida = isset($_POST['concluida']) ? 1 : 0;

        // Atualizar a tarefa
        $sql_editar_tarefa = "UPDATE tarefas SET descricao = '$descricao', concluida = '$concluida' WHERE id_tarefa = $id_tarefa";
        if ($conn->query($sql_editar_tarefa) === TRUE) {
            echo "Tarefa atualizada com sucesso!";
        } else {
            echo "Erro ao atualizar tarefa: " . $conn->error;
        }
    }
} else {
    echo "ID da tarefa não fornecido.";
}
?>

<!-- Formulário para editar tarefa -->
<?php if ($tarefa): ?>
    <h2>Editar Tarefa</h2>
    <form method="POST">
        <label for="descricao">Descrição da Tarefa:</label><br>
        <textarea name="descricao" id="descricao" required><?php echo htmlspecialchars($tarefa['descricao']); ?></textarea><br><br>

        <label for="concluida">Está concluída?</label><br>
        <input type="checkbox" name="concluida" id="concluida" <?php echo $tarefa['concluida'] == 1 ? 'checked' : ''; ?>><br><br>

        <input type="submit" value="Salvar Alterações">
    </form>
<?php endif; ?>
