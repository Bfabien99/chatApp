<?php
    require '../dbconnect.php';
    $connect = $pdo;
    if(!empty($_POST['user']) && !empty($_POST['toUser']) && !empty($_POST['msgtext'])){
        $toUser = strip_tags($_POST['toUser']);
        $msgtext = strip_tags(trim($_POST['msgtext']));
        $fromUser = strip_tags($_POST['user']);
        $sql = "INSERT INTO messages (message, fromUser, toUser) VALUES ('$msgtext', '$fromUser', '$toUser')";
        $result = $connect->prepare($sql);
        $result->execute();
        if($result){
            echo "ok";
        }else{
            echo "Désolé, nous ne pouvons pas vous envoyé le message";
        }
    }
    else{
        echo "Veuillez remplir tous les champs";
    }
?>