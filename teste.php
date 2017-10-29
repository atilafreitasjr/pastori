<?php

require_once 'class/Historico.php';
require_once 'class/Conexao.php';

$historico = new Historico();


echo'<br><pre>';
print_r($historico->listar());
echo '</pre><br>';
