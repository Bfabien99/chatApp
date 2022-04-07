<?php
    session_start();
    require_once '../dbconnect.php';
    include '../functions/cleanform.php';
    $connect = $pdo;

    if(!empty($_POST["pseudo"]) && !empty($_POST["password"])){
        $pseudo = cleanForm($_POST["pseudo"]);
        $password = $_POST["password"];
        $sql = "SELECT * FROM users WHERE pseudo = '$pseudo' AND password = '".cryptPassword($password)."'";
        $result = $connect->prepare($sql);
        $result->execute();
        $result = $result->fetch();
        if($result){
            $_SESSION["name"] = $result['fullname'];
            $_SESSION["pseudo"] = $result['pseudo'];
            $_SESSION["id"] = $result['id'];
            echo "ok";
        }else{
            echo "Pseudo ou mot de passe incorrect";
        }
    }
    else {
        echo "Veuillez remplir tous les champs";
    }