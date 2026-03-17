<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Models\TaskModel;

class TaskController extends BaseController {
    private $model;

    public function __construct() {
        $this->precisaLogar(); // Agora tem que estar logado!
        $this->model = new TaskModel();
    }

    public function index() {
        $tarefas = $this->model->todos();
        $this->view('tasks/index', ['tarefas' => $tarefas]);
    }

    public function nova() {
        $this->view('tasks/create');
    }

    public function salvar() {
        $nome = $_POST['nome'] ?? '';
        if ($nome != '') {
            $this->model->criar($nome);
        }
        $this->voltar('/');
    }

    public function concluir() {
        $id = $_GET['id'] ?? '';
        if ($id != '') {
            $this->model->toggle($id);
        }
        $this->voltar('/');
    }

    public function apagar() {
        $id = $_GET['id'] ?? '';
        if ($id != '') {
            $this->model->excluir($id);
        }
        $this->voltar('/');
    }
}
