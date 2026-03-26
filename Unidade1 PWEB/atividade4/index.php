<?php
if (isset($_POST['nome'])) {
    // Cria cookie por 7 dias 
    setcookie("visita", $_POST['nome'], time() + (7 * 24 * 60 * 60));
    header("Refresh:0");
}

if (isset($_COOKIE['visita'])) {
    echo "<h1>Bem-vindo de volta, " . $_COOKIE['visita'] . "!</h1>"; 
} else {
    echo '<form method="POST"><input type="text" name="nome" placeholder="Seu nome"><button>Salvar</button></form>'; 
}
?>