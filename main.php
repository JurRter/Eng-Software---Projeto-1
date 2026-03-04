<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Meu Projeto</h1>
        <nav>
            <a href="index.html">Home</a>
            <a href="main.php">PHP Page</a>
        </nav>
    </header>

    <main>
        <section>
            <h2>PHP Info</h2>
            <?php
                echo "<p>Versão do PHP: " . phpversion() . "</p>";
                echo "<p>Data atual: " . date("d/m/Y H:i:s") . "</p>";
                echo "<p>Servidor: " . ($_SERVER['SERVER_SOFTWARE'] ?? 'N/A') . "</p>";
            ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 - Eng. Software Projeto 1</p>
    </footer>
</body>
</html>