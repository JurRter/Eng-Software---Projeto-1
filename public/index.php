<?php

require_once __DIR__ . '/../app/Core/Router.php';
require_once __DIR__ . '/../app/Core/BaseController.php';
require_once __DIR__ . '/../app/Models/TaskModel.php';
require_once __DIR__ . '/../app/Controllers/TaskController.php';

use App\Core\Router;

$app = new Router();

// Nossas rotas
$app->add('GET', '/', 'TaskController@index');
$app->add('GET', '/tarefas/criar', 'TaskController@nova');
$app->add('POST', '/tarefas/salvar', 'TaskController@salvar');
$app->add('GET', '/tarefas/concluir', 'TaskController@concluir');
$app->add('GET', '/tarefas/deletar', 'TaskController@apagar');

$app->rodar();
