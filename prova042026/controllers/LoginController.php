<?php
session_start();
require_once '../config/conexao.php';
require_once '../models/Usuario.php';

// Se o usuário clicou em "Sair" (Logout)
if (isset($_GET['acao']) && $_GET['acao'] === 'sair') {
    session_unset();
    session_destroy();
    header("Location: LoginController.php");
    exit;
}

// Se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login']);
    $senha = trim($_POST['senha']);

    $usuarioModel = new Usuario($pdo);
    $usuarioLogado = $usuarioModel->autenticar($login, $senha);

    if ($usuarioLogado) {
        // Sucesso: Cria a sessão do usuário
        $_SESSION['usuario_id'] = $usuarioLogado['id'];
        $_SESSION['usuario_nome'] = $usuarioLogado['nome'];
        
        // Critério 3.2: Tempo de expiração (Define o tempo atual do login)
        $_SESSION['ultimo_acesso'] = time(); 

        // Critério 3.1: Redireciona para o módulo principal
        header("Location: DashboardController.php");
        exit;
    } else {
        // Falha: Cria uma mensagem de erro
        $_SESSION['erro'] = "Login ou senha inválidos. Tente novamente.";
    }
}

// Se não for POST ou se deu erro, carrega a View de Login
require_once '../views/login.php';
?>