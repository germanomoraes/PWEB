<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>06 QUESTÃO PRÁTICA DE PHP</title>

</head>
<body>

<?php

$a = 10;
$b = "10";

var_dump($a == $b);  // true (os valores são iguais)
var_dump($a === $b); // false (os tipos são diferentes: int e string)
var_dump($a != $b);  // false (os valores são iguais)
var_dump($a !== $b); // true (os tipos são diferentes)

?>

</body>
</html>