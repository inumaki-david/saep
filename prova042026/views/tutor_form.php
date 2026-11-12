<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>VetSys - Formulário de Tutor</title>
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
        <a href="TutorController.php" class="btn btn-outline" style="margin-bottom: 24px;">⬅ Voltar para a lista</a>
        <div class="card">
            <h2><?php echo $tutor ? 'Editar Tutor' : 'Novo Tutor'; ?></h2>
            <p style="color: var(--text-muted); margin-bottom: 24px;">Preencha os dados abaixo com atenção.</p>
            <form action="TutorController.php?acao=salvar" method="POST">
                <input type="hidden" name="id" value="<?php echo $tutor ? $tutor['id'] : ''; ?>">
                <label>Nome Completo:</label>
                <input type="text" name="nome" value="<?php echo $tutor ? htmlspecialchars($tutor['nome']) : ''; ?>" required>
                <label>CPF:</label>
                <input type="text" name="cpf" value="<?php echo $tutor ? htmlspecialchars($tutor['cpf']) : ''; ?>" required>
                <label>Telefone:</label>
                <input type="text" name="telefone" value="<?php echo $tutor ? htmlspecialchars($tutor['telefone']) : ''; ?>">
                <?php if (!$tutor): ?>
                    <label>Senha de Acesso (Portal):</label>
                    <input type="password" name="senha" required>
                <?php endif; ?>
                <div class="form-actions">
                    <button type="submit" class="btn btn-secondary">Salvar Registro</button>
                    <a href="TutorController.php" class="btn btn-outline">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>