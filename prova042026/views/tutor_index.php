<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>VetSys - Tutores</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .topo { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
        .search-bar { display: flex; gap: 8px; margin-bottom: 24px; }
        .search-bar input { max-width: 400px; }
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
            <h2>Lista de Tutores</h2>
            <a href="TutorController.php?acao=novo" class="btn btn-secondary">+ Novo Tutor</a>
        </div>
        <form method="GET" action="TutorController.php" class="search-bar">
            <input type="text" name="busca" placeholder="Buscar por Nome..." value="<?php echo isset($_GET['busca']) ? htmlspecialchars($_GET['busca']) : ''; ?>">
            <button type="submit" class="btn btn-primary">Buscar</button>
            <a href="TutorController.php" class="btn btn-outline">Limpar</a>
        </form>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tutores as $t): ?>
                    <tr>
                        <td><?php echo $t['id']; ?></td>
                        <td><?php echo htmlspecialchars($t['nome']); ?></td>
                        <td><?php echo htmlspecialchars($t['cpf_visivel']); ?></td>
                        <td><?php echo htmlspecialchars($t['telefone']); ?></td>
                        <td style="display: flex; gap: 8px;">
                            <a href="TutorController.php?acao=editar&id=<?php echo $t['id']; ?>" class="btn btn-primary">Editar</a>
                            <a href="TutorController.php?acao=excluir&id=<?php echo $t['id']; ?>" class="btn btn-danger" onclick="return confirm('Tem certeza?');">Excluir</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>