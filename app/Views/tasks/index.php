<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/style.css">
    <title>Gerenciador de Tarefas</title>
</head>
<body>

<div class="header">
    <div class="header-content">
        <div>
            <h1>Board de Tarefas</h1>
            <small>Olá, <?= htmlspecialchars($_SESSION['usuario'] ?? 'Visitante') ?> | <a href="/logout" style="color: #eb5757; text-decoration: none; font-size: 12px;">Sair</a></small>
        </div>
        <a href='/tarefas/criar' class="btn-novo">
            <i class="fa-solid fa-plus"></i> Nova Tarefa
        </a>
    </div>
</div>

<?php if (empty($tarefas)): ?>
    <div class='vazio'>
        <h2>Tudo pronto!</h2>
        <p>Nenhuma tarefa pendente por aqui.</p>
        <a href='/tarefas/criar'>
            <button class='btn-adicionar'>Criar minha primeira tarefa</button>
        </a>
    </div>
<?php else: ?>
    <div class="board-wrapper">
        <div class="board">
            
            <div class="coluna">
                <div class="coluna-topo">
                    <h2>Para Fazer</h2>
                    <span class="count"><?= count(array_filter($tarefas, fn($t) => !$t['concluida'])) ?></span>
                </div>
                <div class="lista-cards">
                    <?php foreach ($tarefas as $tarefa): ?>
                        <?php if (!$tarefa['concluida']): ?>
                            <div class='card pendente'>
                                <h3><?= htmlspecialchars($tarefa["nome"]) ?></h3>
                                <div class="card-footer">
                                    <a href='/tarefas/concluir?id=<?= $tarefa["id"] ?>' class="btn-check" title="Finalizar">
                                        <i class="fa-solid fa-check"></i>
                                    </i class="fa-solid fa-check"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="coluna">
                <div class="coluna-topo green">
                    <h2>Finalizado</h2>
                    <span class="count"><?= count(array_filter($tarefas, fn($t) => $t['concluida'])) ?></span>
                </div>
                <div class="lista-cards">
                    <?php foreach ($tarefas as $tarefa): ?>
                        <?php if ($tarefa['concluida']): ?>
                            <div class='card concluido'>
                                <h3><?= htmlspecialchars($tarefa["nome"]) ?></h3>
                                <div class="card-footer">
                                    <a href='/tarefas/concluir?id=<?= $tarefa["id"] ?>' class="btn-undo" title="Desfazer">
                                        <i class="fa-solid fa-rotate-left"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>
<?php endif; ?>

</body>
</html>
