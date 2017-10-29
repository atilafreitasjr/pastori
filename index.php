<?php
$imputs = filter_input_array(INPUT_POST, $_POST);

echo'<br>$animal<pre>';
print_r($imputs);
echo '</pre><br>';

$r1 = 100;
$g1 = 100 + 5;
$b1 = random_int(10, 200);
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
<div style="background-color:rgb(<?= $r1.','.$g1.','.$b1 ?>);">1</div>
<div style="background-color:rgb(<?= $r1.','.$g1.','.$b1 ?>);">2</div>
<div style="background-color:rgb(<?= $r1.','.$g1.','.$b1 ?>);">3</div>
<br>
<br>

<form action="#" method="POST">
    Onde estão os animais:<input type="text" name="animal" value="<?= $imputs['animal'] ?>" />
    <input hidden="on" type="text" name="r1" value="<?= $imputs['r1'] ?>" />
    <input type="submit" value="Atualizar dado do Drone" name="drone" />
</form><br>

 

 
</body>
</html>