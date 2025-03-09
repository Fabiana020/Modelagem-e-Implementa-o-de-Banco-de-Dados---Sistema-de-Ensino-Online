<?php
session_start();
include('../assets/conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = $_POST['senha'];

    $sql = "SELECT id_aluno AS id, nome, senha FROM alunos WHERE email = '$email'";
    $result = $conn->query($sql);
    $tipo = "alunos";

    if ($result->num_rows == 0) {
        $sql = "SELECT id_professor AS id, nome, senha FROM professor WHERE email = '$email'";
        $result = $conn->query($sql);
        $tipo = "professor";
    }

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($senha, $user['senha'])) {
            $_SESSION['id_usuario'] = $user['id'];
            $_SESSION['email'] = $email;
            $_SESSION['nome'] = $user['nome'];
            $_SESSION['tipo_usuario'] = $tipo;

            if ($tipo == 'alunos') {
                header("Location: ../aluno/aluno_index.php");
            } else {
                header("Location: ../professor/professor_index.php");
            }
            exit();
        } else {
            echo "Senha incorreta! Tente novamente.";
        }
    } else {
        echo "Usuário não encontrado! Verifique o e-mail e tente novamente.";
    }
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
