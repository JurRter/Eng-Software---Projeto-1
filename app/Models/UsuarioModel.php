<?php

namespace App\Models;

class UsuarioModel {
    private $arquivoJson = __DIR__ . '/../../usuarios.json';

    public function __construct() {
        // Se o arquivo não existir, cria com os usuários padrão do seu amigo
        if (!file_exists($this->arquivoJson)) {
            $padrao = [
                ["nome" => "admin", "senha" => password_hash("admin123", PASSWORD_DEFAULT)],
                ["nome" => "user", "senha" => password_hash("user123", PASSWORD_DEFAULT)]
            ];
            $this->salvar($padrao);
        }
    }

    public function carregarUsuarios() {
        $conteudo = file_get_contents($this->arquivoJson);
        $usuarios = json_decode($conteudo, true);
        return is_array($usuarios) ? $usuarios : [];
    }

    public function buscarPorNome($nome) {
        $usuarios = $this->carregarUsuarios();
        foreach ($usuarios as $u) {
            if ($u['nome'] === $nome) return $u;
        }
        return null;
    }

    public function CriarUsuario($nome, $senha) {
        $usuarios = $this->carregarUsuarios();
        $usuarios[] = [
            "nome" => $nome,
            "senha" => password_hash($senha, PASSWORD_DEFAULT)
        ];
        $this->salvar($usuarios);
    }

    private function salvar($dados) {
        file_put_contents($this->arquivoJson, json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}
