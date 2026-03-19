<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>18 QUESTÃO PRÁTICA DE PHP</title>

</head>
<body>

<?php

$variavelVazia = "";
$variavelNula = null;

// isset: verifica se a variável existe e não é nula
var_dump(isset($variavelVazia)); // true
var_dump(isset($variavelNula));  // false

// empty: verifica se está vazia ("" , 0, null, false)
var_dump(empty($variavelVazia)); // true
?>

</body>
</html>