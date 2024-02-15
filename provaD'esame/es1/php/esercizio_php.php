<?php

// connessione al database
$db = new mysqli("localhost", "root", "", "db_esami");

if ($db->connect_error) {
    die("connection failed" . $db->connect_error);
}

// funzioni per il controllo della validità dei dati
function validateName($name) {
    return is_string($name) ? $name : null;
}

function validateCF($cf) {
    return strlen($cf) == 16 ? $cf : null;
}

function validateData($nascita) {
    return DateTime::createFromFormat('Y-m-d', $nascita) !== false ? $nascita : null;
}

function validateGender($gender) {
    return $gender == 'M' || $gender == 'F' || $gender == 'A' ? $gender : null;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['codFis']) && isset($_POST['nascita']) && isset($_POST['sesso'])) {
        $nome = validateName($_POST['nome']);
        $cognome = validateName($_POST['cognome']);
        $codFis = validateCF($_POST['codFis']);
        $nascita = validateData($_POST['nascita']);
        $sesso = validateGender($_POST['sesso']);

        if ($nome != null && $cognome != null){
            if ($codFis != null) {
                if ($nascita != null) {
                    if ($sesso != null) {

                        $query = "INSERT INTO cittadino (nome, cognome, codicefiscale, datanascita, sesso) 
                                  VALUES ('$nome', '$cognome', '$codFis', '$nascita', '$sesso')";

                        if ($db->query($query)) {
                            echo "insert success.";
                        } else {
                            echo "ERROR: insert fail, " . $db->error;
                        }

                    } else echo "ERROR: gender not valid";
                } else echo "ERROR: birthday date not valid.";
            } else echo "ERROR: codice fiscale not valid.";
        } else echo "ERROR: name or surname is not valid.";
    } 

}

// Visualizza i dati dalla tabella
$sql = isset($_POST['id']) ? "SELECT * FROM cittadino WHERE id = " . $_POST['id'] : "SELECT * FROM cittadino";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Codice Fiscale</th>
            <th>Data di Nascita</th
            ><th>Sesso</th>
        </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['idcittadino']}</td>
            <td>{$row['nome']}</td>
            <td>{$row['cognome']}</td>
            <td>{$row['codicefiscale']}</td>
            <td>{$row['datanascita']}</td>
            <td>" . $row['sesso'] . "</td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "Nessun dato trovato.";
}

// Chiudi la connessione al database
$db->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>esercizio php</title>
</head>
<body>
    
    <h2 style="background: black; color:white; border-radius:15px; padding: 3% 3%;">Inserisci ciattadino</h2>

    <form action="esercizio_PHP.php" method="post">
        <label for="nome">nome:</label>
        <input type="text" id="nome" name="nome" required></br>

        <label for="cognome">cognome:</label>
        <input type="text" id="cognome" name="cognome" required></br>

        <label for="codFis">codice fiscale:</label>
        <input type="text" id="codFis" name="codFis" required></br>

        <label for="nascita">data di nascita:</label>
        <input type="date" id="nascita" name="nascita" required></br>

        <label for="sesso">sesso:</label>
        <input type="text" id="sesso" name="sesso" required></br>
        
        <input type="submit" value="invia">
    </form>
    
</body>
</html>