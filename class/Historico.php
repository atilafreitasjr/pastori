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
    private $espectro;
    private $piquete;
    private $mysql;
    
    function getData() {
        return $this->data;
    }

    function getNumero_animais() {
        return $this->numero_animais;
    }

    function getEspectro() {
        return $this->espectro;
    }

    function getPiquete() {
        return $this->piquete;
    }

    function getMysql() {
        return $this->mysql;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setNumero_animais($numero_animais) {
        $this->numero_animais = $numero_animais;
    }

    function setEspectro($espectro) {
        $this->espectro = $espectro;
    }

    function setPiquete($piquete) {
        $this->piquete = $piquete;
    }

    function setMysql($mysql) {
        $this->mysql = $mysql;
    }

    
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
                    . "(`data`, "
                    . "`numero_animais`, "
                    . "`espectro`, "
                    . "`piquete`) "
                    . "VALUES ("
                    . "'" . $classe->data . "', "
                    . $classe->numero_animais . ", "
                    . "'" . $classe->espectro . "', "
                    . "'" . $classe->piquete . "')");
            $this->msg['txt'] = "<h4 class = 'txt_sucesso_form'>Registro gravado com sucesso!</h4><br>";
            $this->msg['status'] = true;
        } catch (Exception $exc) {
            $this->msg['txt'] = 'Ocorreu um erro no cadastro';
            echo $exc->getTraceAsString();
        }
        return $this->msg;
    }
    
    function set_imputs($imputs) {
        
        $this->setData(date("Y-m-d"));
        empty($imputs['numero_animais']) ? $this->setNumero_animais(0) : $this->setNumero_animais($imputs['numero_animais']);
        empty($imputs['espectro']) ? $this->setEspectro('') : $this->setEspectro($imputs['espectro']);
        empty($imputs['piquete']) ? $this->setPiquete('') : $this->setPiquete($imputs['piquete']);
        return $this;
    }

}
