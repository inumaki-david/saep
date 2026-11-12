<?php
class Tutor {
    private $pdo;
    
    // Chaves de criptografia para o OpenSSL (AES-256-CBC)
    private $chave = 'chave_secreta_vetsys_2026';
    private $iv = '1234567890123456'; // O IV (Initialization Vector) precisa ter 16 bytes

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Função auxiliar para criptografar o CPF
    private function criptografarCPF($cpf) {
        return openssl_encrypt($cpf, 'aes-256-cbc', $this->chave, 0, $this->iv);
    }

    // Função auxiliar para descriptografar o CPF
    private function descriptografarCPF($cpfCriptografado) {
        return openssl_decrypt($cpfCriptografado, 'aes-256-cbc', $this->chave, 0, $this->iv);
    }

    // Critérios 5.3 e 5.4: Inserir com criptografia de Senha e CPF
    public function inserir($nome, $cpf, $telefone, $senha) {
        $cpfSeguro = $this->criptografarCPF($cpf);
        $senhaSegura = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO tutores (nome, cpf, telefone, senha) VALUES (:nome, :cpf, :telefone, :senha)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':nome' => $nome,
            ':cpf' => $cpfSeguro,
            ':telefone' => $telefone,
            ':senha' => $senhaSegura
        ]);
    }

    // Critérios 5.1 e 5.2: Listar com opção de Busca
    public function listar($termoBusca = '') {
        if (!empty($termoBusca)) {
            // Busca pelo nome ignorando maiúsculas/minúsculas (ILIKE no PostgreSQL)
            $sql = "SELECT * FROM tutores WHERE nome ILIKE :busca ORDER BY nome";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':busca' => "%$termoBusca%"]);
        } else {
            $sql = "SELECT * FROM tutores ORDER BY nome";
            $stmt = $this->pdo->query($sql);
        }
        
        $tutores = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Descriptografa o CPF de cada tutor antes de mandar para a View
        foreach ($tutores as &$tutor) {
            $tutor['cpf_visivel'] = $this->descriptografarCPF($tutor['cpf']);
        }
        return $tutores;
    }

    // Busca um tutor específico para edição
    public function buscarPorId($id) {
        $sql = "SELECT * FROM tutores WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $tutor = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($tutor) {
            // Entrega o CPF descriptografado para preencher o formulário
            $tutor['cpf'] = $this->descriptografarCPF($tutor['cpf']); 
        }
        return $tutor;
    }

    // Critério 5.5: Editar Tutor
    public function editar($id, $nome, $cpf, $telefone) {
        $cpfSeguro = $this->criptografarCPF($cpf);
        $sql = "UPDATE tutores SET nome = :nome, cpf = :cpf, telefone = :telefone WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':nome' => $nome,
            ':cpf' => $cpfSeguro,
            ':telefone' => $telefone,
            ':id' => $id
        ]);
    }

    // Critério 5.1: Excluir Tutor
    public function excluir($id) {
        $sql = "DELETE FROM tutores WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
?>