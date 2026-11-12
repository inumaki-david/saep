<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>VetSys - Pets</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .topo { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
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

    <div class="container">
        <div class="topo">
            <h2>Lista de Pets</h2>
            <a href="PetController.php?acao=novo" class="btn btn-secondary">+ Novo Pet</a>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome do Pet</th>
                        <th>Espécie</th>
                        <th>Tutor Responsável</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pets as $p): ?>
                    <tr>
                        <td><?php echo $p['id']; ?></td>
                        <td><?php echo htmlspecialchars($p['pet_nome']); ?></td>
                        <td><?php echo htmlspecialchars($p['especie']); ?></td>
                        <td><?php echo htmlspecialchars($p['tutor_nome']); ?></td>
                        <td>
                            <?php if ($p['qtd_agendamentos'] > 0): ?>
                                <span class="badge badge-active">Possui Consulta(s)</span>
                            <?php else: ?>
                                <span class="badge badge-neutral">Sem Agendamentos</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>