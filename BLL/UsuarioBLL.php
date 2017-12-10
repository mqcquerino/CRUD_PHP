<?php

include_once './DAL/UsuarioDAL.php';
include_once './DAL/Config.php';
include_once './Entidade/Usuario.php';

/**
 * @author Marcelo
 */
/* Classe não pode ser herdada */
final class UsuarioBLL {

    public $usuarioDAL;

    /* Método construtor publico (Permite novas instancias) */
    public function __construct() {
        $this->usuarioDAL = new UsuarioDAL();
    }
    
    /*
     * @param Objeto usuario que contem as informações que serão inseridas no db
     * @return view contendo elementos html informando o resultado da requisição
     */    
    public function inserirUsuario(Usuario $usuario) {
        $result = $this->usuarioDAL->insert($usuario);
        if ($result == SUCESSO) {
            return "<p> Inserido com sucesso </p>";
        } 
        else if ($result == SEM_REGISTROS) {
            return "<p> Não foi possivel inserir </p>";
        } 
        else if ($result == ERRO_INSTRUCAO) {
            return "<p> Já existe um usuario cadastrado com esse email! </p>";
        }
    }

    /*
     * @return view html contendo elementos html com a listagem de registros encontrados na base de dados
     */
    public function selectUsuarios() {
        $result = $this->usuarioDAL->select();
        if ($result === SEM_REGISTROS) {
            return "<p> Não há registros para exibir </p>";
        }
        else if ($result !== ERRO_DB && $result !== ERRO_INSTRUCAO) {
            $dados = '<table style="width:30%" border> '
                    . "<tr>"
                    . "<th> Código </th>"
                    . "<th> Nome </th>"
                    . "<th> Descricao </th>"
                    . "<th> Email </th>"
                    . "<th> Anexo </th>"
                    . "<th> Ação </th>"
                    . "</tr>";
            for ($i = 0; $i < $result->count(); $i++) {
                $dados .= "<tr>"
                        . "<td> <a href='dados.php?id=".$result->offsetGet($i)->getCodigo()."'>" . $result->offsetGet($i)->getCodigo() . "</a></td>"
                        . "<td>" . $result->offsetGet($i)->getNome() . "</td>"
                        . "<td>" . $result->offsetGet($i)->getDescricao() . "</td>"
                        . "<td>" . $result->offsetGet($i)->getEmail() . "</td>"
                        . "<td><img src='" . $result->offsetGet($i)->getAnexo() ."' </td>" 
                        . "<td> <a href='delete.php?id=".$result->offsetGet($i)->getCodigo()."'> DELETE </td>"
                        . "</tr>";
            }
            $dados .= "</table>";
            return $dados;
        }
    }
    
    /*
     * @param identificador unico do usuario que sera utilizada na busca de registro no db
     * @return view contendo elementos html com o registrado encontra no db
     */
    public function selectUsuarioPorId($id) {
        $result = $this->usuarioDAL->selectUsuario($id);
        if ($result === SEM_REGISTROS) {
            return "<p> Não há registros para exibir </p>";
        }
        else if ($result !== ERRO_DB && $result !== ERRO_INSTRUCAO) {
            $dados = "
            <form action='alterardados.php' method='post'>
                <label>Codigo</label> <br>
                <input type='text' value='".$result->getCodigo()."' name='id' readonly> <br><br>
                <label>Nome</label> <br>
                <input type='text' value='".$result->getNome()."' name='nome'> <br><br>
                <label>Descricao</label> <br>
                <input type='text' value='".$result->getDescricao()."' name='descricao'> <br><br>
                <label>Email</label> <br>
                <input type='text' value='".$result->getEmail()."' name='email'> <br><br>
                <label>Senha</label> <br>
                <input type='text' value='".$result->getSenha()."' name='senha'> <br><br>
                <input type='submit' value='UPDATE'>
            </form> <br>";         
            return $dados;
        }
    }
    
    /*
     * @param objeto usuario contendo os dados necessarios para alterar de um registro na base de dados
     * @return view contendo elementos html informando o resultado da requisição
     */
    public function alterarDados(Usuario $u){
        $result = $this->usuarioDAL->update($u);
        $dados = "";
        if($result === SUCESSO){
            $dados .= "<p>Alterado com sucesso! </p>";
        }
        else if($result === SEM_REGISTROS){
            $dados .= "<p>Não foi gerada qualquer alteração! </p>";
        }
        else{
            $dados .= "<p>Erro ao alterar os dados </p>";
        }
        $dados.= "<br> <a href='dados.php?id=".$u->getCodigo()."'>Voltar</a> &nbsp";        
        return $dados;
    }
    
    /*
     * @param identificador unico do usuario que sera utilizado para executar um delete de registro na base de dados
     * @return view contendo elementos html informando o resultado da requisição
     */
    public function deleteUsuario($id){
        $result = $this->usuarioDAL->delete($id);
        $dados = "";
        if($result === SUCESSO){
            $dados .= "<p>Deletado com sucesso! </p>";
        }
        else if($result === SEM_REGISTROS){
            $dados .= "<p>Não foi gerada qualquer alteração!</p>";
        }
        else{
            $dados .= "<p>Erro ao deletar </p>";
        }
        $dados.= "<br> <a href='index.php'>Voltar</a>";        
        return $dados;
    }
    
    /*
     * @param objeto usuario contendo as informações necessarias para realizar uma busca de registro especifico na base de dados
     * @return view contendo elementos html informando o resultado da requisição
     */
    public function logarUsuario(Usuario $u){
        $result = $this->usuarioDAL->selectUsuarioEmailSenha($u);
        $dados = "";
        if($result === SEM_REGISTROS){
            $dados.= "<p>Email e/ou senha invalido(s) </p>";
            $dados.= "<a href='login.php'>Voltar</a>";
        }
        else{
            $dados.= "<p>Bem vindo, ". $result->getNome() ." </p>";
            $dados.= "<a href='index.php'>Acessar pagina principal</a>";
            session_start();
            $_SESSION['login'] = 1;
            $_SESSION['email'] = $result->getEmail();
            $_SESSION['nome'] = $result->getNome();
        }   
        return $dados;
    }
 }


