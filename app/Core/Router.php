<?php

namespace App\Core;

// O roteador associa a URL ao Controller certo
class Router {
    protected $rotas = [];

    public function add($metodo, $caminho, $funcao) {
        $this->rotas[] = [
            'metodo'  => $metodo,
            'caminho' => $caminho,
            'funcao'  => $funcao
        ];
    }

    public function rodar() {
        $metodo = $_SERVER['REQUEST_METHOD'];
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        if ($url == '') $url = '/';

        $arquivo = __DIR__ . '/../../' . ltrim($url, '/');
        if ($url !== '/' && file_exists($arquivo) && !is_dir($arquivo)) {
            return false;
        }

        foreach ($this->rotas as $r) {
            if ($r['metodo'] === $metodo && $r['caminho'] === $url) {
                [$classe, $acao] = explode('@', $r['funcao']);
                $nomeClasse = "App\\Controllers\\$classe";
                
                $obj = new $nomeClasse();
                $obj->$acao();
                return;
            }
        }

        http_response_code(404);
        echo "404 - Essa página não existe.";
    }
}
