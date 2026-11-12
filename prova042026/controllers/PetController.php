<?php
require_once '../config/auth.php';
require_once '../config/conexao.php';
require_once '../models/Pet.php';
require_once '../models/Tutor.php'; 

$petModel = new Pet($pdo);
$tutorModel = new Tutor($pdo);

$acao = isset($_GET['acao']) ? $_GET['acao'] : 'listar';

switch ($acao) {
    case 'listar':
        $pets = $petModel->listar();
        require_once '../views/pet_index.php';
        break;

    case 'novo':
        $tutores = $tutorModel->listar();
        require_once '../views/pet_form.php';
        break;

    case 'salvar':
        $nome = $_POST['nome'];
        $especie = $_POST['especie'];
        $tutor_id = $_POST['tutor_id'];
        
        $petModel->inserir($nome, $especie, $tutor_id);
        
        header("Location: PetController.php");
        break;
}
?>