<?php
class Pet {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function inserir($nome, $especie, $tutor_id) {
        $sql = "INSERT INTO pets (nome, especie, tutor_id) VALUES (:nome, :especie, :tutor_id)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':nome' => $nome,
            ':especie' => $especie,
            ':tutor_id' => $tutor_id
        ]);
    }

    public function listar() {
        $sql = "SELECT p.id, p.nome AS pet_nome, p.especie, 
                       t.nome AS tutor_nome,
                       (SELECT COUNT(*) FROM agendamentos a WHERE a.pet_id = p.id) AS qtd_agendamentos
                FROM pets p
                INNER JOIN tutores t ON p.tutor_id = t.id
                ORDER BY p.nome ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>