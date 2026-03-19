<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>12 QUESTÃO PRÁTICA DE PHP</title>

</head>
<body>

<?php

$texto = "Estou estudando Programação Web";

echo strtoupper($texto) . "<br>"; // Tudo maiúsculo
echo strtolower($texto) . "<br>"; // Tudo minúsculo
echo "Tamanho: " . strlen($texto) . "<br>"; // Conta caracteres
echo str_replace("Web", "PHP", $texto) . "<br>"; // Troca palavras

?>

</body>
</html>