
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body style="background-color: lightblue; text-align: center; font-family: arial" >
        <?php
        echo "<h1>Credits!!!</h1>";
        $fp = fopen("credits.txt", "r");
        while (!feof($fp)) {
            $linea = fgets($fp);
            echo $linea;
            echo "<br>";
        }
        fclose($fp);
        ?>

    </div>
</body>
</html>

