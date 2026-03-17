<?php

namespace App\Models;

class TaskModel {
    private $arquivoJson = __DIR__ . '/../../tarefas.json';

    // Pega as tarefas FILTRADAS por usuário
    public function todos($usuarioLogado) {
        if (!file_exists($this->arquivoJson)) return [];
        $conteudo = file_get_contents($this->arquivoJson);
        $lista = json_decode($conteudo, true);
        if (!is_array($lista)) return [];

        // Filtra para mostrar só o que é desse usuário
        $listaFiltrada = array_filter($lista, function($item) use ($usuarioLogado) {
            return ($item['usuario'] ?? '') === $usuarioLogado;
        });

        usort($listaFiltrada, function($a, $b) {
            return ($a["concluida"] ?? false) <=> ($b["concluida"] ?? false);
        });
        
        return array_values($listaFiltrada);
    }

    public function criar($nome, $usuarioLogado) {
        $listaInteira = $this->carregarTudo();
        $listaInteira[] = [
            "id" => uniqid(),
            "usuario" => $usuarioLogado, // Salva quem criou
            "nome" => $nome,
            "concluida" => false
        ];
        $this->salvarNoArquivo($listaInteira);
    }

    public function toggle($id, $usuarioLogado) {
        $listaInteira = $this->carregarTudo();
        foreach ($listaInteira as &$item) {
            // Só muda se o ID bater E for do usuário logado (segurança)
            if (isset($item['id']) && $item['id'] == $id && ($item['usuario'] ?? '') === $usuarioLogado) {
                $item['concluida'] = !($item['concluida'] ?? false);
                break;
            }
        }
        $this->salvarNoArquivo($listaInteira);
    }

    public function excluir($id, $usuarioLogado) {
        $listaInteira = $this->carregarTudo();
        $novaLista = array_filter($listaInteira, function($item) use ($id, $usuarioLogado) {
            // Mantém se: Não for o ID que queremos apagar OU não for desse usuário
            return ($item['id'] ?? '') !== $id || ($item['usuario'] ?? '') !== $usuarioLogado;
        });
        $this->salvarNoArquivo(array_values($novaLista));
    }

    private function carregarTudo() {
        if (!file_exists($this->arquivoJson)) return [];
        $conteudo = file_get_contents($this->arquivoJson);
        return json_decode($conteudo, true) ?: [];
    }

    private function salvarNoArquivo($dados) {
        file_put_contents($this->arquivoJson, json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}
