<?php

namespace App\Models;

class TaskModel {
    private $arquivoJson = __DIR__ . '/../../tarefas.json';

    // Pega tudo do JSON e já ordena
    public function todos() {
        if (!file_exists($this->arquivoJson)) return [];
        
        $conteudo = file_get_contents($this->arquivoJson);
        $lista = json_decode($conteudo, true);
        
        // Deixa as não concluídas em cima
        usort($lista, function($a, $b) {
            return $a["concluida"] <=> $b["concluida"];
        });
        
        return $lista;
    }

    public function criar($nome) {
        $lista = $this->todos();
        $lista[] = [
            "id" => uniqid(),
            "nome" => $nome,
            "concluida" => false
        ];
        $this->salvarNoArquivo($lista);
    }

    public function toggle($id) {
        $lista = $this->todos();
        foreach ($lista as &$item) {
            if ($item['id'] == $id) {
                $item['concluida'] = !$item['concluida'];
                break;
            }
        }
        $this->salvarNoArquivo($lista);
    }

    public function excluir($id) {
        $lista = $this->todos();
        $novaLista = array_filter($lista, function($item) use ($id) {
            return $item['id'] !== $id;
        });
        $this->salvarNoArquivo(array_values($novaLista));
    }

    private function salvarNoArquivo($dados) {
        file_put_contents($this->arquivoJson, json_encode($dados, JSON_PRETTY_PRINT));
    }
}
