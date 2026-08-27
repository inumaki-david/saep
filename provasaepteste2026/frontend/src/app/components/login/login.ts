import { Component, EventEmitter, Input, Output } from '@angular/core';

@Component({
  selector: 'app-login',
  standalone: false,
  styleUrl: './login.css',
  templateUrl: './login.html',
})
export class Login {
  @Output() submitted = new EventEmitter<{ email: string; senha: string }>();
  @Input() erroExterno = '';
  @Input() carregando = false;
  email = '';
  senha = '';
  erro = '';

  entrar(): void {
    if (!this.email || !this.senha) {
      this.erro = 'Informe e-mail e senha.';
      return;
    }
    this.erro = '';
    this.submitted.emit({ email: this.email, senha: this.senha });
  }
}
