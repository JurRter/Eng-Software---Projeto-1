<?php
session_start();
    $usuario = [
        ["nome" => "admin", "senha" => "admin123"],
        ["nome" => "user", "senha" => "user123"]
    ];

    $mensagem = "";

    $nome = trim($_POST["nome"] ?? "");
    $senha = trim($_POST["senha"] ?? "");
    $existe = false;
    $senhaCorreta = false;

    foreach ($usuario as $user) {
        if ($user["nome"] === $nome) {
            $existe = true;
            if ($user["senha"] === $senha) {
                $senhaCorreta = true;
                break;
            }
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!$existe) {
            $mensagem = "Usuário não existe";
        } elseif (!$senhaCorreta) {
            $mensagem = "Senha incorreta";
        } else {
            $_SESSION["logado"] = true;
            $_SESSION["usuario"] = $nome;
            header("Location: index.php");
        exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
</head>
<body>
  <h2>Login</h2>

  <?php if ($mensagem !== ""): ?>
    <p><?php echo htmlspecialchars($mensagem); ?></p>
  <?php endif; ?>

  <form method="POST" action="">
    <input type="text" name="nome" placeholder="Nome">
    <input type="password" name="senha" placeholder="Senha">
    <button type="submit">Entrar</button>
  </form>
</body>
</html>