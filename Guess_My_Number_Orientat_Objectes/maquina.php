<?php

require_once 'guess_my_number.php';
include_once 'guess_my_number.php';
session_start();
$nivell = $_SESSION["nivell"];
$_SESSION["contador"] = 0;
if ($nivell == 1) {
    $max = 10;
} else if ($nivell == 2) {
    $max = 50;
} else {
    $max = 100;
}

$objeto = new GuessMyNumberMaquina($max);
$_SESSION["obj"] = $objeto;

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body style="background-color: lightblue; text-align: center; font-family: arial"  >
        <br>
        
        <div style="margin-top: 200px">
            <?php
            echo "<p> El teu numero es el ". $objeto->PrintNumero() ."?</p>"
            ?>
            <form action="maquina2.php" method="get">
            <button type="submit" name="Valor_numero" value="si">Si</button>
            <button type="submit" name="Valor_numero" value="mes_gran">Més gran</button>
            <button type="submit" name="Valor_numero" value="mes_petit">Més petit</button>
            </form>
        </div>
    </body>
</html>

