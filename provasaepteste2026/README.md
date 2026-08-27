# SAEP - Sistema de Agendamento Inteligente para uma Oficina Mecânica

O **Sistema de Agendamento Inteligente** é uma aplicação web Fullstack desenvolvida como solução "White-Label" e adaptada para o nicho de **Oficinas Mecânicas Automotivas**. O sistema tem como objetivo principal digitalizar e organizar a gestão de horários, eliminando o uso de agendas de papel e planilhas confusas.

O grande diferencial e núcleo do sistema é a sua trava de segurança contra **double-booking** (sobreposição de horários). O sistema impede categoricamente que dois veículos sejam agendados para o mesmo recurso (Elevador ou Box de Serviço) na mesma data e hora, prevenindo prejuízos e atrasos na oficina.

---

## Como Executar o Projeto Localmente

O projeto é dividido em duas partes: o **Backend (API REST com Node.js)** e o **Frontend (SPA com Angular)**.

### Pré-Requisitos 
* **Node.js** (v18 ou superior) instalado.
* **Angular CLI** (v15 ou superior) instalado globalmente.
* **PostgreSQL** instalado e rodando na porta `5432` (padrão).
* **Git** instalado na máquina.

### Passo 1: Clonar o Repositório

Abra o terminal e execute:
```bash
# Clone este repositório
git clone [https://github.com/seu-usuario/saep-agendamento-oficina.git](https://github.com/seu-usuario/saep-agendamento-oficina.git)

# Acesse a pasta do projeto
cd saep-agendamento-oficina