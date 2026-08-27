const express = require("express");
const cors = require("cors");
const pool = require("./db");

const app = express();
app.use(cors());
app.use(express.json());

// Rotas de Clientes
app.get("/clientes", async (req, res) => {
  try {
    const { rows } = await pool.query(
      "SELECT * FROM clientes ORDER BY nome ASC",
    );
    res.json(rows);
  } catch (error) {
    res.status(500).json({ erro: "Erro ao buscar clientes" });
  }
});

app.post("/clientes", async (req, res) => {
  const { nome, documento, telefone } = req.body;
  try {
    const { rows } = await pool.query(
      "INSERT INTO clientes (nome, documento, telefone) VALUES ($1, $2, $3) RETURNING *",
      [nome, documento, telefone],
    );
    res.status(201).json(rows[0]);
  } catch (error) {
    res
      .status(500)
      .json({
        erro: "Erro ao cadastrar cliente. Verifique se o documento já existe.",
      });
  }
});

// Rotas de Recursos (Elevadores / Boxes)
app.get("/recursos", async (req, res) => {
  try {
    const { rows } = await pool.query("SELECT * FROM recursos");
    res.json(rows);
  } catch (error) {
    res.status(500).json({ erro: "Erro ao buscar recursos" });
  }
});

// Rotas de Agendamentos (Com Regra de Negócio)
app.get("/agendamentos", async (req, res) => {
  try {
    const query = `
      SELECT a.*, c.nome AS cliente_nome, r.nome AS recurso_nome 
      FROM agendamentos a
      JOIN clientes c ON a.cliente_id = c.id
      JOIN recursos r ON a.recurso_id = r.id
      ORDER BY a.data_agendamento DESC, a.hora_agendamento ASC
    `;
    const { rows } = await pool.query(query);
    res.json(rows);
  } catch (error) {
    res.status(500).json({ erro: "Erro ao buscar histórico de agendamentos" });
  }
});

app.post("/agendamentos", async (req, res) => {
  const {
    cliente_id,
    recurso_id,
    data_agendamento,
    hora_agendamento,
    hora_saida_agendamento,
  } = req.body;

  try {
    // Validação RN01: Verificando choque de horários (Double-booking)
    const conflito = await pool.query(
      `SELECT * FROM agendamentos 
       WHERE recurso_id = $1 
       AND data_agendamento = $2 
       AND (hora_agendamento < $4 AND hora_saida_agendamento > $3)`,
      [recurso_id, data_agendamento, hora_agendamento, hora_saida_agendamento],
    );

    if (conflito.rows.length > 0) {
      return res.status(409).json({
        erro: "Choque de horário! Este recurso já está reservado neste período.",
      });
    }

    // Se não houver conflito, realiza a inserção
    const { rows } = await pool.query(
      `INSERT INTO agendamentos 
      (cliente_id, recurso_id, data_agendamento, hora_agendamento, hora_saida_agendamento) 
      VALUES ($1, $2, $3, $4, $5) RETURNING *`,
      [
        cliente_id,
        recurso_id,
        data_agendamento,
        hora_agendamento,
        hora_saida_agendamento,
      ],
    );

    res.status(201).json(rows[0]);
  } catch (error) {
    console.error(error);
    res.status(500).json({ erro: "Erro ao registrar agendamento" });
  }
});

// Inicia o servidor
const PORT = process.env.PORT || 3007;
app.listen(PORT, () => {
  console.log(`API da Oficina rodando na porta ${PORT}`);
});
