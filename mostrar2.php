<?php   
   include_once "menu.php";
   require_once "classe/ClassTriangulo.php";
   $title = "Recuperação";
   $lado1 = isset($_GET["lado1"]) ? $_GET["lado1"] : 28;
   $lado2 = isset($_GET["lado2"]) ? $_GET["lado2"] : 45;
   $lado3 = isset($_GET["lado3"]) ? $_GET["lado3"] : 80;
   $id = isset($_GET["id"]) ? $_GET["id"] : 2;
   $cor = isset($_GET["cor"]) ? $_GET["cor"] : "blue";
   $tabuleiro_idtabuleiro = isset($_GET["tabuleiro_idtabuleiro"]) ? $_GET["tabuleiro_idtabuleiro"] : 1;

?>
<html>
<head>
    <style>
        .tab{
            background: white;
            width: <?php echo $lado;?>px;
            height: <?php echo $lado;?>px;
            border: 1px solid;
        }
    </style>
    <meta charset="UTF-8">
        <title> <?php echo $title; ?> </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"></head>
    <body class="">
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    
    <?php
    
    $tri= new Triangulo($id, $cor, $tabuleiro_idtabuleiro, $lado1, $lado2, $lado3);
    echo $tri;
    echo $tri->desenhar();
        ?>

    <style>
    body{
        background-color: #d3d3d3;
    }
    </style>
    <!--Parte do estilo-->
    
    </body>
</html>