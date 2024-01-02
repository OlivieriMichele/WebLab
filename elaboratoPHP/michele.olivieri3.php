<h2 style="background: black; color:white; border-radius:15px; padding: 3% 3%;">Invio dati</h2>

    <form action="michele.olivieri3.php" method="get">
        <label for="A">A:</label>
        <input type="text" id="A" name="A" required>
        <br>
        <label for="B">B:</label>
        <input type="text" id="B" name="B" required>
        <br>
        <label for="O">O:</label>
        <input type="text" id="O" name="O" required>
        <br>
        <input type="submit" value="invia">
    </form>

<?php

    // Connessionee e verifica al database
    $db = new mysqli("localhost", "root", "", "giugno", 3306);
    if($db->connect_error){
        die("connection failed" . $db->connect_error);
    }

    // Controllare che le variabili A e B non siano nulle e che siano valide
    function validateNum($num){
        //TODO
        return $num >= 0 ? $num : null;
    }

    // Controllare che la variabile "O" non sia nulla e che sia uguale a "i" o "u".
    function validate($o){
        return ($o === 'o' || $o === 'u') ? $o : null;
    }

    if (isset($_GET['A']) && isset($_GET['B']) && isset($_GET['O'])) {
        $A = validateNum($_GET['A']);
        $B = validateNum($_GET['B']);
        $O = validate($_GET['O']);

        if($A!==null && $B!==null && $O!==null){
            
            // Leggere tutti i numeri appartenenti a ciascun insieme (A e B) su database e inserirli in due vettori distinti.
            $queryA = "SELECT valore FROM insiemi WHERE insieme = '$A'";
            $resultA = $db->query($queryA);
            $insiemeA = [];

            while($row = $resultA->fetch_assoc()){
                $insiemeA[] = $row['valore'];
            }

            $queryB = "SELECT valore FROM insiemi WHERE insieme = '$B'";
            $resultB = $db->query($queryB);
            $insiemeB = [];

            while($row = $resultB->fetch_assoc()){
                $insiemeB[] = $row['valore'];
            }
            
            for($i=0; $i<3; $i++){
                echo "A[$i] = $insiemeA[$i] ";
                echo "B[$i] = $insiemeB[$i] ";
            }

            // Creare un nuovo vettore contenente l'unione dei due insiemi se O vale u, altrimenti dovrà contenere l'intersezione dei due insiemi.
            
            // Inserire sul db il nuovo insieme, usando come id dell'insieme il successivo all'id massimo.

        } else {
            echo "Error: A,B or O are not valid";
        }
    }
?>