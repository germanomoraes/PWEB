<?php
session_start();
function validar($d) { return !empty($d); } // Função de validação 

// Armazenamento temporário em array na sessão 
if (!isset($_SESSION['lista'])) $_SESSION['lista'] = [];

if (isset($_POST['item']) && validar($_POST['item'])) {
    array_push($_SESSION['lista'], $_POST['item']);
}
?>
<h3>Mini Sistema de Registros</h3>
<form method="POST">
    <input type="text" name="item" placeholder="Novo Registro">
    <button>Cadastrar</button>
</form>

<ul>
    <?php foreach ($_SESSION['lista'] as $res) echo "<li>$res</li>"; ?> </ul>  

