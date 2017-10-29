<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of historico
 *
 * @author atila
 */
class Historico {

    private $cod;
    private $data;
    private $numero_animais;
    private $piquete;
    private $mysql;

    function __construct() {
        $this->mysql = new Conexao;
    }

    function listar($piquete = FALSE) {
        
        if ($piquete) {
            $pesquisa = 'WHERE piquete = '.$piquete;
        } else {
            $pesquisa = '';
        }
        
        try {
            $exec = $this->mysql->sql_query("SELECT * FROM historico $pesquisa");

            while ($historico = $exec->fetch_object()) {
                $array[] = $historico;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $array;
    }

    function cadastrar(Historico $classe) {
        try {
            $this->mysql->sql_query("INSERT INTO `historico` "
                    . "`data`, "
                    . "`numero_animais`, "
                    . "`piquete`) "
                    . "VALUES ("
                    . "'" . $classe->data . "', "
                    . "'" . $classe->numero_animais . "', "
                    . "'" . $classe->piquete . "')");
            $this->msg['txt'] = "<h4 class = 'txt_sucesso_form'>Registro gravado com sucesso!</h4><br>";
            $this->msg['status'] = true;
        } catch (Exception $exc) {
            $this->msg['txt'] = 'Ocorreu um erro no cadastro';
            echo $exc->getTraceAsString();
        }
        return $this->msg;
    }

}
