<?php
session_start();
require '../dbconnect.php';
$db = $pdo;
if(!isset($_SESSION["pseudo"]) && !isset($_SESSION["id"])){
    header("Location: ../index.php");
}

if(isset($_GET["user"])){
    $_SESSION["toUser"] = $_GET["user"];
    header('location: chat.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/chatApp/images/conversation_chat_deal_agreement_icon_124665.ico" type="image/x-icon">
    <script src="../../jquery.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <title>ChatApp Welcome</title>
    <style>
        .container{
            justify-content: space-between;
            min-height: 15vh;
            gap: 2em;
            max-width: 800px;
            width: 100%;
        }

        a{
            text-decoration: none;
            color: white;
            padding: 5px 5px;
            display: inline-block;
            font-size: 1.3em;
            text-align: center;
        }

        .top{
            padding: 10px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            color: white;
            width: 100%;
            background-color: #61A4BC;
            font-family: Roboto , serif;
        }

        .logout{
            background-color: #5c8df9;
            padding: 10px;
            border-radius: 50px;
            transition: all 0.1s;
        }

        .logout:hover{
            background-color:#5B7DB1 ;
        }

        .title{
            font-family: 'Rubik Moonrocks',serrif;
            font-weight: 400;
            text-decoration: underline;
            color: white;
        }

        .section{
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1em;
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            font-family: Poppins, serif;
        }

        .section h3{
            color: white;
        }

        ul{
            display: flex;
            flex-direction: column;
            min-height: 100px;
            justify-content: space-around;
            list-style-type: none;
            width: 90%;
            margin: auto;
            align-items: center;
            gap: 1em;
        }

        .user{
            background-color: #61A4BC;
            width: 100%;
            max-width: 300px;
        }

        .otherUser{
            background-color: #1A132F;
            min-width: 100%;
            max-width: 300px;
            transition: all 0.1s;
            position: relative;
        }

        .otherUser:hover{
            background-color: #1A232F;
        }

        .notif{
            background-color: #5c9df8;
            min-width:10px;
            min-height:10px;
            padding: 5px;
            position: absolute;
            border-radius: 20%;
            top: 0px;
            right: -20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="top">
            <h1>Welcome <?php echo ucwords($_SESSION["name"]); ?></h1>
            <a href="logout.php" class="logout">Logout</a>
        </div>

        <h1 class="title">ChatApp</h1>

        <div class="section" >

            <?php
               
                $users = $db->query("SELECT * FROM users");
                $users->execute();
                $users = $users->fetchAll();

                function notif($userId, $otherId){
                    global $db;
                    $notif = $db->query("SELECT * FROM messages WHERE toUser = '".$userId."' AND messages.fromUser = '".$otherId."' AND see = 0");
                    $notif->execute();
                    $notif = $notif->fetchAll();
                    return count($notif);
                }
                
            ?>

            <?php if(!empty($users)): ?>

            <ul id="box">

                <h3>All Users - <?= count($users);?></h3>
                
                <?php foreach($users as $user):?>
                    <?php if($user["id"] != $_SESSION["id"]):?>
                        <li><a class="otherUser" href="home.php?user=<?=$user['id'];?>"><?=$user['fullname']." - @".$user['pseudo'];?><em class="notif"><?= notif($_SESSION["id"],$user['id']) ;?></em></a></li>
                    <?php else:?>
                        <li><a class="user" href="#"><?=$user['fullname'];?></a></li>
                    <?php endif;?>
                <?php endforeach;?>
               
            </ul>

            <?php endif;?>

        </div>
    </div>
</body>
<script>
    $(document).ready(function()
    {
        setInterval(function(){
            var user = <?=$_SESSION['id'];?>;
            $.ajax({
                url: 'notify.php',
                type: 'POST',
                data: {user: user},
                dataType:'text',
                success: function(data){
                    $('#box').html(data);
                }
            });
        },700);

    });
</script>
</html>