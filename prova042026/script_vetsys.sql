SET client_encoding = 'UTF8';

-- Tabela de Usuários (Funcionários da Clínica)
CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    login VARCHAR(50) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL
);

-- Tabela de Tutores
CREATE TABLE tutores (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(255) UNIQUE NOT NULL,
    telefone VARCHAR(20),
    senha VARCHAR(255) NOT NULL
);

-- Tabela de Pets (Associada ao Tutor)
CREATE TABLE pets (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    especie VARCHAR(50) NOT NULL,
    tutor_id INT NOT NULL,
    FOREIGN KEY (tutor_id) REFERENCES tutores(id) ON DELETE CASCADE
);

-- Tabela de Agendamentos (Associada ao Tutor e ao Pet)
CREATE TABLE agendamentos (
    id SERIAL PRIMARY KEY,
    data_agendamento TIMESTAMP NOT NULL,
    tutor_id INT NOT NULL,
    pet_id INT NOT NULL,
    motivo TEXT,
    FOREIGN KEY (tutor_id) REFERENCES tutores(id) ON DELETE CASCADE,
    FOREIGN KEY (pet_id) REFERENCES pets(id) ON DELETE CASCADE
);


INSERT INTO usuarios (nome, login, senha) VALUES
('Administrador Geral', 'admin', '$2y$12$az1CtlrCWhFISPCXNgNIje7VQJoSu1XsWw5FVHXkee9RLfbrH7jke'),
('João Veterinário', 'joao.vet', '$2y$12$az1CtlrCWhFISPCXNgNIje7VQJoSu1XsWw5FVHXkee9RLfbrH7jke'),
('Maria Recepcionista', 'maria.rec', '$2y$12$az1CtlrCWhFISPCXNgNIje7VQJoSu1XsWw5FVHXkee9RLfbrH7jke');


-- O CPF simula uma string já criptografada via OpenSSL (AES-256-CBC) no PHP.
INSERT INTO tutores (nome, cpf, telefone, senha) VALUES
('Carlos Silva', '1NI2uD3OEzOBxpigWVjrTw==', '19999999991', '$2y$12$az1CtlrCWhFISPCXNgNIje7VQJoSu1XsWw5FVHXkee9RLfbrH7jke'),
('Ana Souza', 'UmL7ebrV23gfZhzRdtv7nQ==', '19999999992', '$2y$12$az1CtlrCWhFISPCXNgNIje7VQJoSu1XsWw5FVHXkee9RLfbrH7jke'),
('Pedro Santos', 'XE1fDTuq+6C3/eiSe+sEvg==', '19999999993', '$2y$12$az1CtlrCWhFISPCXNgNIje7VQJoSu1XsWw5FVHXkee9RLfbrH7jke');


INSERT INTO pets (nome, especie, tutor_id) VALUES
('Rex', 'Cão', 1),
('Mimi', 'Gato', 2),
('Louro', 'Ave', 3);

INSERT INTO agendamentos (data_agendamento, tutor_id, pet_id, motivo) VALUES
('2026-11-15 10:00:00', 1, 1, 'Consulta de Rotina e Vacina V10'),
('2026-11-16 14:30:00', 2, 2, 'Agendamento de Castração'),
('2026-11-17 09:00:00', 3, 3, 'Aparar asas e unhas');