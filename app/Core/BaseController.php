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
}
