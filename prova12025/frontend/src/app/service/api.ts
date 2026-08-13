import { HttpClient } from '@angular/common/http';
import { Service } from '@angular/core';
import { Observable } from 'rxjs';

//classe de conexão com a api

@Service()
export class Api {
    //atributo
    private baseUrl = "http://localhost:8080/api";

    //construtor, habilita a conexão http => HttpClient
    constructor(private http: HttpClient){}

    //métodos da API

    //login
    login(dados:any): Observable<any> {//Observable => conexão assincrono com API
        return this.http.post(`${this.baseUrl}/auth/login`, dados); //estabelece conexão com api passando a URL e Body(dados)
    }

    //getProdutos
    getProdutos():Observable<any> {return this.http.get(`${this.baseUrl}/produtos`);}

    //buscarProdutos(por partes do nome)
    buscarProdutos(termo:String):Observable<any>{return this.http.get(`${this.baseUrl}/produtos/busca?termo=${termo}`);}

    //postProdutos
    postProduto(produto:any):Observable<any>{return this.http.post(`${this.baseUrl}/produtos`,produto);}

    //putProduto
    updateProduto(produto: any, id:number): Observable<any>{
        return this.http.put(`${this.baseUrl}/produtos/${id}`, produto)
    }

    //deleteProdutos
    deleteProduto(id:number):Observable<any> {
        return this.http.delete(`${this.baseUrl}/produtos/${id}`)
    }

    //postMovimentacao
    postMovimentacao(movimentacao:any):Observable<any>{return this.http.post(`${this.baseUrl}/movimentacao`,movimentacao);}

    //getMovimentacao
    getMovimentacao():Observable<any> {return this.http.get(`${this.baseUrl}/movimentacao`);}
}
