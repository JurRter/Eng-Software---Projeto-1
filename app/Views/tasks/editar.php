<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Tarefa</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <div class="header">
        <div class="header-content">
            <h1>Editar Tarefa</h1>
            <a href="/" class="btn-novo">Voltar</a>
        </div>
    </div>

    <div class="board-wrapper">
        <div class="card" style="max-width: 500px; width: 100%;">
            <form action="/tarefas/atualizar" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
                <input type="hidden" name="id" value="<?= htmlspecialchars($tarefa['id']) ?>">
                
                <label style="font-weight: bold; color: #1e293b;">Nome da Tarefa:</label>
                <input type="text" name="nome" value="<?= htmlspecialchars($tarefa['nome']) ?>" required 
                       style="padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 16px;">
                
                <button type="submit" class="btn-adicionar">Salvar Alterações</button>
            </form>
        </div>
    </div>
</body>
</html>