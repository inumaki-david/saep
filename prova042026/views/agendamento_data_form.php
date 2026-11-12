<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>VetSys - Alterar Data</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .form-wrapper { max-width: 600px; margin: 40px auto; }
        .form-actions { display: flex; gap: 12px; margin-top: 24px; }
    </style>
</head>
<body>
    <div class="header">
        <a href="DashboardController.php">
            <h1><span style="color: var(--primary);">VetSys</span></h1>
        </a>
        <div>
            <span style="margin-right: 16px; color: var(--text-muted);">Olá, <strong><?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></strong></span>
            <a href="LoginController.php?acao=sair" class="btn btn-outline">Sair</a>
        </div>
    </div>

    <div class="container form-wrapper">
        <a href="AgendamentoController.php" class="btn btn-outline" style="margin-bottom: 24px;">⬅ Voltar para a lista</a>
        <div class="card">
            <h2>Alterar Data do Agendamento</h2>
            <form action="AgendamentoController.php?acao=salvar_data" method="POST">
                <input type="hidden" name="id" value="<?php echo $agendamento['id']; ?>">
                <label>Nova Data e Hora:</label>
                <input type="datetime-local" name="data_agendamento" value="<?php echo date('Y-m-d\TH:i', strtotime($agendamento['data_agendamento'])); ?>" required>
                <div class="form-actions">
                    <button type="submit" class="btn btn-secondary">Salvar Nova Data</button>
                    <a href="AgendamentoController.php" class="btn btn-outline">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>