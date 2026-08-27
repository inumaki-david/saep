import { Component, OnInit, signal } from '@angular/core';
import { HttpErrorResponse } from '@angular/common/http';
import { ApiService } from './services/api.service';

@Component({
  selector: 'app-root',
  standalone: false,
  styleUrl: './app.css',
  templateUrl: './app.html',
})
export class App implements OnInit {
  protected readonly title = signal('Oficina Agenda');
  logado = false; carregandoLogin = false; usuario = ''; secao = 'visao-geral'; busca = ''; aviso = ''; erro = '';
  clientes: any[] = []; recursos: any[] = []; agendamentos: any[] = [];
  clienteForm = { id: null as number | null, nome: '', documento: '', telefone: '' };
  agendaForm = { cliente_id: '', recurso_id: '', data_agendamento: '', hora_agendamento: '', hora_saida_agendamento: '' };

  constructor(private api: ApiService) {}
  ngOnInit(): void { this.carregarDados(); }
  carregarDados(): void {
    this.api.get('clientes').subscribe({ next: (data) => this.clientes = data, error: () => this.erro = 'API indisponível. Inicie o backend na porta 3007.' });
    this.api.get('recursos').subscribe({ next: (data) => this.recursos = data });
    this.api.get('agendamentos').subscribe({ next: (data) => this.agendamentos = data });
  }
  login(dados: { email: string; senha: string }): void {
    this.carregandoLogin = true;
    this.api.post('login', dados).subscribe({ next: (user) => { this.carregandoLogin = false; this.logado = true; this.usuario = user.nome; this.erro = ''; this.carregarDados(); }, error: (e: HttpErrorResponse) => { this.carregandoLogin = false; this.erro = e.error?.erro || 'Falha ao entrar.'; } });
  }
  logout(): void { this.logado = false; this.usuario = ''; }
  mudarSecao(secao: string): void { this.secao = secao; this.aviso = ''; this.erro = ''; }
  salvarCliente(): void {
    if (!this.clienteForm.nome || !this.clienteForm.documento || !this.clienteForm.telefone) { this.erro = 'Preencha todos os campos obrigatórios do cliente.'; return; }
    const request = this.clienteForm.id ? this.api.put(`clientes/${this.clienteForm.id}`, this.clienteForm) : this.api.post('clientes', this.clienteForm);
    request.subscribe({ next: () => { this.aviso = this.clienteForm.id ? 'Cliente atualizado.' : 'Cliente cadastrado.'; this.limparCliente(); this.carregarDados(); }, error: (e: HttpErrorResponse) => this.erro = e.error?.erro || 'Não foi possível salvar o cliente.' });
  }
  editarCliente(c: any): void { this.clienteForm = { id: c.id, nome: c.nome, documento: c.documento, telefone: c.telefone }; }
  excluirCliente(id: number): void { if (confirm('Excluir este cliente?')) this.api.delete(`clientes/${id}`).subscribe({ next: () => { this.aviso = 'Cliente excluído.'; this.carregarDados(); }, error: (e: HttpErrorResponse) => this.erro = e.error?.erro || 'Cliente não pode ser excluído.' }); }
  limparCliente(): void { this.clienteForm = { id: null, nome: '', documento: '', telefone: '' }; }
  get clientesFiltrados(): any[] { const termo = this.busca.toLowerCase(); return this.clientes.filter((c) => `${c.nome} ${c.documento}`.toLowerCase().includes(termo)); }
  salvarAgendamento(): void {
    if (Object.values(this.agendaForm).some((valor) => !valor)) { this.erro = 'Preencha cliente, recurso, data e horários.'; return; }
    const dados = { ...this.agendaForm, cliente_id: Number(this.agendaForm.cliente_id), recurso_id: Number(this.agendaForm.recurso_id) };
    this.api.post('agendamentos', dados).subscribe({ next: () => { this.aviso = 'Agendamento registrado com sucesso.'; this.agendaForm = { cliente_id: '', recurso_id: '', data_agendamento: '', hora_agendamento: '', hora_saida_agendamento: '' }; this.carregarDados(); }, error: (e: HttpErrorResponse) => this.erro = e.status === 409 ? 'Choque de horário: este elevador/box já está reservado.' : (e.error?.erro || 'Não foi possível registrar o agendamento.') });
  }
  excluirAgendamento(id: number): void { if (confirm('Cancelar este agendamento?')) this.api.delete(`agendamentos/${id}`).subscribe({ next: () => { this.aviso = 'Agendamento cancelado.'; this.carregarDados(); } }); }
}
