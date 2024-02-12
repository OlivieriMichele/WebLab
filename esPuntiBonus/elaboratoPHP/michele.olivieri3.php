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

    // calcola l'id di valore massimo massimo
    $maxId = $db->query("SELECT MAX(id) as max_id FROM insiemi");

    // calcola l'insieme con indice massimo
    $maxIndex = $db->query("SELECT MAX(insieme) as max_index FROM insiemi");

    // Controllare che le variabili A e B non siano nulle e che siano valide, ovvero che siano numeri positivi e che sul db ci siano numeri appartenenti a quell'insieme.
    function validateNum($num, $max_index){
        return $num >= 0 && $num <= $max_index? $num : null;
    }

    // Controllare che la variabile "O" non sia nulla e che sia uguale a "i" o "u".
    function validate($o){
        return ($o === 'i' || $o === 'u') ? $o : null;
    }

    if (isset($_GET['A']) && isset($_GET['B']) && isset($_GET['O'])) {
        $row = $maxIndex->fetch_assoc();
        $max_index = $row['max_index'];
        $A = validateNum($_GET['A'], $max_index);
        $B = validateNum($_GET['B'], $max_index);
        $O = validate($_GET['O']);

        if($A!==null && $B!==null && $O!==null){
            
            // Leggere tutti i numeri appartenenti a ciascun insieme (A e B) su database e inserirli in due vettori distinti.
            $resultA = $db->query("SELECT valore FROM insiemi WHERE insieme = '$A'");
            $insiemeA = [];

            while($row = $resultA->fetch_assoc()){
                $insiemeA[] = $row['valore'];
            }

            $resultB = $db->query("SELECT valore FROM insiemi WHERE insieme = '$B'");
            $insiemeB = [];

            while($row = $resultB->fetch_assoc()){
                $insiemeB[] = $row['valore'];
            }

            // Creare un nuovo vettore contenente l'unione dei due insiemi se O vale u, altrimenti dovrà contenere l'intersezione dei due insiemi.
            $nuovoInsieme = [];
            $nuovoInsieme = ($O === 'u') ? array_unique(array_merge($insiemeA,$insiemeB)) : (array_intersect($insiemeA,$insiemeB));
            
            // Inserire sul db il nuovo insieme, usando come id dell'insieme il successivo all'id massimo.
            $row = $maxId->fetch_assoc();
            $newId = $row['max_id'] + 1;
            $newIndex = $max_index + 1;
            foreach ($nuovoInsieme as $elem) {
                $insertQuery = "INSERT INTO insiemi (id, valore, insieme) VALUES ($newId, '$elem', $newIndex)";
                $db->query($insertQuery);
                $newId++;
            }

        } else {
            echo "Error: A,B or O are not valid";
        }

    } else {
        echo "Error: some data is missing";
    }
?>