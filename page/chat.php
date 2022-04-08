<?php
    session_start();
    require_once '../dbconnect.php';
 
    if(isset($_SESSION['toUser'])){
        if ($_SESSION['toUser'] == $_SESSION['id']) 
        {
            header("Location: home.php");
        }
        else
        {
            $connect = $pdo;
            $isUser = "SELECT * FROM users WHERE id = '".$_SESSION['toUser']."'";
            $isUser = $connect->prepare($isUser);
            $isUser->execute();
            $isUser = $isUser->fetch();
            if ($isUser) {
                $toId = $isUser['id'];
                $toName = $isUser['fullname'];
                $toPseudo = $isUser['pseudo'];
            }
            else {
                echo "user does'nt exist";
            }
        }
        
    }
    else{
        header("Location: home.php");
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="/chatApp/images/conversation_chat_deal_agreement_icon_124665.ico" type="image/x-icon">
    <script src="../jquery.js"></script>
    <title>Chat</title>
    <style>
        .container{
            background-color: #F7E2E2;
            justify-content: space-between;
            max-width: 800px;
            width: 100%;
        }
        .header{
            width: 100%;
            height: 50px;
            background-color: #1A132F;
            display: flex;
            justify-content: space-around;
            align-items: center;
            font-family: 'Montserrat Alternates',serif;
        }
        .from{
            color: white;
            background-color: #5c8df9;
            padding: 5px 5px;
            border-radius: 0 15px 0 15px;
        }
        .to{
            color: white;
            background-color: #bbb;
            padding: 5px 5px;
            border-radius: 0 15px 0 15px;
        }
        .title{
            font-family: 'Rubik Moonrocks',serrif;
            font-weight: 400;
            text-decoration: underline;
        }
        .group{
            width: 90%;
            display: flex;
            flex-direction: column;
            background-color: white;
            justify-content: space-around;
            padding: 10px 5px;
            border-radius: 5px;
            gap: 1em;
            max-width: 700px;
            overflow: auto;
        }
        form{
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1em;
            width: 100%;
        }
        .group form textarea{
            width: 90%;
            min-width: 300px;
            border: 2px solid #5c8df9;
            border-radius: 10px 0px 5px 0px;
            padding: 10px;
            min-height: 100px ;
            color: #1A132F;
        }
        .group form input{
            padding: 10px 10px;
            color: white;
            background-color: #61A4BC;
            border: none;
            outline: none;
            border-radius: 3px;
            cursor: pointer;
            transition: all 0.1s;
            font-size: 1.2em;
        }
        .group form input:hover{
            background-color: #51A4BC;
        }
        .message{
            width: 100%;
            display: flex;
            flex-direction: column;
            border: 1px solid #C1C1C1;
            margin: auto;
            background-color: white;
            border-radius: 5px;
            height: 450px;
            overflow: auto;
            font-family: 'Montserrat Alternates',serif;
            padding: 3px 5px;
        }
        .message em{
            color: #f1f1f1;
            font-size: 0.7em;
            opacity: 0.8;
        }
        .msg-sent{
            align-self: flex-end;
            display: flex;
            flex-direction: column;
            background-color: #5c8df9;
            border-radius: 10px 10px 1px 10px;
            padding: 5px;
            margin: 10px;
            width: 30%;
            min-width: 200px;
            max-width: 300px;
            right: 0;
            font-size: 1.1em;
            flex-wrap: wrap;
        }
        .msg-received{
            align-self: flex-start;
            display: flex;
            flex-direction: column;
            background-color: #f1f1f1;
            border-radius: 10px 10px 10px 1px;
            padding: 10px;
            margin: 10px;
            width: 30%;
            min-width: 200px;
            max-width: 300px;
            flex-wrap: wrap;
        }
        .msg-received em{
            color: #5B7DB1;
        }

        .back{
            text-decoration: none;
            color: white;
            background-color: #1A132F;
            padding:10px;
            border-radius: 3px;
            margin-bottom:10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h3 class="from">From : <?= $_SESSION['name'];?></h3>
            <h3 class="to">To : <?= $toName ;?></h3>
        </div>

        <h1 class="title">ChatApp</h1>

        <div class="group">
        <div class="message">
                <?php
                    $connect = $pdo;
                    $messages = $connect->prepare("SELECT * FROM messages WHERE (fromUser = '".$_SESSION['id']."' AND toUser = '".$toId."') OR (fromUser = '".$toId."' AND toUser = '".$_SESSION['id']."')");
                    $messages->execute();
                    $messages = $messages->fetchAll();
                    
                    $notifSeen = $connect->prepare("UPDATE messages SET see = 1 WHERE (fromUser = '".$toId."' AND toUser = '".$_SESSION['id']."')");
                    $notifSeen->execute();
                ?>

                <?php foreach($messages as $message):?>
                    <?php if(($message['fromUser'] == $_SESSION['id']) && ($message['see'] == 1)):?>
                        <div class='msg-sent'><p><?=nl2br($message['message']);?></p><em><?=date("H:i:s",strtotime($message['date']))?> vv</em></div>
                    <?php elseif(($message['fromUser'] == $_SESSION['id']) &&  ($message['see'] == 0)):?>
                        <div class='msg-sent'><p><?=nl2br($message['message']);?></p><em><?=date("H:i:s",strtotime($message['date']))?></em></div>
                    <?php else:?>
                        <div class='msg-received'><p><?=nl2br($message['message']);?></p><em><?=date("H:i:s",strtotime($message['date']))?></em></div>
                    <?php endif;?>
                <?php endforeach;?>
        </div>

        <form action="chat.php" method="post" id="form">
            <?php 
                echo "<input type='hidden' name='toId' value='".$toId."' id='toUser'>";
                echo "<input type='hidden' name='toName' value='".$_SESSION['id']."' id='user'>";
            ?>
            <textarea name="msgtext" id="msgtext" placeholder="write your message…"></textarea>
            <input type="submit" value="Envoyer" name="submit">
        </form>
        </div>

        <a href="home.php" class="back">Retour</a>
    </div>
</body>
<script>
    $(document).ready(function()
    {

        $('#form').on('submit',function(e)
        {   
            e.preventDefault();
            var msg = $('#msgtext').val();
            var toUser = $('#toUser').val();
            var user = $('#user').val();
            $.ajax({
                url: '../post/messagepost.php',
                type: 'POST',
                data: {msgtext: msg, toUser: toUser, user: user},
                success: function(data){
                    $('#msgtext').val('');
                }
            });
 
        });

        

        setInterval(function(){
            var toUser = $('#toUser').val();
            var user = $('#user').val();
            $.ajax({
                url: 'messagereceived.php',
                type: 'POST',
                data: {toUser: toUser, user: user},
                dataType:'text',
                success: function(data){
                    $('.message').html(data);
                }
            });
        },700);

    });
</script>
</html>