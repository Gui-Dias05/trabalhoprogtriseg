<?php 
    session_start();
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    include_once('classe/ClassUsuario.php');

    $user = isset($_POST["user"]) ? $_POST["user"] : "";     
    $senha = isset($_POST["senha"]) ? $_POST["senha"] : ""; 
    $action = isset($_GET["action"]) ? $_GET["action"] : ""; 
    $mensagem = "";
    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
    <center>
    <div >
    <main><br><br><br><br><br><br><br><br>
        <h2>User</h2> <br>
        <form action="login.php?action=user" method="post">
            <div>
                <input class="btn btn-dark" type="text" name="user" id="user" required="true" placeholder="Insira o user">
                <div class="underline"></div>
            </div><br>
            <div>
                <input class="btn btn-dark" type="password" name="senha" id="senha" required="true" placeholder="Insira a senha">
                <div class="underline"></div>
            </div><br>
            <input class="btn btn-dark" type="submit" value="Entrar">
        </form>
        <center>
        <?php
        error_reporting(0);
        // print_r($_SESSION['nome']);
            if($_GET['action'] == 'user'){
                $usuario = new Usuario("","","","");
                if ($usuario->efetuarlogin($user, $senha) == true){
                    $mensagem = "O user foi efetuado com sucesso!";
                    echo $mensagem;
                    header("location:listar2.php");
                } else {
                    $mensagem = "Erro no user, confira os dados";
                    echo $mensagem;
                }
            } 
        ?>
    </main>
    </div>

    <style>
        a, a:hover {
            color: white;
            text-decoration: none;
        }
        body{
            background-color: #d3d3d3;
        }
        </style>
        
        <!--Parte do estilo-->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>