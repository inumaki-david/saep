<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VetSys - Login</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body { display: flex; justify-content: center; align-items: center; height: 100vh; }
        .login-card { width: 100%; max-width: 360px; text-align: center; }
        .login-card h2 { margin-bottom: 8px; color: var(--primary); }
        .login-card p { color: var(--text-muted); margin-bottom: 24px; }
        .login-card button { width: 100%; margin-top: 24px; }
        .erro { background: var(--danger); color: var(--danger-text); padding: 12px; border-radius: var(--radius-btn); margin-bottom: 16px; font-size: 14px; }
    </style>
</head>
<body>
    <div class="card login-card">
        <h2>VetSys</h2>
        <p>Acesso Restrito</p>
        
        <?php if (isset($_SESSION['erro'])): ?>
            <div class="erro"><?php echo $_SESSION['erro']; unset($_SESSION['erro']); ?></div>
        <?php endif; ?>
        <?php if (isset($_GET['msg']) && $_GET['msg'] === 'expirado'): ?>
            <div class="erro">Sessão expirada. Faça login novamente.</div>
        <?php endif; ?>

        <form action="../controllers/LoginController.php" method="POST">
            <label style="text-align: left;">Usuário</label>
            <input type="text" name="login" required>
            
            <label style="text-align: left;">Senha</label>
            <input type="password" name="senha" required>
            
            <button type="submit" class="btn btn-primary">Entrar no Sistema</button>
        </form>
    </div>
</body>
</html>