<?php

namespace App\Core;

// Controlador pai pra carregar as views e redirecionar
class BaseController {
    protected function view($nome, $dados = []) {
        extract($dados);
        require_once __DIR__ . "/../Views/$nome.php";
    }

    protected function voltar($url) {
        header("Location: $url");
        exit;
    }

    // Proteção para o nosso board
    protected function precisaLogar() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (empty($_SESSION['logado'])) {
            $this->voltar('/login');
        }
    }
}
