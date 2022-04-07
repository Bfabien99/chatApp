<?php

    $pdo = new PDO('mysql:host=localhost;dbname=chatapp', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    if($pdo){
        return $pdo;
    }
    else{
        echo "Erreur de connexion à la base de données";
    }