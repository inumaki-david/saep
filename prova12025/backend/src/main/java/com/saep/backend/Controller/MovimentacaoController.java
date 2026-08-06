package com.saep.backend.Controller;

import java.util.List;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.saep.backend.Model.Movimentacao;
import com.saep.backend.Repository.MovimentacaoRepository;

@RestController
@RequestMapping("/api/movimentacao")
public class MovimentacaoController {
    private final MovimentacaoRepository movimentacaoRepository;

    MovimentacaoController(MovimentacaoRepository movimentacaoRepository)
    {
        this.movimentacaoRepository = movimentacaoRepository;
    }

    // Métodos para buscar todas as movimentações 
    @GetMapping()
    public List<Movimentacao> buscarMovimentacao() {
        return movimentacaoRepository.findAll();
    }

    @PostMapping()
    public List<Movimentacao> registrarMovimentacao(@RequestBody Movimentacao movimentacao) {
        return movimentacao.save(movimentacao);
    }
}
