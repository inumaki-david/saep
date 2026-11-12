<?php
// controllers/AgendamentoController.php
require_once '../config/auth.php';
require_once '../config/conexao.php';
require_once '../models/Agendamento.php';

$agendamentoModel = new Agendamento($pdo);
$acao = isset($_GET['acao']) ? $_GET['acao'] : 'listar';

switch ($acao) {
    case 'listar':
        $agendamentos = $agendamentoModel->listarOrdenado();
        require_once '../views/agendamento_index.php';
        break;

    case 'novo':
        $pets = $agendamentoModel->listarPetsComTutores();
        require_once '../views/agendamento_form.php';
        break;

    case 'salvar_novo':
        $data_agendamento = $_POST['data_agendamento'];
        $motivo = $_POST['motivo'];
        
        list($pet_id, $tutor_id) = explode('|', $_POST['pet_tutor']);
        
        $agendamentoModel->inserir($data_agendamento, $tutor_id, $pet_id, $motivo);
        header("Location: AgendamentoController.php");
        break;

    case 'editar_data':
        $id = $_GET['id'];
        $agendamento = $agendamentoModel->buscarPorId($id);
        require_once '../views/agendamento_data_form.php';
        break;

    case 'salvar_data':
        $id = $_POST['id'];
        $nova_data = $_POST['data_agendamento'];
        
        $agendamentoModel->atualizarData($id, $nova_data);
        header("Location: AgendamentoController.php");
        break;
}
?>