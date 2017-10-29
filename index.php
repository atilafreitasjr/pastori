<?php
session_start();
require_once 'class/Conexao.php';
require_once 'class/Historico.php';

$historico = new Historico();

$dados = $historico->listar();


$imputs = filter_input_array(INPUT_POST, $_POST);

if (isset($imputs['piquete'])) {
    $inserir = $historico->set_imputs($imputs);
    $historico->cadastrar($inserir);
} else {
    $imputs['piquete'] = '1';
}

for ($index = 1; $index < 9; $index++) {

    $mensagem['g'][$index] = '';
    $mensagem['r'][$index] = '';

    $quali_pasto[$index] = 1;

    if (!isset($_SESSION['r'][$index])) {
        $_SESSION['r'][$index] = 100;
    }
    if (!isset($_SESSION['g'][$index])) {
        $_SESSION['g'][$index] = 100;
    }

    if ($index == $imputs['piquete']) {
        if ($_SESSION['r'][$index] > 250) {
            $_SESSION['r'][$index] = 251;
            $mensagem['r'][$index] = 'Troque de piquete';
            $quali_pasto[$index] = 2;
        } else {
            $_SESSION['r'][$index] = $_SESSION['r'][$index] + 30;
        }
        if ($_SESSION['g'][$index] < 10) {
            $_SESSION['g'][$index] = 10;
        } else {
            $_SESSION['g'][$index] = $_SESSION['g'][$index] - 10;
        }
        $b[$index] = random_int(50, 200);
    } else {
        if ($_SESSION['r'][$index] < 10) {
            $_SESSION['r'][$index] = 9;
        } else {
            $_SESSION['r'][$index] = $_SESSION['r'][$index] - 30;
        }
        if ($_SESSION['g'][$index] > 250) {
            $_SESSION['g'][$index] = 250;
        } else {
            $_SESSION['g'][$index] = $_SESSION['g'][$index] + 10;
        }
        $b[$index] = random_int(10, 50);
    }
    $cor[$index] = $_SESSION['r'][$index] . ',' . $_SESSION['g'][$index] . ',' . $b[$index];
}
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Tablesorter - Tutsup</title>

        <!-- Estilos necessários para o tema do tablesorter -->
        <link rel="stylesheet" href="css/blue/style.css">

        <!-- jQuery e Tablesorter -->
        <script src="js/jquery-latest.js"></script>
        <script src="js/jquery.tablesorter.min.js"></script>

        <!-- Meu script -->
        <script src="js/scripts.js"></script>
        <title>Pratori</title>
        <style>
            div {
                width: 100px;
                height: 100px;
                margin: 5px;
                float: left;
            }
        </style>
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    </head>
    <body>

        <table border="0">
            <thead>
                <tr>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div style="background-color:rgb(<?php echo $cor['1']; ?>)"><?= $mensagem['r'][1] ?><br>1</div>
                        <div style="background-color:rgb(<?php echo $cor['2']; ?>)"><?= $mensagem['r'][2] ?><br>2</div>
                        <div style="background-color:rgb(<?php echo $cor['3']; ?>)"><?= $mensagem['r'][3] ?><br>3</div>
                        <div style="background-color:rgb(<?php echo $cor['4']; ?>)"><?= $mensagem['r'][4] ?><br>4</div>
                        <div style="background-color:rgb(<?php echo $cor['5']; ?>)"><?= $mensagem['r'][5] ?><br>5</div>
                        <div style="background-color:rgb(<?php echo $cor['6']; ?>)"><?= $mensagem['r'][6] ?><br>6</div>
                        <div style="background-color:rgb(<?php echo $cor['7']; ?>)"><?= $mensagem['r'][7] ?><br>7</div>
                        <div style="background-color:rgb(<?php echo $cor['8']; ?>)"><?= $mensagem['r'][8] ?><br>8</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <form action="#" method="POST">
                            <input hidden="on" type="text" name="espectro" value="<?= $cor[$imputs['piquete']] ?>" />
                            <input hidden="on" type="text" name="quali_pasto" value="<?= $quali_pasto[$imputs['piquete']] ?>" />
                            Onde estão os animais:<input type="text" width="2" name="piquete" value="<?= $imputs['piquete'] ?>" />    
                            <input type="submit" value="Atualizar dado do Drone" name="drone" />
                        </form>
                    </td>
                </tr>
                <tr>
                    <td>

                        <table border="1" class="tablesorter">
                            <thead>
                                <tr>
                                    <th>código</th>
                                    <th>piquete</th>
                                    <th>espectro de cor</th>
                                    <th>Qualidade do Pasto</th>
                                    <th>data</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dados as $value) { ?>
                                    <tr>

                                        <td><?= $value->cod ?></td>
                                        <td><?= $value->piquete ?></td>
                                        <td><?= $value->espectro ?></td>
                                        <td><?php 
                                                if ($value->quali_pasto === '1') {
                                                    echo 'Bom';
                                                } elseif ($value->quali_pasto === '2') {
                                                     echo 'Ruim';
                                                } else {
                                                    echo '';
                                                }
                                        ?></td>
                                        <td><?= $value->data ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>