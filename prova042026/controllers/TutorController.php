<?php
require_once '../config/auth.php'; // Protege a rota
require_once '../config/conexao.php';
require_once '../models/Tutor.php';

$tutorModel = new Tutor($pdo);
$acao = isset($_GET['acao']) ? $_GET['acao'] : 'listar';

switch ($acao) {
    case 'listar':
        $termo = isset($_GET['busca']) ? $_GET['busca'] : '';
        $tutores = $tutorModel->listar($termo);
        require_once '../views/tutor_index.php';
        break;

    case 'novo':
        $tutor = null; 
        require_once '../views/tutor_form.php';
        break;

    case 'editar':
        $id = $_GET['id'];
        $tutor = $tutorModel->buscarPorId($id);
        require_once '../views/tutor_form.php';
        break;

    case 'salvar':
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $telefone = $_POST['telefone'];
        
        if (empty($id)) {
            $senha = $_POST['senha'];
            $tutorModel->inserir($nome, $cpf, $telefone, $senha);
        } else {
            $tutorModel->editar($id, $nome, $cpf, $telefone);
        }
        header("Location: TutorController.php");
        break;

    case 'excluir':
        $id = $_GET['id'];
        $tutorModel->excluir($id);
        header("Location: TutorController.php");
        break;
}
?>