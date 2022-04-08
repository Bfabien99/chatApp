<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/chatApp/images/conversation_chat_deal_agreement_icon_124665.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <script src="../jquery.js"></script>
    <title>signup</title>
    <style>
        .container{
            font-family: 'Montserrat Alternates',serif;
        }

        form{
            width: 80%;
            max-width: 600px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 10px 10px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0px 2px 10px #1A132F;
            gap: 1em;
        }

        .form-group{
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 10px 10px;
        }

        .form-group label{
            font-weight: 400;
            font-size: 1.2em;
        }

        .form-group input{
            width: 100%;
            padding: 5px 5px;
            border-radius: 5px;
            border: 1px solid #1A132F;
            outline: none;
            height: 35px;
        }

        .button-group{
            width: 100%;
            display: flex;
            justify-content: space-around;
            align-items: center;
            gap: 1em;
        }

        .button-group input{
            padding: 10px 10px;
            color: white;
            background-color: tomato;
            border: none;
            outline: none;
            border-radius: 5px;
            width: 40%;
            font-size: 1.2em;
        }

        .button-group a{
            padding: 10px 10px;
            color: white;
            background-color: #61A4BC;
            border: none;
            outline: none;
            border-radius: 5px;
            text-decoration: none;
        }

        .title{
            color: white;
            background-color: #1A132F;
            width: 80%;
            max-width: 600px;
            text-align: center;
            padding: 5px 5px;
            border-radius: 5px;
            box-shadow: 0px 2px 10px #1A132F;
        }
    </style>
</head>
<body>
    <div class="container">

        <h1 class="title">ChatApp - SignUp</h1>

        <form action="register.php" method="post" id="form">
        <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="pseudo">Pseudo</label>
                <input type="text" name="pseudo" id="pseudo" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="button-group">
                <a href="index.php" class="back">retour</a>
                <input type="submit" value="S'inscrire">
            </div>
            <div id="msg">

            </div>
        </form>

    </div>
</body>
<script>
    $('#form').on('submit',function(e){
        e.preventDefault();
        var name = $('#name').val();
        var pseudo = $('#pseudo').val();
        var password = $('#password').val();
            $.ajax(
            {
                url: 'post/registerpost.php',
                type: 'POST',
                data: {name: name, pseudo: pseudo, password: password},
                success: function(data)
                {
                    $('#msg').html(data);
                }
            });
    });
</script>
</html>