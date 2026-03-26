<?php
// Requisito: Receber via POST e verificar campos 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['nome']) || empty($_POST['email'])) {
        echo "<b style='color:red;'>Erro: Preencha todos os campos!</b>"; 
    } else {
        echo "<h3>Dados Cadastrados:</h3>"; 
        echo "Nome: " . $_POST['nome'] . "<br>Email: " . $_POST['email'];
    }
}
?>
<form method="POST">
    <input type="text" name="nome" placeholder="Nome">
    <input type="email" name="email" placeholder="E-mail">
    <button type="submit">Enviar</button>
</form>