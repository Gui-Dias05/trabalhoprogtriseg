<!DOCTYPE html>
<?php
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    include_once "processa2.php";
    $nome = isset($_POST['nome']) ? $_POST['nome'] : 0;
    $login = isset($_POST['login']) ? $_POST['login'] : "";
    $senha = isset($_POST['senha']) ? $_POST['senha'] : "";

    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    
    $dados;
    if ($acao == 'editar'){
        $idusuario = isset($_GET['idusuario']) ? $_GET['idusuario'] : "";
    if ($idusuario > 0)
        $dados = buscarDados($idusuario);
    }

    $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : ""; 
    $buscar = isset($_POST['buscar']) ? $_POST['buscar'] : 0;
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
        <h6><input class="form-check-input mt-0" style="background-color: #2e2e2e;" type="radio" name="buscar" value="1" <?php if ($buscar == "1") echo "checked" ?>> ID Usuário</h6>
        <h6><input class="form-check-input mt-0" style="background-color: #2e2e2e;" type="radio" name="buscar" value="2" <?php if ($buscar == "2") echo "checked" ?>> Nome<br></h6>
        <h6><input class="form-check-input mt-0" style="background-color: #2e2e2e;" type="radio" name="buscar" value="3" <?php if ($buscar == "3") echo "checked" ?>> Login<br></h6><br>
            
        <h4>Procurar Usuário:</h4>
        <input type="text" class="btn btn-dark" style="width: 25vw;" name="procurar" idusuario="procurar"  value="<?php echo $procurar;?>">
                <br><br>
        <button class="btn btn-dark" name="acao" idusuario="acao" type="submit">Procurar</button>
            <br><br>
    </div>
    
    <!--Inputs-->
    
    </form>
        <div class="">
            <table class="table table-dark table-striped" >
                <thead>
                    <tr class="table-dark">
                        <th scope="col">ID usuário</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Login</th>
                        <th scope="col">Senha</th>
                        <th scope="col">Alterar</th>
                        <th scope="col">Deletar</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $quad = new Usuario("","", "","");
                    $lista = $quad->listar($buscar, $procurar);
                    foreach ($lista as $linha) { 
                ?>
                    <tr>
                        <th scope="row"><?php echo $linha['idusuario'];?></th>
                        <th scope="row"><?php echo $linha['nome'];?></th>
                        <td scope="row"><?php echo $linha['user'];?></td>
                        <td scope="row"><?php echo $linha['senha'];?></td>
                        <td scope="row"><a href="index2.php?acao=editar&idusuario=<?php echo $linha['idusuario'];?>"><img src="img/editar.png" style="width: 3vw;"></a> <br></td>
                        <td><?php echo " <a href=javascript:excluirRegistro('processa2.php?acao=excluir&idusuario={$linha['idusuario']}')>";?><img src="img/excluir.png" style="width: 3vw;"></a> <br></td>
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