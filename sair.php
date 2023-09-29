<?php
session_start();

// Destruir variáveis de sessão
session_destroy();

// Destruir cookies
setcookie("nome", "", time()-3600);

// Redirecionar para a página de login
header('Location: index.php');
?>
