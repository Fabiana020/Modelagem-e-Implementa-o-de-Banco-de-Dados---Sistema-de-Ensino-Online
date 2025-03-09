<?php
session_start();

if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo_usuario'] !== 'professor') {
    header("Location: ../auth/login.php");
    exit();
}

$nome_professor = $_SESSION['nome'] ?? 'Professor';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Aluno</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Bem-vindo ao Sistema de Ensino</h1>
            <p>Olá, <?php echo $_SESSION['nome']; ?>!</p>
        </div>
    </header>

    <nav>
        <div class="container">
            <ul>
                <li><a href="adicionar_nota.php">Gerenciar Nota</a></li>
                <li><a href="adicionar_tarefa.php">Gerenciar Tarefa</a></li>
                <li><a href="listar_aluno.php">Listar Aluno</a></li>
                <li><a href="../auth/logout.php">Sair</a></li>
            </ul>
        </div>
    </nav>

    <main>
        <div class="container">
            <section>
                <h2>Dashboard do Professor</h2>
                <p>Aqui você pode gerenciar notas, tarefas e acompanhar os alunos.</p>
            </section>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2025 Sistema de Ensino. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>
