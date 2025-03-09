<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header('Location: ../auth/login.php');
    exit();
}
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
                <li><a href="listar_materia.php">Minhas Matérias</a></li>
                <li><a href="exibir_tarefa.php">Minhas Tarefas</a></li>
                <li><a href="exibir_nota.php">Minhas Notas</a></li>
                <li><a href="../auth/logout.php">Sair</a></li>
            </ul>
        </div>
    </nav>

    <main>
        <div class="container">
            <section>
                <h2>Dashboard do Aluno</h2>
                <p>Aqui você pode acompanhar suas matérias, tarefas e notas.</p>
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
