<!DOCTYPE html>
<?php
    include_once "../classe/autoload.php";
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    require_once "../classe/ClassTriangulo.php";
    $id = null;
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $ret = new Triangulo('','','','','','');
        $lista = $ret->select('*', "id = $id");
    }

    $lado1 = isset($_POST['lado1']) ? $_POST['lado1'] : 0;
    $lado2 = isset($_POST['lado2']) ? $_POST['lado2'] : 0;
    $lado3 = isset($_POST['lado3']) ? $_POST['lado3'] : 0;
    $cor = isset($_POST['cor']) ? $_POST['cor'] : 0;
    $tabuleiro_idtabuleiro = isset($_POST['tabuleiro_idtabuleiro']) ? $_POST['tabuleiro_idtabuleiro'] : 0;
    $buscar = isset($_POST["buscar"]) ? $_POST["buscar"] : 0;
    $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : "";
    $table = "triangulo";

    if(isset($_POST['acao'])) {
        $acao = $_POST['acao'];
    } else if(isset($_GET['acao'])) {
        $acao = $_GET['acao'];
    } else {
        $acao = "";
    }

    if($acao == "insert") {
        try{
            $tri = new Triangulo("", $cor, $tabuleiro_idtabuleiro, $lado1, $lado2, $lado3);
            $tri->inseri();
            header("location:cad2.php");
        } catch(Exception $e) {
            echo "<h1>Erro ao cadastrar as informações.</h1><br> Erro:".$e->getMessage();
        }
    } else if($acao == "editar") {
        try{
            $tri = new Triangulo($id, $cor, $tabuleiro_idtabuleiro, $lado1, $lado2, $lado3);
            $tri->edita();
            header("location:cad2.php");
        } catch(Exception $e) {
            echo "<h1>Erro ao editar as informações.</h1><br> Erro:".$e->getMessage();
        }
    } else if($acao == "excluir") {
        try{
            $tri = new Triangulo($id, "", "", "", "", "");
            $tri->exclui();
            header("location:cad2.php");
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
    <title>Triângulo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
    <header>
        <?php include_once "../menu.php"; ?>
    </header>
    <content>
    <form action="<?php if(isset($_GET['id'])) { echo "cad2.php?id=$id&acao=editar";} else {echo "cad2.php?acao=insert";}?>" method="post" id="form" >
        <h1>Criar um Triângulo:</h1><br>
        <div> 
        <input readonly type="hidden" name="id" id="id" value="<?php if (isset($id)) echo $lista[0]['id'];?>">
        <div class="col-auto">
            <div class="input-group">    
                <div class="btn btn-dark">Lado 1:</div>
                <input required type="text" name="lado1" id="lado1" value="<?php if (isset($id)) echo $lista[0]['lado1'];?>" class="btn btn-dark">
            </div>
        </div><br>
        <div class="col-auto">
            <div class="input-group">    
                <div class="btn btn-dark">Lado 2:</div>
                <input required type="text" name="lado2" id="lado2" value="<?php if (isset($id)) echo $lista[0]['lado2'];?>" class="btn btn-dark">
        </div><br>
        <div class="col-auto">
            <div class="input-group">    
                <div class="btn btn-dark">Lado 3:</div>
                <input required type="text" name="lado3" id="lado3" value="<?php if (isset($id)) echo $lista[0]['lado3'];?>" class="btn btn-dark">
        </div><br>
        <div class="col-auto">
            <div class="input-group">    
                <div class="btn btn-dark">Cor:</div>
                <input required type="color" name="cor" id="cor" value="<?php if (isset($id)) echo $lista[0]['cor'];?>" class="form-control-color btn btn-dark">
        </div><br>
        <div class="col-auto">
            <div class="input-group">    
                <div class="btn btn-dark">Tabuleiro:</div>
                <select name="tabuleiro_idtabuleiro" id="tabuleiro_idtabuleiro" value="" class="form-select-sm btn btn-dark" aria-label="Floating label select example">
                <?php
                    $pdo = Conexao::getInstance();
                    $consulta = $pdo->query("SELECT * FROM tabuleiro;");
                    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <option name="" value="<?php echo $linha['idtabuleiro'];?>"><?php echo $linha['idtabuleiro'];?></option>
                <?php } ?>
                </select>
            </div>
            </div>
        </div><br>
        <button name="" value="true" id="" type="submit" class="btn btn-dark">Salvar</button>
        </div>
        </div>
        </div>
        
    </form><br><br>
    <div class="card text-bg-dark mb-3"></div>
    <form method="post" >
        <h1>Pesquisar Por:</h1>
        <div class="form-check">
            <input class="form-check-input mt-0" style="background-color: #2e2e2e;" type="radio" name="buscar" value="1" <?php if ($buscar == "1") echo "checked" ?> class="form-check-input">
            <label class="form-check-label" for="flexRadioDefault1">ID</label><br>
            <input class="form-check-input mt-0" style="background-color: #2e2e2e;" type="radio" name="buscar" value="2" <?php if ($buscar == "2") echo "checked" ?> class="form-check-input">
            <label class="form-check-label" for="flexRadioDefault1">Lado 1</label><br>
            <input class="form-check-input mt-0" style="background-color: #2e2e2e;" type="radio" name="buscar" value="3" <?php if ($buscar == "3") echo "checked" ?> class="form-check-input">
            <label class="form-check-label" for="flexRadioDefault1">Lado 2</label><br>
            <input class="form-check-input mt-0" style="background-color: #2e2e2e;" type="radio" name="buscar" value="4" <?php if ($buscar == "4") echo "checked" ?> class="form-check-input">
            <label class="form-check-label" for="flexRadioDefault1">Lado 3</label><br>
            <input class="form-check-input mt-0" style="background-color: #2e2e2e;" type="radio" name="buscar" value="5" <?php if ($buscar == "5") echo "checked" ?> class="form-check-input">
            <label class="form-check-label" for="flexRadioDefault1">Cor</label><br>
            <input class="form-check-input mt-0" style="background-color: #2e2e2e;" type="radio" name="buscar" value="6" <?php if ($buscar == "6") echo "checked" ?> class="form-check-input">
            <label class="form-check-label" for="flexRadioDefault1">Tabuleiro</label><br>
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
                        <th scope="col">#ID</th>
                        <th scope="col">Lado 1</th>
                        <th scope="col">Lado 2</th>
                        <th scope="col">Lado 3</th>
                        <th scope="col">Cor</th>
                        <th scope="col">Tabuleiro</th>
                        <th scope="col">Mostrar</th>
                        <th scope="col">Alterar</th>
                        <th scope="col">Deletar</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $tri = new Triangulo("","","","","","");
                    $lista = $tri->listar($buscar, $procurar);
                    foreach ($lista as $linha) { 
                ?>
                    <tr>
                        <th scope="row"><?php echo $linha['id'];?></th>
                        <th scope="row"><?php echo $linha['lado1'];?></th>
                        <th scope="row"><?php echo $linha['lado2'];?></th>
                        <th scope="row"><?php echo $linha['lado3'];?></th>
                        <th scope="row"><?php echo "<div style='width: 0px; height: 0px; border-left: 1.5em solid transparent; border-right: 1.5em solid transparent; border-bottom: 1.5em solid ".$linha['cor'].";'></div>";?></th>
                        <th scope="row"><?php echo $linha['tabuleiro_idtabuleiro'];?></th>
                        <td scope="row"><a href="../mostrar/mostrar2.php?id=<?php echo $linha['id']; ?>&lado1=<?php echo $linha['lado1'];?>&lado2=<?php echo $linha['lado2'];?>&lado3=<?php echo $linha['lado3'];?>&cor=<?php echo str_replace('#', '%23', $linha['cor']);?>&idtabuleiro=<?php echo $linha['tabuleiro_idtabuleiro'];?>"><img src="../img/ver.png" style="width:30px; "></a></td>
                        <td scope="row"><a href="cad2.php?id=<?php echo $linha['id'];?>&idtabuleiro=<?php echo $linha['tabuleiro_idtabuleiro'];?>"><img src="../img/editar.png" style="width:30px; "></a></td>
                        <td><a onclick="return confirm('Deseja mesmo excluir?')" href="cad2.php?id=<?php echo $linha['id'];?>&acao=excluir"><img src="../img/excluir.png" style="width:30px; "></a></td>
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