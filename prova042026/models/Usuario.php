<?php
class Usuario {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function autenticar($login, $senha) {
        // Busca o usuário pelo login
        $sql = "SELECT * FROM usuarios WHERE login = :login";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':login', $login);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica se o usuário existe e se a senha digitada bate com o Hash do banco
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            return $usuario; // Login válido
        }

        return false; // Falha na autenticação
    }
}
?>