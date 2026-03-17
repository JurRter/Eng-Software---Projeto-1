<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Models\TaskModel;

class TaskController extends BaseController {
    private $model;

    public function __construct() {
        $this->precisaLogar();
        $this->model = new TaskModel();
    }

    private function getUsuario() {
        return $_SESSION['usuario'] ?? '';
    }

    public function index() {
        $tarefas = $this->model->todos($this->getUsuario());
        $this->view('tasks/index', ['tarefas' => $tarefas]);
    }

    public function nova() {
        $this->view('tasks/create');
    }

    public function salvar() {
        $nome = trim($_POST['nome'] ?? '');
        if ($nome != '') {
            $this->model->criar($nome, $this->getUsuario());
        }
        $this->voltar('/');
    }

    public function concluir() {
        $id = $_GET['id'] ?? '';
        if ($id != '') {
            $this->model->toggle($id, $this->getUsuario());
        }
        $this->voltar('/');
    }

    public function apagar() {
        $id = $_GET['id'] ?? '';
        if ($id != '') {
            $this->model->excluir($id, $this->getUsuario());
        }
        $this->voltar('/');
    }
}
