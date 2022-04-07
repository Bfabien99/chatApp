<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="../jquery.js"></script>
    <title>ChatApp</title>
    <style>
        form{
            width: 500px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 10px 10px;
            border: 1px solid black;
        }

        .form-group{
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 10px 10px;
        }
    </style>
</head>
<body>
    <div class="container">

        <form action="login.php" method="post" id="form">
            <div class="form-group">
                <label for="pseudo">Pseudo</label>
                <input type="text" name="pseudo" id="pseudo" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" value="Login">
                <a href="register.php" class="signUp">s'inscrire</a>
            </div>
            <div id="msg">

            </div>
        </form>

    </div>
</body>
<script>
    $('#form').on('submit',function(e){
        e.preventDefault();
        var pseudo = $('#pseudo').val();
        var password = $('#password').val();
        $.ajax({
            url: 'post/loginpost.php',
            type: 'POST',
            data: {pseudo: pseudo, password: password},
            success: function(data){
                if(data == 'ok'){
                    window.location.href = "page/home.php";
                }
                else{
                    $('#msg').html(data);
                }
            }
        });
        return false;
    });
</script>
</html>