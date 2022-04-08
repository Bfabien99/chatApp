<?php
    require '../dbconnect.php';

    if(!empty($_POST['user']) && !empty($_POST['toUser'])){
        $msg="";
        $connect = $pdo;
        $messages = $connect->query("SELECT * FROM messages WHERE (fromUser = '".$_POST['user']."' AND toUser = '".$_POST['toUser']."') OR (fromUser = '".$_POST['toUser']."' AND toUser = '".$_POST['user']."')");
        $messages->execute();
        $messages = $messages->fetchAll();
        $notifSeen = $connect->prepare("UPDATE messages SET see = 1 WHERE (fromUser = '".$_POST['toUser']."' AND toUser = '".$_POST['user']."')");
        $notifSeen->execute();
        foreach($messages as $message)
        {
            if(($message['fromUser'] == $_POST['user']) && ($message['see'] == 0))
            {
                $msg .="<div class='msg-sent'><p>".nl2br($message['message'])."</p><em>".date("H:i:s",strtotime($message['date']))."</em></div>";
            }
            elseif(($message['fromUser'] == $_POST['user']) && ($message['see'] == 1))
            {
                $msg .="<div class='msg-sent'><p>".nl2br($message['message'])."</p><em>".date("H:i:s",strtotime($message['date']))." <i>vv</i></em></div>";
            }
            else
            {
                $msg .="<div class='msg-received'><p>".nl2br($message['message'])."</p><em>".date("H:i:s",strtotime($message['date']))."</em></div>";
            }
        }

        echo $msg;
    }
    