import { Component } from '@angular/core';
import { Api } from '../../service/api';
import { error } from 'console';

@Component({
  selector: 'app-estoque',
  imports: [],
  templateUrl: './estoque.html',
  styleUrl: './estoque.css',
})
export class Estoque {
  produtos: any[] = []; // vetor para armazenar os produtos
  movimentacao: any[] = []; //vetor para armazenar as movimentações
  novaMovimentacao = {produto:{id:null}, usuario:{id:null}, tipo: "", quantidade: 0, dataMovimentacao: ""};
  
  constructor(private api: Api){}
  
  //carregar 
  carregar(){
    this.api.getMovimentacao().subscribe(res=> this.movimentacao = res);
    this.api.getProdutos().subscribe(res=> this.produtos = res);
    this.ordenarProdutos();
  }
  
  //Ordenar oas movimentções por produto
  //ordenar os produtos em ordem alfabetica
  ordenarProdutos(){//CSR
    this.movimentacao.sort((a,b)=> a.produto.nome.localeCompare(b.produto.nome)); //ordena a lista de movimentaç~eos em ordem alfabetica de produtos
    this.produtos.sort((a,b)=>a.nome.localeCompare(b.nome)); //ordena a lista de produtos em ordem alfabética do nome do produto
  }
  
  //RegistrarMovimentação
  registrarMovimentacao(){
    // validar se a quantidade é maior que a solictada
    const produtoSel = this.produtos.find(p => p.id === this.novaMovimentacao.produto.id); //procurando se o produto existe na lista
    
    if(this.novaMovimentacao.tipo === "saida" && this.novaMovimentacao.quantidade > produtoSel.estoqueAtual){
      alert("Erro: Quantidade de saída maior que a quantidade em estoque");
      return;
    }
    //atualizo a quantidade de produtos 
    produtoSel.estoqueAtual = this.novaMovimentacao.tipo === "saida" 
      ? produtoSel.estoqueAtual - this.novaMovimentacao.quantidade
      :produtoSel.estoqueAtual + this.novaMovimentacao.quantidade;
    // registro da movimentação
    this.api.postMovimentacao(this.novaMovimentacao).subscribe(()=>{
      next: () => {
        alert(`Movimentacao ${this.novaMovimentacao.tipo} registrada com sucesso`);
        //atualizar Produto
        this.api.updateProduto(produtoSel.id,produtoSel);
        this.carregar()
        this.novaMovimentacao = {produto:{id:null}, usuario:{id:null}, tipo: "", quantidade: 0, dataMovimentacao: ""};
      }
      error: (e:any) => {
        alert(`Erro: ${e.message}`);
      }
    })
  }
}
