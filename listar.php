<!DOCTYPE html>
<?php
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    include_once "processa.php";
    $lado = isset($_POST['lado']) ? $_POST['lado'] : 0;
    $cor = isset($_POST['cor']) ? $_POST['cor'] : "";
    $buscar = isset($_POST['buscar']) ? $_POST['buscar'] : 0;
    $procurar = isset($_POST['procurar']) ? $_POST['procurar'] : "";
    $tabuleiro_idtabuleiro = isset($_POST['tabuleiro_idtabuleiro']) ? $_POST['tabuleiro_idtabuleiro'] : 0;

    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    //variáveis

?>
<html>
<head>
    <meta charset="UTF-8">
    <script>
        function excluirRegistro(url){
            if (confirm("Confirma Exclusão?"))
                location.href = url;
        }
    </script>
    <?php include_once "menu.php"; ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
    
    <div class="" style="padding-left: 3vw;">
            
        <h4>Procurar: </h4>
    
    <form method="post">
        <h6><input class="form-check-input mt-0" style="background-color: #2e2e2e;" type="radio" name="buscar" value="1" <?php if ($buscar == "1") echo "checked" ?>> ID Quadrado</h6>
        <h6><input class="form-check-input mt-0" style="background-color: #2e2e2e;" type="radio" name="buscar" value="2" <?php if ($buscar == "2") echo "checked" ?>> Lado</h6>
        <h6><input class="form-check-input mt-0" style="background-color: #2e2e2e;" type="radio" name="buscar" value="3" <?php if ($buscar == "3") echo "checked" ?>> Cor</h6><br>
            
        <h4>Procurar Quadrado:</h4>
        <input type="text" class="btn btn-dark" style="width: 25vw;" name="procurar" idquadrado="procurar"  value="<?php echo $procurar;?>">
                <br><br>
        <button class="btn btn-dark" name="acao" idquadrado="acao" type="submit">Procurar</button>
                <br><br>
    
    </div>
    
    <!--Inputs-->
    
    </form>
        <div class="">
            <table class="table table-dark table-striped" >
                <thead>
                    <tr class="table-dark">
                        <th scope="col">ID quadrado</th>
                        <th scope="col">Lado</th>
                        <th scope="col">Cor</th>
                        <th scope="col">ID tabuleiro</th>
                        <th scope="col">Mostrar</th>
                        <th scope="col">Alterar</th>
                        <th scope="col">Deletar</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $quad = new quadrado("","", "","");
                    $lista = $quad->listar($buscar, $procurar);
                    foreach ($lista as $linha) { 
                ?>
                    <tr>
                        <th scope="row"><?php echo $linha['idquadrado'];?></th>
                        <th scope="row"><?php echo $linha['lado'];?></th>
                        <td scope="row"><?php echo $linha['cor'];?></td>
                        <td scope="row"><?php echo $linha['tabuleiro_idtabuleiro'];?></td>
                        <td scope="row"><a href="mostrar.php?idquadrado=<?php echo $linha['idquadrado']; ?>&lado=<?php echo $linha['lado'];?>&cor=<?php echo str_replace('#', '%23', $linha['cor']);?>">Quadrado</a></td>
                        <td scope="row"><a href="index.php?acao=editar&idquadrado=<?php echo $linha['idquadrado'];?>&tabuleiro_idtabuleiro=<?php echo $linha['tabuleiro_idtabuleiro'];?>"><img src="img/editar.png" style="width: 3vw;"></a> <br></td>
                        <td><?php echo " <a href=javascript:excluirRegistro('processa.php?acao=excluir&idquadrado={$linha['idquadrado']}')>";?><img src="img/excluir.png" style="width: 3vw;"></a> <br></td>
                    </tr>
                <?php } ?> 
                </tbody>
            </table>
        </div>

        <!--Tabela com as informações-->
        
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>