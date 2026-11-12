<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>VetSys - Cadastrar Pet</title>
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
        <a href="PetController.php" class="btn btn-outline" style="margin-bottom: 24px;">⬅ Voltar para a lista</a>
        <div class="card">
            <h2>Cadastrar Novo Pet</h2>
            <p style="color: var(--text-muted); margin-bottom: 24px;">Vincule o novo pet a um tutor existente.</p>
            <form action="PetController.php?acao=salvar" method="POST">
                <label>Nome do Pet:</label>
                <input type="text" name="nome" required>
                <label>Espécie (Cão, Gato, Ave...):</label>
                <input type="text" name="especie" required>
                <label>Tutor Responsável:</label>
                <select name="tutor_id" required>
                    <option value="">-- Selecione um Tutor --</option>
                    <?php foreach ($tutores as $t): ?>
                        <option value="<?php echo $t['id']; ?>">
                            <?php echo htmlspecialchars($t['nome']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="form-actions">
                    <button type="submit" class="btn btn-secondary">Salvar Pet</button>
                    <a href="PetController.php" class="btn btn-outline">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>