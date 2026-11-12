<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>VetSys - Agendamentos</title>
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
            <h2>Agendamentos Cadastrados</h2>
            <a href="AgendamentoController.php?acao=novo" class="btn btn-secondary">+ Novo Agendamento</a>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Data e Hora</th>
                        <th>Tutor</th>
                        <th>Pet</th>
                        <th>Motivo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($agendamentos as $a): ?>
                    <tr>
                        <td><?php echo date('d/m/Y H:i', strtotime($a['data_agendamento'])); ?></td>
                        <td><?php echo htmlspecialchars($a['tutor_nome']); ?></td>
                        <td><?php echo htmlspecialchars($a['pet_nome']); ?></td>
                        <td><?php echo htmlspecialchars($a['motivo']); ?></td>
                        <td>
                            <a href="AgendamentoController.php?acao=editar_data&id=<?php echo $a['id']; ?>" class="btn btn-primary">Alterar Data</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>