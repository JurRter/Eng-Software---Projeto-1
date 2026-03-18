<?php

require_once __DIR__ . '/app/Core/Router.php';
require_once __DIR__ . '/app/Core/BaseController.php';
require_once __DIR__ . '/app/Models/TaskModel.php';
require_once __DIR__ . '/app/Models/UsuarioModel.php';
require_once __DIR__ . '/app/Controllers/TaskController.php';
require_once __DIR__ . '/app/Controllers/AuthController.php';

use App\Core\Router;

$app = new Router();

// Rotas de Tarefas
$app->add('GET', '/', 'TaskController@index');
$app->add('GET', '/tarefas/criar', 'TaskController@nova');
$app->add('POST', '/tarefas/salvar', 'TaskController@salvar');
$app->add('GET', '/tarefas/concluir', 'TaskController@concluir');

// Rotas de Usuário
$app->add('GET', '/login', 'AuthController@login');
$app->add('POST', '/login', 'AuthController@autenticar');
$app->add('GET', '/registro', 'AuthController@registro');
$app->add('POST', '/registro', 'AuthController@registrar');
$app->add('GET', '/logout', 'AuthController@logout');

$app->rodar();