<?php
require_once 'guess_my_number.php';
include_once 'guess_my_number.php';
session_start();
$objeto = $_SESSION["obj"];
$min = $objeto ->getMin();
$numero = $objeto ->getNumeroEndevinar();
$max = $objeto ->getMax();

$contador = $_SESSION["contador"];

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body style="background-color: lightblue; text-align: center; font-family: arial"  >
        <div>
<?php
if ($_GET["Valor_numero"] == "si") {
    header("Location: estadistiques.php");
}else if ($_GET["Valor_numero"] == "mes_gran"){
    $objeto->setMin($numero+1);
    
    $objeto->setNumeroEndevinar(intval($numero + (($max - $min) / 2)));
    if($objeto -> getNumeroEndevinar() > $max){
        $objeto->setNumeroEndevinar(intval($max));
    }
}else{
    $objeto->setMax($numero-1);
    $objeto->setNumeroEndevinar(intval($numero - (($max - $min) / 2)));
        if($objeto -> getNumeroEndevinar() < $min){
        $objeto->setNumeroEndevinar(intval($min));
    }
}
if ($min == $max) {
    header("Location: estadistiques.php");
}


echo "<div style='margin-top: 200px'>";
echo "<p>El teu numero es el". $objeto ->PrintNumero(). " ?";
$contador ++;
$_SESSION["obj"] = $objeto;
$_SESSION["contador"] = $contador;
?>



            <form action="maquina2.php" method="get">
                <button type="submit" name="Valor_numero" value="si">Si</button>
                <button type="submit" name="Valor_numero" value="mes_gran">Més gran</button>
                <button type="submit" name="Valor_numero" value="mes_petit">Més petit</button>
        </div>
    </form>
</div>
</body>
</html>



