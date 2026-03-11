<?php

    $json = file_get_contents("tarefas.json");

    $tarefas = json_decode($json, true);


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





?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


    <a href="criar_tarefa.php">
        <button>Criar tarefa</button>
    </a>



</body>
</html>

