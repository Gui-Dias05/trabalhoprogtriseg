<!DOCTYPE html>
<?php
    $title = "Tabuleiro";
    $lado = isset($_POST['lado']) ? $_POST['lado'] : 0;
    $cor = isset($_POST['cor']) ? $_POST['cor'] : "";
    //variáveis
    
    include_once "processa1.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    if ($acao == 'editar'){
        $idtabuleiro = isset($_GET['idtabuleiro']) ? $_GET['idtabuleiro'] : "";
    if ($idtabuleiro > 0)
        $dados = buscarDados($idtabuleiro);
        //var_dump($dados);
    }
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <?php include_once "menu.php"; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
    <title><?php echo $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    <style>
    </style>
</head>
<body style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
        <h4>Insira os dados do Tabuleiro</h4><hr> 
            <form method="post" action="processa1.php">
        <div style="padding-left: 2vw ;">
            <input readonly type="hidden" name="idtabuleiro" id="idtabuleiro" value="<?php if ($acao == "editar") echo $dados['idtabuleiro']; 
            else echo 0; ?>">
                
            <h5>Lado:</h5>
                <input class="btn btn-dark" require="true" type="text" name="lado" id="lado" placeholder="Digite o tamanho do lado" 
                value="<?php if ($acao == "editar") echo $dados['lado'];?>"><br>

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