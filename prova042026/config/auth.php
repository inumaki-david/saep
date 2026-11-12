<?php
session_start();

header('Content-Type: text/html; charset=utf-8');
// Define o tempo máximo de inatividade (ex: 15 minutos = 900 segundos)
$tempo_expiracao = 900; 

// Verifica se o usuário NÃO está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: LoginController.php");
    exit;
}

// Verifica se a sessão expirou por inatividade
if (isset($_SESSION['ultimo_acesso'])) {
    $tempo_inativo = time() - $_SESSION['ultimo_acesso'];
    
    if ($tempo_inativo > $tempo_expiracao) {
        // Destrói a sessão e redireciona com mensagem de erro
        session_unset();
        session_destroy();
        header("Location: LoginController.php?msg=expirado");
        exit;
    }
}

// Atualiza o tempo de acesso para que a contagem reinicie a cada clique do usuário
$_SESSION['ultimo_acesso'] = time();
?>