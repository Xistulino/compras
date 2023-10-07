<?php

defined ('BASEPATH') or exit('No direct script access allowed');



class M_acesso extends CI_Model{

    public function validalogin($usuario, $senha){
        //Atributo retorno recebe o resultado do SELECT
        //realizado na tabela de usuários lembrando a função md5()por causa da criptografia

        $retorno = $this->db->query("select * from usuarios
                                    where usuario = '$usuario'
                                    and senha     = md5('$senha')
                                    and estatus   = ''");


         //Verifica se a quantidade de linhas trazidas na consulta     é superior 0,
         //isso quer dizer que foi encontrado usuario e senha 
         
         //criando um array com dois elementos para retorno do resultado 
         //1 - Código da mensagem
         //2 - Descrição da mensagem 

         if($retorno->num_rows() > 0){
            $dados = array('codigo'=> 1 , 'msg'=> 'Usuário correto');

         }else{
            $dados = array('codigo'=> 4, 'msg'=> 'Usuário ou senha inválidos');
         }

         //Envia o array $dados com as informações traadas acima pela estrutura de decisão if

         return $dados;
         
    }    
}