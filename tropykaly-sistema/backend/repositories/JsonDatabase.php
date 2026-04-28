<?php

class JsonDatabase {
    private static ?JsonDatabase $instancia = null;
    private string $arquivo = __DIR__ . '/../data/db.json';

    private function __construct() {
        if (!file_exists(__DIR__ . '/../data')) mkdir(__DIR__ . '/../data', 0777, true);
        if (!file_exists($this->arquivo)) file_put_contents($this->arquivo, json_encode([]));
    }

    public static function getInstancia(): JsonDatabase {
        if (self::$instancia === null) { self::$instancia = new JsonDatabase(); }
        return self::$instancia;
    }

    public function salvar(array $dados) {
        $atuais = json_decode(file_get_contents($this->arquivo), true) ?? [];
        $atuais[] = $dados;
        file_put_contents($this->arquivo, json_encode($atuais, JSON_PRETTY_PRINT));
    }
}
