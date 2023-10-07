<?php
defined('BASEPATH') or exit('No direct script access allowed');

//Função para trocar caracteres '(aspas simples) por `(aspas simples) por `(acento agudo)  
//para podermos montar uma String
function troca_caractere($value)
{
    $retorno = str_replace("'", "`", $value);
    return $retorno;
}

   

?>

