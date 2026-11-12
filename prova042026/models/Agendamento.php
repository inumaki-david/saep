<?php
class Agendamento {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function listarOrdenado() {
        $sql = "SELECT a.id, a.data_agendamento, a.motivo, 
                       t.nome AS tutor_nome, p.nome AS pet_nome 
                FROM agendamentos a
                INNER JOIN tutores t ON a.tutor_id = t.id
                INNER JOIN pets p ON a.pet_id = p.id
                ORDER BY a.data_agendamento ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $sql = "SELECT * FROM agendamentos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarData($id, $nova_data) {
        $sql = "UPDATE agendamentos SET data_agendamento = :nova_data WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':nova_data' => $nova_data,
            ':id' => $id
        ]);
    }

    public function inserir($data_agendamento, $tutor_id, $pet_id, $motivo) {
        $sql = "INSERT INTO agendamentos (data_agendamento, tutor_id, pet_id, motivo) 
                VALUES (:data, :tutor_id, :pet_id, :motivo)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':data' => $data_agendamento,
            ':tutor_id' => $tutor_id,
            ':pet_id' => $pet_id,
            ':motivo' => $motivo
        ]);
    }

    public function listarPetsComTutores() {
        $sql = "SELECT p.id AS pet_id, p.nome AS pet_nome, p.tutor_id, t.nome AS tutor_nome 
                FROM pets p 
                INNER JOIN tutores t ON p.tutor_id = t.id 
                ORDER BY p.nome";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>