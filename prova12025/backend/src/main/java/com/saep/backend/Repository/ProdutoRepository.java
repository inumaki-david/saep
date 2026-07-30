package com.saep.backend.Repository;

import java.util.Optional;

import org.springframework.data.jpa.repository.JpaRepository;

import com.saep.backend.Model.Produto;
import com.saep.backend.Model.Usuario;
import java.util.List;


public interface ProdutoRepository extends JpaRepository<Produto,Long>{
   //método para buscar por partes do nome
   List<Produto> findByNomeContainingIgnoreCase(String nome);
}