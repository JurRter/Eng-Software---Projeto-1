<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/style.css">
    <title>Nova Tarefa</title>
    <style>
        .form-container {
            max-width: 500px;
            margin: 100px auto;
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        h2 { margin-bottom: 20px; color: #333; }
        input[type="text"] {
            width: 100%;
            padding: 15px;
            border: 2px solid #eee;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 16px;
            outline: none;
            transition: 0.3s;
        }
        input[type="text"]:focus { border-color: #3498db; }
        .botoes-form { display: flex; gap: 10px; }
        .btn-salvar { 
            background: #3498db; color: white; border: none; 
            padding: 12px 25px; border-radius: 10px; cursor: pointer;
            flex: 2; font-weight: bold;
        }
        .btn-cancelar {
            background: #eee; color: #666; text-decoration: none;
            padding: 12px 25px; border-radius: 10px; text-align: center;
            flex: 1;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>O que temos pra hoje?</h2>
    <form action="/tarefas/salvar" method="POST">
        <input type="text" name="nome" placeholder="Ex: Estudar Engenharia de Software..." required autofocus>
        <div class="botoes-form">
            <button type="submit" class="btn-salvar">Adicionar</button>
            <a href="/" class="btn-cancelar">Voltar</a>
        </div>
    </form>
</div>

</body>
</html>
