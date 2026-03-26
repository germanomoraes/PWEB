<?php
// Requisito: Criar pelo menos uma função 
function calcularSituacao($n) {
    if ($n >= 7) return "Aprovado"; 
    if ($n >= 5) return "Recuperação"; 
    return "Reprovado"; // 
}

$nota = 8; // Simulação de nota 
$situacao = calcularSituacao($nota);
?>
<!DOCTYPE html>
<html>
<body>
    <h2>Situação: <?php echo $situacao; ?></h2>
    <p>Contagem de notas:</p>
    <?php 
    // Requisito: Estrutura de repetição 
    for ($i = 0; $i <= $nota; $i++) { echo "$i "; } 
    ?>
</body>
</html>