<?php

/**
 * @author Marcelo
 */

class Usuario {
  
   //Variaveis de instância
    private $codigo;
    private $nome;
    private $descricao;
    private $anexo;
    private $email;
    private $senha;
    
    //Construtor publico (A classe permite instancias)
    public function __construct() {
        
    }
    
    //Métodos get/set
    public function setCodigo($id){
        $this->codigo = $id;
    }
    
    public function getCodigo(){
        return $this->codigo;
    }
    
    public function setNome($nome){
        $this->nome = $nome;
    }
    
    public function getNome(){
        return $this->nome;
    }
    
    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }
    
    public function getDescricao(){
        return $this->descricao;
    }
    
    public function setAnexo($anexo){
        $this->anexo = $anexo;
    }
    
    public function getAnexo(){
        return $this->anexo;
    }
    
    public function setEmail($email){
        $this->email = $email;
    }
    
    public function getEmail(){
        return $this->email;
    }
    
    public function setSenha($senha){
        $this->senha = $senha;
    }
    
    public function getSenha(){
        return $this->senha;
    }
}
