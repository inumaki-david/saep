<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>VetSys - Novo Agendamento</title>
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
            <h2>Cadastrar Novo Agendamento</h2>
            <p style="color: var(--text-muted); margin-bottom: 24px;">Selecione o paciente e defina a data da consulta.</p>
            <form action="AgendamentoController.php?acao=salvar_novo" method="POST">
                <label>Paciente (Pet e Tutor):</label>
                <select name="pet_tutor" required>
                    <option value="">-- Selecione o Paciente --</option>
                    <?php foreach ($pets as $p): ?>
                        <option value="<?php echo $p['pet_id'] . '|' . $p['tutor_id']; ?>">
                            <?php echo htmlspecialchars($p['pet_nome'] . ' (Dono: ' . $p['tutor_nome'] . ')'); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label>Data e Hora da Consulta:</label>
                <input type="datetime-local" name="data_agendamento" required>
                <label>Motivo da Consulta:</label>
                <textarea name="motivo" rows="4" placeholder="Ex: Vacina V10, Consulta de rotina..." required></textarea>
                <div class="form-actions">
                    <button type="submit" class="btn btn-secondary">Salvar Agendamento</button>
                    <a href="AgendamentoController.php" class="btn btn-outline">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>