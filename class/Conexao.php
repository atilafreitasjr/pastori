<?php

// Na linha abaixo chamaremos a classe "conexao" (que deverá ser fechada apenas no final do ficheiro).
class Conexao {

    // Nas linhas abaixo você poderá colocar as informações do Banco de Dados.
    private $host = "localhost"; // Nome ou IP do Servidor
    private $user = "pastori"; // Usuário do Servidor MySQL
    private $senha = "123456"; // Senha do Usuário MySQL
    var $dbase = "pastori"; // Nome do seu Banco de Dados
    // Criaremos as variáveis que Utilizaremos no script
    var $query;
    private $link;
    var $resultado;
    

    // Cria a função para efetuar conexão ao Banco MySQL 
    function conecta() {
        try {
            //$this->link = @mysql_connect($this->host,$this->user,$this->senha);
            $this->link = new mysqli($this->host, $this->user, $this->senha, $this->dbase);
            
        } catch (Exception $exc) {
            print "Ocorreu um Erro na conexão MySQL:";
            print "<b>" . mysqli_error($this->link) . "</b>";
            echo $exc->getTraceAsString();
            die();
        }
    }

    /**
     * Cria a função para "query" no Banco de Dados.
     * Se abilitar a variável escrever, mostrará a query na tela.
     * 
     * 
     * @param type $query
     * @param type $escrever
     * @return type
     */
    function sql_query($query, $escrever = FALSE) {
        if ($escrever) {
            echo '<div style="width:50%"><br>' . $escrever.'<br>';
            print_r($query);
            echo '<br></div>';
        }

        $this->conecta();

        // Conecta e faz a query no MySQL
        try {
            $re = $this->link->query($query);
            $this->link->close();
            return $re;
        } catch (Exception $exc) {
            print "Ocorreu um erro ao executar a Query MySQL: <b>$query</b>";
            print "<br><br>";
            print "Erro no MySQL: <b>" . mysql_error() . "</b>";
            die();
            $this->link->close();// mysqli_close($this->link);
            echo $exc->getTraceAsString();
        }




        if ($this->resultado = mysqli_query($this->link, $this->query)) {
            mysqli_close($this->link);
            return $this->resultado;
        } else {
            // Caso ocorra um erro, exibe uma mensagem com o Erro
        }
    }

}

?>