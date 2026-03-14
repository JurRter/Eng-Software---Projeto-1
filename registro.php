<?php
// registro.php

session_start();

// Função para validar e registrar usuário
function registrarUsuario($usuario, $senha) {
    // Caminho do arquivo de usuários
    $arquivoUsuarios = 'usuarios.txt';

    // Verifica se usuário já existe
    $usuarios = file($arquivoUsuarios, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($usuarios as $linha) {
        list($user, $pass) = explode(':', $linha);
        if ($user === $usuario) {
            return "Usuário já existe!";
        }
    }

    // Salva novo usuário
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    file_put_contents($arquivoUsuarios, "$usuario:$senhaHash\n", FILE_APPEND);
    return "Usuário registrado com sucesso!";
}

// Processa o formulário
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    if ($usuario && $senha) {
        $msg = registrarUsuario($usuario, $senha);
    } else {
        $msg = "Preencha todos os campos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; }
        .container { max-width: 400px; margin: 50px auto; background: #fff; padding: 20px; border-radius: 8px; }
        input[type="text"], input[type="password"] { width: 100%; padding: 8px; margin: 8px 0; }
        input[type="submit"] { width: 100%; padding: 10px; background: #007bff; color: #fff; border: none; border-radius: 4px; }
        .msg { color: red; margin-bottom: 10px; }
    </style>
</head>
<body>
<div class="container">
    <h2>Registro de Usuário</h2>
    <?php if ($msg): ?>
        <div class="msg"><?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>
    <form method="post">
        <label for="usuario">Usuário:</label>
        <input type="text" name="usuario" id="usuario" required>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>
        <input type="submit" value="Registrar">
    </form>
    <p><a href="login.php">Já tem uma conta? Faça login</a></p>
</div>
</body>
</html>