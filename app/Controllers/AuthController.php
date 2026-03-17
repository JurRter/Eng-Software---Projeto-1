<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Models\UsuarioModel;

class AuthController extends BaseController {
    private $model;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->model = new UsuarioModel();
    }

    public function login() {
        $this->view('auth/login');
    }

    public function autenticar() {
        $nome = trim($_POST['nome'] ?? '');
        $senha = trim($_POST['senha'] ?? '');
        
        $usuario = $this->model->buscarPorNome($nome);
        
        if ($usuario && (password_verify($senha, $usuario['senha']) || $senha === $usuario['senha'])) {
            $_SESSION['logado'] = true;
            $_SESSION['usuario'] = $nome;
            $this->voltar('/');
        } else {
            $msg = !$usuario ? "Usuário não existe" : "Senha incorreta";
            $this->view('auth/login', ['mensagem' => $msg]);
        }
    }

    public function registro() {
        $this->view('auth/registro');
    }

    public function registrar() {
        $nome = trim($_POST['nome'] ?? '');
        $senha = trim($_POST['senha'] ?? '');

        if ($nome == '' || $senha == '') {
            $this->view('auth/registro', ['mensagem' => 'Preencha todos os campos!']);
            return;
        }

        if ($this->model->buscarPorNome($nome)) {
            $this->view('auth/registro', ['mensagem' => 'Esse usuário já existe.']);
            return;
        }

        $this->model->cadastrar($nome, $senha);
        $_SESSION['cadastro_sucesso'] = "Conta cadastrada! Pode logar.";
        $this->voltar('/login');
    }

    public function logout() {
        session_destroy();
        $this->voltar('/login');
    }
}
