<?php 

    //che legga i dati che gli sono stati inviati tramite GET nelle variabili "A", "B" e "O".

    // Connessionee e verifica al database
    $db = mysqli("localhost", "root", "", "giugno", 3306);
    if($this->db->connect_error){
        die("connection failed", $db->connect_error);
    }

    function validateNum($num){
        //TODO
    }

    // Controllare che le variabili "A" e "B" non siano nulle e che siano valide, ovvero che siano numeri positivi e che sul db ci siano numeri appartenenti a quell'insieme.
    if (isset($_GET['A']) && isset($_GET['B']) && isset($_GET['O'])) {
        $A = validateNum($_GET['A']);
        $B = validateNum($_GET['B']);
        $O = validateNum($_GET['O']);

        if($A!==null $B!==null $O!==null){
            $result = $db->query("SELECT numero FROM insiemi WHERE tipo = 'A'");
        }
    }

    // Controllare che la variabile "O" non sia nulla e che sia uguale a "i" o "u".

    // Leggere tutti i numeri appartenenti a ciascun insieme (A e B) su database e inserirli in due vettori distinti.

    // Creare un nuovo vettore contenente l'unione dei due insiemi se O vale u, altrimenti dovrà contenere l'intersezione dei due insiemi.

    // Inserire sul db il nuovo insieme, usando come id dell'insieme il successivo all'id massimo.


?>
