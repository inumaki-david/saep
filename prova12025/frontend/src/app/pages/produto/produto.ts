import { Component, OnInit } from '@angular/core';
import { Api } from '../../service/api';
import { FormsModule } from '@angular/forms';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-produto',
  imports: [FormsModule, RouterLink],
  templateUrl: './produto.html',
  styleUrl: './produto.css',
})
export class Produto implements OnInit{
  //atributos 
  produtos: any[] = []; //lista os produtos
  termoBusca: string = ""; //termo para fazer a busca
  produtoAtual = {nome: "", descricao: "", estoqueMinimo: null};

  constructor(private api: Api){}

  //carregar a lista de produtos
  carregar(){
    this.api.getProdutos().subscribe(res => this.produtos = res); //preenchendo o vetor de produtos com a api
  }

  //busca produtos pelo termo => SSR Renderização ao lado do servidor
  buscar(){
    this.api.buscarProdutos(this.termoBusca).subscribe(res => this.produtos = res);
  }

  //buscar produtos pelo termo => CRS Cliente Sode Render
  buscar2(){
    let produtosFiltrados: any[]= [];
    produtosFiltrados = this.produtos.filter((e)=>e.contains(this.termoBusca));
    this.produtos = produtosFiltrados;
  }

  //salvar produto na api
  salvar(){
    this.api.postProduto(this.produtoAtual).subscribe(()=>{
      alert("Produto Cadastrado com Sucesso.");
      this.produtoAtual = {nome: "", descricao: "", estoqueMinimo: null};
      this.carregar();
    });
  }

  //excluir produto da api
  excluir(id:number){
    if (confirm("Tem certeza?")) {
      this.api.deleteProduto(id).subscribe(()=>this.carregar());
    }
  }

  //método ao iniciar
  ngOnInit(){
    this.carregar();
  }

}
