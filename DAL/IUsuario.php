<?php

/**
 * @author Marcelo
 */ 

/** Contém as assinaturas dos métodos que devem ser implementados na camada de dados */
interface IUsuario {
    
    function insert(Usuario $usuario);
    function select();
    function delete($id);
    function update(Usuario $usuario);
    
}
