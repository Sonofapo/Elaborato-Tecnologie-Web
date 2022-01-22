<?php 
    //controllo login 
    //1. c'e' una sessione attiva
    //2. no login default catalogo
    //3.effettuato accesso (controllo) ... vedi punto 1.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //controlli infiniti della merd vomitevoleau
        echo $_POST["username"];
    } else {
        require "base.php";
    }
?>