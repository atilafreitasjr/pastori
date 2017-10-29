<?php
session_start();
$imputs = filter_input_array(INPUT_POST, $_POST);

isset($imputs['piquete']) ? '' : $imputs['piquete'] = '1';

for ($index = 1; $index < 9; $index++) {
    
    $mensagem['g'][$index] = '';
    $mensagem['r'][$index] = '';
    
    if (!isset($_SESSION['r'][$index])) {        
        $_SESSION['r'][$index] = 100;
       
    }
    if (!isset($_SESSION['g'][$index])) {
        $_SESSION['g'][$index] = 100;
       
    }
    
    if ($index == $imputs['piquete']) {
        if($_SESSION['r'][$index] > 250){
            $_SESSION['r'][$index] = 251;
            $mensagem['r'][$index] = 'Troque de piquete';
        } else {
            $_SESSION['r'][$index] = $_SESSION['r'][$index] + 30;
        }
        if ($_SESSION['g'][$index]< 10) {
            $_SESSION['g'][$index] = 10;
        } else {
            $_SESSION['g'][$index] = $_SESSION['g'][$index] - 10;
        }
        $b[$index] = random_int(50, 200);
    } else {
        if($_SESSION['r'][$index] < 10){
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
echo'<br>$index<pre>';
print_r($cor);
echo '</pre><br>';
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>css demo</title>
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

        <span id="result">&nbsp;</span>
        <div style="background-color:rgb(<?php echo $cor['1']; ?>)"><?= $mensagem['r'][1] ?><br>1</div>
        <div style="background-color:rgb(<?php echo $cor['2']; ?>)"><?= $mensagem['r'][2] ?><br>2</div>
        <div style="background-color:rgb(<?php echo $cor['3']; ?>)"><?= $mensagem['r'][3] ?><br>3</div>
        <div style="background-color:rgb(<?php echo $cor['4']; ?>)"><?= $mensagem['r'][4] ?><br>4</div>
        <div style="background-color:rgb(<?php echo $cor['5']; ?>)"><?= $mensagem['r'][5] ?><br>5</div>
        <div style="background-color:rgb(<?php echo $cor['6']; ?>)"><?= $mensagem['r'][6] ?><br>6</div>
        <div style="background-color:rgb(<?php echo $cor['7']; ?>)"><?= $mensagem['r'][7] ?><br>7</div>
        <div style="background-color:rgb(<?php echo $cor['8']; ?>)"><?= $mensagem['r'][8] ?><br>8</div>
        <br>
        <br>

        <form action="#" method="POST">
            Onde estão os animais:<input type="text" name="piquete" value="<?= $imputs['piquete'] ?>" />    
            <input type="submit" value="Atualizar dado do Drone" name="drone" />
        </form>
        <br>
    </body>
</html>