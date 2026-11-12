<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>VetSys - Painel Principal</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .dashboard-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 24px; margin-top: 32px; }
        .dash-card { text-align: center; text-decoration: none; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 160px; transition: all 0.3s; }
        .dash-card:hover { border-color: var(--primary); transform: translateY(-4px); }
        .dash-icon { font-size: 40px; margin-bottom: 12px; }
        .dash-title { font-family: 'Plus Jakarta Sans'; font-size: 16px; color: var(--text-main); }
    </style>
</head>
<body>
    <!-- Cabeçalho Global -->
    <div class="header">
        <a href="DashboardController.php">
            <h1><span style="color: var(--primary);">VetSys</span></h1>
        </a>
        <div>
            <span style="margin-right: 16px; color: var(--text-muted);">Olá, <strong><?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></strong></span>
            <a href="LoginController.php?acao=sair" class="btn btn-outline">Sair</a>
        </div>
    </div>

    <div class="container">
        <h2>Painel de Controle</h2>
        <p style="color: var(--text-muted);">Selecione o módulo que deseja gerenciar hoje.</p>
        <div class="dashboard-grid">
            <a href="TutorController.php" class="card dash-card">
                <div class="dash-icon">👤</div>
                <div class="dash-title">Gerenciar Tutores</div>
            </a>
            <a href="PetController.php" class="card dash-card">
                <div class="dash-icon">🐾</div>
                <div class="dash-title">Gerenciar Pets</div>
            </a>
            <a href="AgendamentoController.php" class="card dash-card">
                <div class="dash-icon">📅</div>
                <div class="dash-title">Agendamentos</div>
            </a>
        </div>
    </div>
</body>
</html>