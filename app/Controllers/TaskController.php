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

    public function editar() {
        $id = $_GET['id'] ?? '';
        $tarefa = $this->model->buscarPorId($id, $this->getUsuario());
        
        if (!$tarefa) {
            $this->voltar('/'); // Se tentou editar algo que não existe, volta pra home
        }
        
        $this->view('tasks/editar', ['tarefa' => $tarefa]);
    }

    public function atualizar() {
        $id = $_POST['id'] ?? '';
        $nome = trim($_POST['nome'] ?? '');
        
        if ($id && $nome != '') {
            $this->model->atualizar($id, $nome, $this->getUsuario());
        }
        $this->voltar('/');
    }

    public function deletar() {
        $id = $_GET['id'] ?? '';
        
        if ($id) {
            $this->model->deletar($id, $this->getUsuario());
        }
        $this->voltar('/');
    }
}
