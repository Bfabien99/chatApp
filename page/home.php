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
    <title>ChatApp Welcome</title>
</head>
<body>
    <div class="container">
        <div class="top">
            <h1>Welcome <?php echo $_SESSION["name"]; ?></h1>
            <a href="logout.php" class="logout">Logout</a>
        </div>

        <div class="section">
            <ul>
                <?php
                    $users = $db->query("SELECT * FROM users");
                    $users->execute();
                    $users = $users->fetchAll();
                    foreach($users as $user)
                    {   
                        if($user["id"] != $_SESSION["id"])
                        {
                            echo "<li><a href='home.php?user=".$user['id']."'>".$user['fullname']."</a></li>";
                        }
                        else{
                            echo "<li> >> ".$user['fullname']."</li>";
                        }
                        
                    }
                ?>
            </ul>
        </div>
    </div>
</body>
</html>