<?php

defined ('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller{

    //Métodos da classe
    //Chamada da view de login
    //O references|O overrides

    public function index(){
        $this->load->view('index');
    }

    //O references|O overrides

    public function logar(){


       /* Recebimento via JSON o usuário e senha 
        Retornos possiveis:
        1 - Usuário e senha validados corretamente ( Banco)
        2 - Faltou informar usuário (FrontEnd)
        3 - Faltou informar senha (FrontEnd)
        4 - Usuário e senha inválidos (Banco) */

        $json = file_get_contents('php://input');
        $resultado = json_decode($json);        
        $usuario = $resultado->usuario;
        $senha   = $resultado->senha;

        if(trim($usuario) == ''){
            $retorno = array('codigo' => 2, 'msg'=> 'usuário não informado');

        }elseif(trim($senha) == ''){
            $retorno = array('codigo'=> 3, 'msg'=> 'senha não irfomada');

        }else{
            //Realizo a instancia da Model

            $this -> load -> model ('m_acesso');

            //Atributo $retorno recebe array com informações da validação de acesso 

            $retorno = $this->m_acesso->validalogin($usuario, $senha);
        }
        // Retorno formato JSON
        echo json_encode($retorno);
         
    }
}
?>