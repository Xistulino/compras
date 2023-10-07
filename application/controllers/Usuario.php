<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller{
    public function inserir(){
        $json = file_get_contents('php://input');
        $resultado = json_decode($json);

        $usuario       = $resultado->usuario;
        $senha         = $resultado->senha;
        $nome          = $resultado->nome;
        $tipo_usuario  = strtoupper($resultado->tipo_usuario);

        //Abaixo colocaremos o usuário do sistema
        $usu_sistema = strtoupper($resultado->usu_sistema);

        //faremos uma validação para sabermos se todos os dados
        //foram enviados
        if(trim($usu_sistema) == ''){
            $retorno = array('codigo' => 7,
                              'msg' => 'Usuário dos sistema não informado');
        }               
        if(trim($usuario) ==''){
            $retorno = array('codigo'=> 2, 'msg'=> 'Usuario não informado');

        }elseif( trim($senha) ==''){
            $retorno = array('codigo' => 3, 'msg' => 'Senha não informada');

        }elseif( trim($nome) ==''){
            $retorno = array('codigo' => 4, 'msg' => 'Nome não informado');

        }else{
            $this->load->model('m_usuario');

            $retorno = $this->m_usuario->inserir($usuario, $senha, $nome, $tipo_usuario, $usu_sistema); 
        }

        echo json_encode($retorno);
    }

    public function consultar (){
        $json = file_get_contents('php://input');
        $resultado = json_decode($json);

        $usuario      = $resultado->usuario;
        $nome         = $resultado->nome;
        $tipo_usuario = strtoupper($resultado->tipo_usuario);

        if(trim($tipo_usuario) != 'ADMINISTRADOR' &&
           trim($tipo_usuario) != 'COMUM' &&
           trim($tipo_usuario) != ''){

            $retorno = array('codigo' => 5,
                              'msg' => 'Tipo de usuário inválido');

           }else{
            $this-> load->model('m_usuario');

            $retorno = $this->m_usuario->consultar($usuario, $nome, $tipo_usuario);
        }
        echo json_encode ($retorno);
        
        
    }
    public function alterar (){
        $json = file_get_contents('php://input');
        $resultado = json_decode($json);

        $usuario      = $resultado->usuario;
        $nome         = $resultado->nome;
        $senha        = $resultado->senha;
        $tipo_usuario = strtoupper($resultado->tipo_usuario);
        $usu_sistema = strtoupper($resultado->usu_sistema);

        if(trim($tipo_usuario) != 'ADMINISTRADOR' &&
           trim($tipo_usuario) != 'COMUM' &&
           trim($tipo_usuario) != ''){

            $retorno = array('codigo' => 5,
                              'msg' => 'Tipo de usuário inválido');

        }elseif(trim($nome) == ''){
            $retorno = array('codigo' => 3,
                             'msg' => "Nome não informado");
                            
                            
        }elseif(trim($nome) == ''){
            $retorno = array('codigo' => 2,
                             'msg' => "Usuário não informado");                  
                        
        }elseif(trim($nome) == ''){
            $retorno = array('codigo' => 4,
                             'msg' => "Senha não pode estar vazia");
                        
        }else{
            $this-> load->model('m_usuario');

            $retorno = $this->m_usuario->alterar($usuario, $senha, $nome, $tipo_usuario, $usu_sistema);
        }
        echo json_encode ($retorno);
                            
                            
    
    }
    public function desativar(){
        $json = file_get_contents('php://input');
        $resultado = json_decode($json);

        $usuario = $resultado->usuario;

        $usu_sistema = strtoupper($resultado->usu_sistema);

        if(trim($usuario == '')){
            $retorno = array('codigo' => 2,
                             'msg' => 'Usuário não informado');
        
        }else{
            //Realizo a instância da Model
            $this->load->model('m_usuario');

            //Atributo %retorno recebe array com informações
            $retorno = $this->m_usuario->desativar($usuario, $usu_sistema);

            //Retorno no formato JSON
            echo json_encode($retorno);
        }
    }

}

?>