<?php
    require '../dbconnect.php';

    if(!empty($_POST['user']) && !empty($_POST['toUser'])){
        $msg="";
        $connect = $pdo;
        $messages = $connect->query("SELECT * FROM messages WHERE (fromUser = '".$_POST['user']."' AND toUser = '".$_POST['toUser']."') OR (fromUser = '".$_POST['toUser']."' AND toUser = '".$_POST['user']."')");
        $messages->execute();
        $messages = $messages->fetchAll();
        foreach($messages as $message)
        {
            if($message['fromUser'] == $_POST['user'])
            {
                $msg .="<div class='msg-sent'><p>".$message['message']."</p></div>";
            }
            else
            {
                $msg .="<div class='msg-received'><p>".$message['message']."</p></div>";
            }
        }

        echo $msg;
    }
    