
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
    </head>
    <body style="background-color: lightblue; text-align: center; font-family: arial" >
        <?php
        echo "<h1>Benvinguts al joc GUESS MY NUMBER!!!</h1>"
        ?>
        <div>
            <h2>Instruccions: </h2>

            <p>1. Selecciona qui ha d'adivinar el numero, si la máquina o tu. Pensa que si és la màquina qui ha d'adivinar el 
                número has de tenir aquest ja previament pensat</p>


            <form action="Modalitat.php" method="get">
                <div style="border: solid; margin-left: 43%; margin-right: 43%">
                    <br>

                    <input type="radio" name="modalidad" value="M"/> Maquina
                    <input type="radio" name="modalidad" value="P"/> Persona<br/><br>
                </div>
                <p>2. Selecciona en qiun rang de numeros vols jugar. Per realitzar-ho has d'escollir un nivell.</p>

                <p>Indica a quin nivell vols jugar: </p>

                <div style="border: solid; margin-left: 30%; margin-right: 30%">
                    <br>

                    <input type="radio" name="nivell" value="1"/> Nivell 1: del 1 al 10
                    <input type="radio" name="nivell" value="2"/> Nivell 2: del 1 al 50
                    <input type="radio" name="nivell" value="3"/> Nivell 3: del 1 al 100<br><br>
                </div>

                <br>
                <br>
                <input type="submit" value="Enviar">
            </form>
            <form action="estadistiques_finals.php" method="get">
                <button type="submit" name="veure_estadistiques" value="si">Veure estadistiques</button>
            </form>
            <input type="submit" value="Credits" onclick="window.open('credits.php')">
        </div>
    </body>
</html>

