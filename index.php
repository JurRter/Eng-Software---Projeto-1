<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<title>Gerenciamento de Tarefas</title>
</head>

<body>

<?php

$json = file_get_contents("tarefas.json");
$tarefas = json_decode($json, true);

if(empty($tarefas)){

    echo "<div class='vazio'>";
    echo "<h2>Nenhuma tarefa a fazer</h2>";
    echo "<a href='criar_tarefa.php'>
            <button class='botao-central'>Criar tarefa</button>
          </a>";
    echo "</div>";

}else{

    echo "<div class='container'>";

    foreach($tarefas as $tarefa){

        $classe = "";

        if($tarefa["concluida"]){
            $classe = "concluida";
        }

        echo "<div class='card $classe'>";

        echo "<h3>".$tarefa["nome"]."</h3>";

        if($tarefa["concluida"]){
            echo "<p>✅ Concluída</p>";
        }else{
            echo "<p>⏳ Pendente</p>";
        }

        echo "</div>";
    }

    echo "</div>";

    echo "<a href='criar_tarefa.php'>
            <button class='botao-criar'>Criar tarefa</button>
          </a>";
}

?>

</body>
</html>