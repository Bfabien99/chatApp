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
    <script src="../../jquery.js"></script>
    <title>Chat</title>
    <style>
        .message{
            width: 90%;
            display: flex;
            flex-direction: column;
            border: 1px solid black;
            justify-content: center;
            margin: auto;
        }
        .msg-sent{
            align-self: flex-end;
            display: flex;
            flex-direction: column;
            background-color: #5c8df9;
            border-radius: 10px;
            padding: 10px;
            margin: 10px;
            width: 30%;
            right: 0;
        }
        .msg-received{
            align-self: flex-start;
            display: flex;
            flex-direction: column;
            background-color: #f1f1f1;
            border-radius: 10px;
            padding: 10px;
            margin: 10px;
            width: 30%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h3>From :<?= $_SESSION['name'];?></h3>
            <h3>To :<?= $toName ;?></h3>
        </div>

        <div class="message">
                <?php
                    $connect = $pdo;
                    $messages = $connect->query("SELECT * FROM messages WHERE (fromUser = '".$_SESSION['id']."' AND toUser = '".$toId."') OR (fromUser = '".$toId."' AND toUser = '".$_SESSION['id']."')");
                    $messages->execute();
                    $messages = $messages->fetchAll();
                    foreach($messages as $message)
                    {
                        if($message['fromUser'] == $_SESSION['id']){
                            echo "<div class='msg-sent'><p>".$message['message']."</p></div>";
                        }else{
                            echo "<div class='msg-received'><p>".$message['message']."</p></div>";
                        }
                    }
                ?>
        </div>

        <form action="chat.php" method="post" id="form">
            <?php 
                echo "<input type='hidden' name='toId' value='".$toId."' id='toUser'>";
                echo "<input type='hidden' name='toName' value='".$_SESSION['id']."' id='user'>";
            ?>
            <textarea name="msgtext" id="msgtext" cols="30" rows="10"></textarea>
            <input type="submit" value="Envoyer" name="submit">
        </form>

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