<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>11 QUESTÃO PRÁTICA DE PHP</title>

</head>
<body>

<?php

$alunos = [
    ["nome" => "Germano", "nota" => 8.0],
    ["nome" => "Gustavo", "nota" => 9.5]
];

echo "A nota da " . $alunos[1]["nome"] . " é " . $alunos[1]["nota"];

?>

</body>
</html>