<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>14 QUESTÃO PRÁTICA DE PHP</title>

</head>
<body>

<?php

function contar() {
    static $numero = 0; // O valor não é resetado quando a função termina
    $numero++;
    echo "$numero ";
}

contar();
contar();
contar();

?>

</body>
</html>