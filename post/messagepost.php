<?php
    require '../dbconnect.php';
    $connect = $pdo;
    if(!empty($_POST['user']) && !empty($_POST['toUser']) && !empty($_POST['msgtext'])){
        $toUser = $_POST['toUser'];
        $msgtext = $_POST['msgtext'];
        $fromUser = $_POST['user'];
        $sql = "INSERT INTO messages (message, fromUser, toUser) VALUES ('$msgtext', '$fromUser', '$toUser')";
        $result = $connect->prepare($sql);
        $result->execute();
        if($result){
            echo "ok";
        }else{
            echo "Désolé, nous ne pouvons pas vous envoyé le message";
        }
    }
    else {
        echo "Veuillez remplir tous les champs";
    }
?>