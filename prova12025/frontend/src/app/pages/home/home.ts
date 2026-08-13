import { Component, OnInit } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { Router, RouterLink } from '@angular/router';

@Component({
  selector: 'app-home',
  imports: [FormsModule, RouterLink],
  templateUrl: './home.html',
  styleUrl: './home.css',
})
export class Home implements OnInit{
  //atributos
  nomeUsuario: string = "";

  constructor(private router:Router){}

  //método que será executado antes da renderização da página
  ngOnInit(){
    //pegar as informações do localStorage
    const user = JSON.parse(localStorage.getItem("usuarioLogado") || "{}");
    this.nomeUsuario = user.nome || "Visitante";
    // || => ??
    // || se caso for algum valor null, 0 ou "" ele preenche com  o valor apos o operador
    // ?? se caso for null ou undefined ele preenche com o valor após o operador 
  }

  logout(){
    localStorage.removeItem("usuarioLogado");
    this.router.navigate(["/login"]);
  }

}
