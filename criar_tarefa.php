<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="criar_tarefa.css">
<title>Criar Tarefa</title>

</head>

<body>

<div class="container">

<h2>Criar Tarefa</h2>

<form method="POST">

<input type="text" name="tarefa" placeholder="Digite sua tarefa">

<button type="submit" name="salvar">
Salvar tarefa
</button>

</form>

<a href="index.php">
    <button>Voltar</button>
</a>

<?php

if(isset($_POST["salvar"])){

$tarefa = $_POST["tarefa"];

// verificar se o arquivo existe
if(file_exists("tarefas.json")){
    $json = file_get_contents("tarefas.json");
    $tarefas = json_decode($json, true);
}else{
    $tarefas = [];
}

// nova tarefa
$nova_tarefa = [
    "nome" => $tarefa,
    "concluida" => false
];

// adicionar na lista
$tarefas[] = $nova_tarefa;

// transformar em json
$json_final = json_encode($tarefas, JSON_PRETTY_PRINT);

// salvar no arquivo
file_put_contents("tarefas.json", $json_final);

echo "<p>Tarefa criada: $tarefa</p>";

}

?>

</div>

</body>
</html>