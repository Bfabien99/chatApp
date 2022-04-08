<?php
    require '../dbconnect.php';
    $db = $pdo;
    $data = "";
    if (!empty($_POST['user'])) {
        
        $users = $db->query("SELECT * FROM users");
        $users->execute();
        $users = $users->fetchAll();
        $data.= "<h3>All Users - ".count($users)."</h3>";
        function notif($userId, $otherId){
            global $db;
            $notif = $db->query("SELECT * FROM messages WHERE toUser = '".$userId."' AND messages.fromUser = '".$otherId."' AND see = 0");
            $notif->execute();
            $notif = $notif->fetchAll();
            return count($notif);
        }

        foreach ($users as $user) {
            if ($user['id'] != $_POST['user']) {
                $data.= "<li><a class='otherUser' href='home.php?user=".$user['id']."'>".$user['fullname']." - @".$user['pseudo']."<em class='notif'>".notif($_POST['user'],$user['id'])."</em></a></li>";
            }
            else {
                $data.= "<li><a class='user' href='#'>".$user['fullname']."</a></li>";
            }
        }

        echo $data;
    }