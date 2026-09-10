-- CREATE DATABASE saep_agendamento_db;

-- Execute os comandos abaixo conectado ao banco saep_agendamento_db.
CREATE TABLE IF NOT EXISTS usuarios (
  id SERIAL PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  senha VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS clientes (
  id SERIAL PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  documento VARCHAR(20) UNIQUE NOT NULL,
  telefone VARCHAR(20) NOT NULL
);

CREATE TABLE IF NOT EXISTS recursos (
  id SERIAL PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  descricao VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS agendamentos (
  id SERIAL PRIMARY KEY,
  cliente_id INT NOT NULL REFERENCES clientes(id) ON DELETE RESTRICT,
  recurso_id INT NOT NULL REFERENCES recursos(id) ON DELETE RESTRICT,
  data_agendamento DATE NOT NULL,
  hora_agendamento TIME NOT NULL,
  hora_saida_agendamento TIME NOT NULL,
  CHECK (hora_saida_agendamento > hora_agendamento)
);

INSERT INTO usuarios (nome, email, senha) VALUES
  ('Administrador da Oficina', 'admin@oficina.com', 'admin123')
ON CONFLICT (email) DO NOTHING;

INSERT INTO recursos (nome, descricao) VALUES
  ('Elevador 01', 'Elevador para veículos leves'),
  ('Elevador 02', 'Elevador para veículos leves'),
  ('Box de serviço 01', 'Troca de óleo e revisão'),
  ('Box de serviço 02', 'Alinhamento e balanceamento'),
  ('Box de serviço 03', 'Diagnóstico e manutenção')
ON CONFLICT DO NOTHING;
