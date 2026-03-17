<?php 
session_start();
	$arquivoUsuarios = "usuarios.json";
	$mensagem = "";
	$nome = trim($_POST["nome"] ?? "");
	$senha = trim($_POST["senha"] ??"");
	if ($_SERVER["REQUEST_METHOD"] === "POST") {
		if($nome === "" || $senha === "") {
			$mensagem = "Preencha nome ou senha";
		} else {
			if (!file_exists("usuarios.json")) {
				$usuarioIniciais = [
					CriarUsuario("admin", "admin123"),
					CriarUsuario("user", "user123")
				];
			}
			file_put_contents("usuarios.json", json_encode($usuarioIniciais, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
		}
		$usuarios = json_decode(file_get_contents("usuarios.json"), true);
		if (!is_array($usuarios)) {
		$usuarios = [];			
		}
		$existe = false;
		foreach ($usuarios as $u) {
			if (($u["nome"] ?? "") === $nome) {
				$existe = true;
				break;
			}
		}

		if ($existe) {
			$mensagem = "Usuário já existe.";
		} else {
			$usuarios[] = CriarUsuario($nome, $senha);
			file_put_contents("usuarios.json", json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

			$_SESSION["cadastro_sucesso"] = "Usuário cadastrado com sucesso. Faça login.";
			header("Location: login.php");
			exit;
		}
	}

	function CriarUsuario(string $nome, string $senha): array {
		return [
			"nome" => $nome,
			"senha" => password_hash($senha, PASSWORD_DEFAULT)
		];
	}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registro</title>
</head>
<body>
	<h2>Registro</h2>

	<?php if ($mensagem !== ""): ?>
		<p><?php echo htmlspecialchars($mensagem); ?></p>
	<?php endif; ?>

	<form method="POST" action="">
		<input type="text" name="nome" placeholder="Nome">
		<input type="password" name="senha" placeholder="Senha">
		<button type="submit">Cadastrar</button>
	</form>

	<p><a href="login.php">Voltar para login</a></p>
</body>
</html>