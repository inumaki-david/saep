import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class ApiService {
  // A URL base aponta para o seu servidor Node.js que configuramos na porta 3007
  private baseUrl = 'http://localhost:3007';

  constructor(private http: HttpClient) {}

  // Função genérica para buscar dados (ex: listar clientes e recursos)
  get(endpoint: string): Observable<any> {
    return this.http.get(`${this.baseUrl}/${endpoint}`);
  }

  // Função genérica para enviar dados (ex: cadastrar clientes e agendamentos)
  post(endpoint: string, data: any): Observable<any> {
    return this.http.post(`${this.baseUrl}/${endpoint}`, data);
  }
}
