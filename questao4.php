<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>04 QUESTÃO PRÁTICA DE PHP</title>

</head>
<body>

<?php

$numeroString = "100";

$inteiro = (int) $numeroString;
$flutuante = (float) $numeroString;
$booleano = (bool) $numeroString;

var_dump($inteiro, $flutuante, $booleano);

?>

</body>
</html>