<?php
session_start(); 
// Usuário e senha fixos 
if ($_POST['user'] == 'admin' && $_POST['pass'] == '1234') {
    $_SESSION['logado'] = true; 
    header("Location: painel.php"); 
}
?>
<form method="POST">
    <input type="text" name="user" placeholder="Usuário">
    <input type="password" name="pass" placeholder="Senha">
    <button type="submit">Logar</button>
</form>