<!DOCTYPE html>
<?php
    include_once "../classe/autoload.php";
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    require_once "../classe/ClassUsuario.php";
    $id = null;
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $usu = new Usuario('','','','');
        $lista = $usu->select('*', "id = $id");
    }

    $nome = isset($_POST['nome']) ? $_POST['nome'] : "";
    $login = isset($_POST['login']) ? $_POST['login'] : "";
    $senha = isset($_POST['senha']) ? $_POST['senha'] : "";
    $buscar = isset($_POST["buscar"]) ? $_POST["buscar"] : 0;
    $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : "";
    $table = "usuario";

    if(isset($_POST['acao'])) {
        $acao = $_POST['acao'];
    } else if(isset($_GET['acao'])) {
        $acao = $_GET['acao'];
    } else {
        $acao = "";
    }

    if($acao == "insert") {
        try{
            $usu = new Usuario("", $nome, $login, $senha);
            $usu->inseri();
            header("location:cad5.php");
        } catch(Exception $e) {
            echo "<h1>Erro ao cadastrar as informações.</h1><br> Erro:".$e->getMessage();
        }
    } else if($acao == "editar") {
        try{
            $usu = new Usuario($id, $nome, $login, $senha);
            $usu->edita();
            header("location:cad5.php");
        } catch(Exception $e) {
            echo "<h1>Erro ao editar as informações.</h1><br> Erro:".$e->getMessage();
        }
    } else if($acao == "excluir") {
        try{
            $usu = new Usuario($id, "", "", "");
            $usu->exclui();
            header("location:cad5.php");
        } catch(Exception $e) {
            echo "<h1>Erro ao excluir as informações.</h1><br> Erro:".$e->getMessage();
        }
    } 
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" style="padding-left: 0.7px;">
</head>
<body style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
    <header>
        <?php include_once "../menu.php"; ?>
    </header>
    <content>
    <form action="<?php if(isset($_GET['id'])) { echo "cad5.php?id=$id&acao=editar";} else {echo "cad5.php?acao=insert";}?>" method="post" id="form" >
        <h1>Cadastrar Usuário:</h1><br>
        <div>
        <input readonly type="hidden" name="id" id="id" value="<?php if (isset($id)) echo $lista[2]['id'];?>">
        <div class="col-auto">
            <div class="input-group">    
                <div class="btn btn-dark">Nome:</div>
                <input required type="text" name="nome" id="nome" value="<?php if (isset($id)) echo $lista[0]['nome'];?>" class="form-control-sm btn btn-dark" aria-describedby="emailHelp">
            </div>
        </div><br>
        <div class="col-auto">        
            <div class="input-group">    
                <div class="btn btn-dark">Login:</div>
                <input required type="text" name="login" id="login" value="<?php if (isset($id)) echo $lista[0]['login'];?>" class="form-control-sm btn btn-dark" aria-describedby="emailHelp">
            </div>
        </div><br>
        <div class="col-auto">        
            <div class="input-group">    
                <div class="btn btn-dark">Senha:</div>
                <input required type="<?php if (isset($id)){echo "text";}else{echo "password";};?>" name="senha" id="senha" value="<?php if (isset($id)) echo $lista[0]['senha'];?>" class="form-control-sm btn btn-dark" id="exampleInputPassword1">
            </div>
        </div><br>
        <button name="" value="true" id="" type="submit" class="btn btn-dark">Salvar</button>
</div>
    </form><br>
    <div class="card text-bg-dark mb-3"></div>
    <form method="post" >
        <h1>Pesquisar Por:</h1>
        <div class="form-check">
            <input class="form-check-input mt-0" style="background-color: #2e2e2e;" type="radio" name="buscar" value="1" <?php if ($buscar == "1") echo "checked"?> class="form-check-input">
            <label class="form-check-label" for="flexRadioDefault1">ID</label><br>
            <input class="form-check-input mt-0" style="background-color: #2e2e2e;" type="radio" name="buscar" value="2" <?php if ($buscar == "2") echo "checked"?> class="form-check-input">
            <label class="form-check-label" for="flexRadioDefault1">Nome</label><br>
        </div>
        <div class="col-auto">        
            <div class="input-group">    
                <div class="input-group-text border btn btn-dark">Procurar:</div>
                <input type="text" name="procurar" id="procurar" size="25" value="<?php echo $procurar;?>" class="form-control-sm border btn btn-dark">
            </div><br>
        </div>
        <button name="acao" id="acao" type="submit" class="btn btn-dark">Procurar</button>
        <br><br>
    </form>
        <div>
            <table border='1' class="table table-dark table-striped">
                <thead>
                    <tr class="table-dark">
                        <th scope="col" >#ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Detalhes</th>
                        <th scope="col">Alterar</th>
                        <th scope="col">Deletar</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $usu = new Usuario("","","","");
                    $lista = $usu->listar($buscar, $procurar);
                    foreach ($lista as $linha) { 
                ?>
                    <tr>
                        <th scope="row"><?php echo $linha['id'];?></th>
                        <th scope="row"><?php echo $linha['nome'];?></th>
                        <td scope="row"><a href="../mostrar/mostrar5.php?id=<?php echo $linha['id'];?>&nome=<?php echo $linha['nome'];?>&login=<?php echo $linha['login'];?>&senha=<?php echo $linha['senha'];?>"><img src="../img/ver.png" style="width:30px; "></a></td>
                        <td scope="row"><a href="cad5.php?id=<?php echo $linha['id'];?>"><img src="../img/editar.png" style="width:30px; "></a></td>
                        <td scope="row"><a onclick="return confirm('Deseja mesmo excluir?')" href="cad5.php?id=<?php echo $linha['id'];?>&acao=excluir"><img src="../img/excluir.png" style="width:30px; "></a></td>
                    </tr>
                <?php } ?> 
                </tbody>
            </table>
        </div>
    </content>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>