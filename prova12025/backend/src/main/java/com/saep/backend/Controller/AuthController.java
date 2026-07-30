package com.saep.backend.Controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;

import com.saep.backend.Model.Usuario;
import com.saep.backend.Repository.UsuarioRepository;

public class AuthController {
    @Autowired
    private UsuarioRepository usuarioRepository;

    @PostMapping("/login")
    public ResponseEntity<?> login(@RequestBody Usuario loginData) {
        return usuarioRepository.findByLoginAndSenha(loginData.getLogin(), loginData.getSenha()) //passa o login e a senha para a api
            .map(usuario -> ResponseEntity.ok(usuario)) //se estiver certo, retorna o usuário e o status 200
            .orElseGet(() -> ResponseEntity.status(401).build()); //caso constrário, retorna o erro 401 (não autorizado)
    }
    
}
