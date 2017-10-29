<?php
session_start();

$imputs = filter_input_array(INPUT_POST, $_POST);

isset($imputs['piquete']) ? '' : $imputs['piquete'] = '1';

echo'<br>$animal<pre>';
print_r($imputs);
echo '</pre><br>';

for ($index = 1; $index < 4; $index++) {

    if ($index == $imputs['piquete']) {
        $r[$index] = 100 + 30;
        $g[$index] = random_int(50, 200);
        $b[$index] = random_int(50, 200);
    } else {
        $r[$index] = random_int(50, 200);
        $g[$index] = 100 + 10;
        $b[$index] = random_int(50, 200);
    }
    $cor[$index] = $r[$index] . ',' . $g[$index] . ',' . $b[$index];
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
        <div style="background-color:rgb(<?php echo $cor['1']; ?>)">1</div>
        <div style="background-color:rgb(<?php echo $cor['2']; ?>)">2</div>
        <div style="background-color:rgb(<?php echo $cor['3']; ?>)">3</div>
        <br>
        <br>

        <form action="#" method="POST">
            Onde estão os animais:<input type="text" name="piquete" value="<?= $imputs['piquete'] ?>" />    
            <input type="submit" value="Atualizar dado do Drone" name="drone" />
        </form><br>




    </body>
</html>