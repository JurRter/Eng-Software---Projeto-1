<?php
session_start();

    $arquivoUsuarios = "usuarios.json";

    function usuariosPadrao(): array {
        return [
            ["nome" => "admin", "senha" => password_hash("admin123", PASSWORD_DEFAULT)],
            ["nome" => "user", "senha" => password_hash("user123", PASSWORD_DEFAULT)]
        ];
    }

    function carregarUsuarios(string $arquivo): array {
        if (!file_exists($arquivo)) {
            $padrao = usuariosPadrao();
            file_put_contents($arquivo, json_encode($padrao, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            return $padrao;
        }

        $conteudo = file_get_contents($arquivo);
        $usuarios = json_decode($conteudo, true);

        if (!is_array($usuarios)) {
            $padrao = usuariosPadrao();
            file_put_contents($arquivo, json_encode($padrao, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            return $padrao;
        }

        return $usuarios;
    }

    $usuario = carregarUsuarios($arquivoUsuarios);

    $mensagem = "";

    $nome = trim($_POST["nome"] ?? "");
    $senha = trim($_POST["senha"] ?? "");
    $existe = false;
    $senhaCorreta = false;

    foreach ($usuario as $user) {
        if (($user["nome"] ?? "") === $nome) {
            $existe = true;
            $senhaSalva = $user["senha"] ?? "";

            if (password_verify($senha, $senhaSalva) || $senhaSalva === $senha) {
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

    <?php if (!empty($_SESSION["cadastro_sucesso"])): ?>
        <p><?php echo htmlspecialchars($_SESSION["cadastro_sucesso"]); ?></p>
        <?php unset($_SESSION["cadastro_sucesso"]); ?>
    <?php endif; ?>

    <?php if ($mensagem !== ""): ?>
    <p><?php echo htmlspecialchars($mensagem); ?></p>
  <?php endif; ?>

  <form method="POST" action="">
    <input type="text" name="nome" placeholder="Nome">
    <input type="password" name="senha" placeholder="Senha">
    <button type="submit">Entrar</button>
  </form>

    <p><a href="registro.php">Criar conta</a></p>
</body>
</html>