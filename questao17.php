<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>17 QUESTÃO PRÁTICA DE PHP</title>

</head>
<body>

<?php

$testeBooleano = true;

$paraInt = (int) $testeBooleano;
$paraString = (string) $testeBooleano;
$paraFloat = (float) $testeBooleano;

var_dump($paraInt, $paraString, $paraFloat);

?>

</body>
</html>