<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>15 QUESTÃO PRÁTICA DE PHP</title>

</head>
<body>

<?php

class Carro {
    public $cor;
    
    public function acelerar() {
        return "Vrum vrum!";
    }
}

$meuCarro = new Carro();
$meuCarro->cor = "Preto";

echo "Meu carro " . $meuCarro->cor . " faz: " . $meuCarro->acelerar();

?>

</body>
</html>