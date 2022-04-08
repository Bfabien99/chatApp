<?php
    require_once '../dbconnect.php';
    include '../functions/cleanform.php';
    $connect = $pdo;

    if(!empty($_POST["name"]) && !empty($_POST["pseudo"]) && !empty($_POST["password"])){
        $name = cleanForm($_POST["name"]);
        $pseudo = cleanForm($_POST["pseudo"]);
        $password = cryptPassword(strip_tags($_POST["password"]));
        $isUser = "SELECT * FROM users WHERE pseudo = '$pseudo'";
        $isUser = $connect->prepare($isUser);
        $isUser->execute();
        $isUser = $isUser->fetchAll();
        if($isUser){
            echo "Utilisateur Existe déja";
        }else
        {
            $sql = "INSERT INTO users (fullname, pseudo, password) VALUES ('$name', '$pseudo', '$password')";
            $result = $connect->prepare($sql);
            $result->execute();
            if($result){
                echo "Inscription réussie, vous pouvez vous connecter";
            }else{
                echo "Désolé, nous ne pouvons pas vous inscrire";
            }
        }
        
    }
    else {
        echo "Veuillez remplir tous les champs";
    }