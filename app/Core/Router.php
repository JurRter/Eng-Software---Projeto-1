<?php

namespace App\Core;

// Esse sistema de rotas é bem simples, só pra ligar a URL ao controlador certo
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
        $metodoAtual = $_SERVER['REQUEST_METHOD'];
        $urlSalva = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Ajuste caso o projeto esteja rodando em subpasta
        $urlSalva = str_replace('/public', '', $urlSalva);
        if ($urlSalva == '') $urlSalva = '/';

        foreach ($this->rotas as $rota) {
            if ($rota['metodo'] === $metodoAtual && $rota['caminho'] === $urlSalva) {
                // Divide 'Controller@Metodo'
                [$classe, $metodo] = explode('@', $rota['funcao']);
                $nomeClasse = "App\\Controllers\\$classe";
                
                $obj = new $nomeClasse();
                $obj->$metodo();
                return;
            }
        }

        http_response_code(404);
        echo "Ih! Essa página não existe.";
    }
}
