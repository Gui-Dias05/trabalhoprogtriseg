
<!DOCTYPE html>
<?php
    $title = "Usuário";
    $nome = isset($_POST['nome']) ? $_POST['nome'] : 0;
    $user = isset($_POST['user']) ? $_POST['user'] : "";
    $senha = isset($_POST['senha']) ? $_POST['senha'] : 0;
    //variáveis

    include_once "processa2.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    if ($acao == 'editar'){
        $idusuario = isset($_GET['idusuario']) ? $_GET['idusuario'] : "";
    if ($idusuario > 0)
        $dados = buscarDados($idusuario);
        //var_dump($dados);
}
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <?php include_once "menu.php"; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title><?php echo $title ?></title>
</head>

<body style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;" >
        <h4>Insira seus dados</h4><hr>
            <form method="post" action="processa2.php">
        <div style="padding-left: 2vw ;">
            <input readonly type="hidden" name="idusuario" idusuario="idusuario" value="<?php if ($acao == "editar") echo $dados['idusuario']; 
            else echo 0; ?>">
            
            <h5>Nome:</h5>
                <input class="btn btn-dark" require="true" type="text" name="nome" idusuario="nome" placeholder="Insira seu nome" 
                value="<?php if ($acao == "editar") echo $dados['nome'];?>"><br>
            <br>
            <h5>Login:</h5>
                <input class="btn btn-dark" required="true" name="user" id="user" type="text" required="true" placeholder="Digite o login" 
                value="<?php if ($acao == "editar") echo $dados['user'];?>" ><br>    
            <br>
            <h5>Senha:</h5>
                <input class="btn btn-dark" required="true" name="senha" id="senha" type="password" required="true" placeholder="Digite a senha" 
                value="<?php if ($acao == "editar") echo $dados['senha'];?>" ><br>    

            <br>
                <button class="btn btn-dark" name="acao" value="salvar" id="acao" type="submit">Salvar</button>
            </form>
        </div>
        <!--Inputs-->
            <br> 
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script> 
            
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
</body>
</html>