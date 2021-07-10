<?php

try {
    $mySQLconnect = new PDO('mysql:host=localhost;dbname=pagina_de_noticias', 'root', '');
} catch(PDOexception $e) {
    echo "Error: " . $e -> getMessage();
}