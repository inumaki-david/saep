<?php
session_start();
require_once '../config/conexao.php';
require_once '../models/Usuario.php';

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
        $_SESSION['usuario_id'] = $usuarioLogado['id'];
        $_SESSION['usuario_nome'] = $usuarioLogado['nome'];
        
        $_SESSION['ultimo_acesso'] = time(); 
        header("Location: DashboardController.php");
        exit;
    } else {
        $_SESSION['erro'] = "Login ou senha inválidos. Tente novamente.";
    }
}

require_once '../views/login.php';
?>