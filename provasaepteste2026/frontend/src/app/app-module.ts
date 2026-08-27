import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HttpClientModule } from '@angular/common/http';
import { FormsModule } from '@angular/forms'; // Permite usar [(ngModel)] nos inputs

import { AppRoutingModule } from './app-routing-module';
import { App } from './app';
import { Login } from './components/login/login';
import { Layout } from './components/layout/layout';

@NgModule({
  declarations: [App, Login, Layout],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule, // Necessário para a API
    FormsModule, // Necessário para os formulários
  ],
  providers: [],
  bootstrap: [App],
})
export class AppModule {}
