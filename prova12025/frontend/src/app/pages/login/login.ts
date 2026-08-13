import { Component } from '@angular/core';
import { Router, RouterLink } from '@angular/router';
import { Api } from '../../service/api';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-login',
  imports: [FormsModule, RouterLink],
  templateUrl: './login.html',
  styleUrl: './login.css',
})
export class Login {
  //atributos
  credencial = {login: "", senha: ""};

  constructor (private api: Api, private router: Router){}

  entrar(){
    this.api.login(this.credencial).subscribe({
      next: (usuario) => {
        //armazenar no localStorage (cache do navegador)
        localStorage.setItem("usuarioLogado", JSON.stringify(usuario));
        //navegar para a página Home 
        this.router.navigate(["/home"]);
      },
      //verificar erro
      error: () => {
        alert(`Falha de Autenticação. Usuário ou Senha Incorretos.`);
      }
    })
  }

}

