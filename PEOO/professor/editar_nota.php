<?php
// Conectar ao banco de dados
$conn = new mysqli("localhost", "root", "", "SistemaEnsino");

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_nota = $_POST['id_nota'];
    $nota = $_POST['nota'];

    // Atualizar a nota
    $sql_editar_nota = "UPDATE Notas SET nota = '$nota' WHERE id_nota = '$id_nota'";
    
    if ($conn->query($sql_editar_nota) === TRUE) {
        echo "Nota editada com sucesso!";
    } else {
        echo "Erro ao editar nota: " . $conn->error;
    }
}

if (isset($_GET['id_nota'])) {
    $id_nota = $_GET['id_nota'];

    $sql_nota = "SELECT * FROM Notas WHERE id_nota = '$id_nota'";
    $result_nota = $conn->query($sql_nota);

    if ($result_nota->num_rows > 0) {
        $nota_row = $result_nota->fetch_assoc();
        $nota = $nota_row['nota'];
    } else {
        echo "Nota não encontrada!";
        exit;
    }
} else {
    echo "ID da nota não fornecido!";
    exit;
}
?>

<h2>Editar Nota</h2>
<form method="POST" action="editar_nota.php">
    <input type="hidden" name="id_nota" value="<?php echo $id_nota; ?>">

    <label for="nota">Nova Nota:</label><br>
    <input type="number" name="nota" value="<?php echo $nota; ?>" required><br><br>

    <input type="submit" value="Atualizar">
</form>
