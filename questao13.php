<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>13 QUESTÃO PRÁTICA DE PHP</title>

</head>
<body>

<?php

$nomeGlobal = "Universo";

function mostrarEscopo() {
    $nomeLocal = "Planeta";
    global $nomeGlobal; // Puxa a variável de fora para dentro da função
    echo "Local: $nomeLocal | Global: $nomeGlobal";
}

mostrarEscopo();

?>

</body>
</html>