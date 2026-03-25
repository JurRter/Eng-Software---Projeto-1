<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css">
    <title>Cadastro - TaskBoard</title>
</head>
<body style="background-color: #ebedf0; display: flex; align-items: center; justify-content: center; height: 100vh; padding: 0;">

<div style="background: white; padding: 40px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 100%; max-width: 400px;">
    <h2 style="text-align: center; margin-bottom: 30px; color: #172b4d;">Criar sua Conta</h2>

    <?php if (!empty($mensagem)): ?>
        <p style="color: #eb5757; text-align: center; margin-bottom: 20px;"><?= $mensagem ?></p>
    <?php endif; ?>

    <form action="/registro" method="POST">
        <label style="display: block; margin-bottom: 8px; color: #5e6c84; font-size: 14px;">Escolha um Nome</label>
        <input type="text" name="nome" required style="width: 100%; padding: 12px; border: 2px solid #dfe1e6; border-radius: 6px; margin-bottom: 20px; outline: none;">
        
        <label style="display: block; margin-bottom: 8px; color: #5e6c84; font-size: 14px;">Escolha uma Senha</label>
        <input type="password" name="senha" required style="width: 100%; padding: 12px; border: 2px solid #dfe1e6; border-radius: 6px; margin-bottom: 25px; outline: none;">

        <button type="submit" style="width: 100%; background: #0052cc; color: white; border: none; padding: 12px; border-radius: 6px; font-weight: bold; cursor: pointer;">Cadastrar agora</button>
    </form>

    <p style="text-align: center; margin-top: 25px; color: #5e6c84;">Já tem conta? <a href="/login" style="color: #0052cc; text-decoration: none;">Voltar para login</a></p>
</div>

</body>
</html>
