<?php   
   require_once "classe/ClassQuadrado.php";
   $title = "Recuperação";
   $lado = isset($_GET["lado"]) ? $_GET["lado"] : 10;
   $cor = isset($_GET["cor"]) ? $_GET["cor"] : "Verde";
   $idquadrado = isset($_GET["idquadrado"]) ? $_GET["idquadrado"] : 0;
   $idtabuleiro = isset($_GET["idtabuleiro"]) ? $_GET["idtabuleiro"] : 0;
   
?>
<html>
<head>
    <style>
        /*div{
            background: <?php echo $cor;?>;
            width: <?php echo $lado;?>px;
            height: <?php echo $lado;?>px;
            border: 1px solid; 
        }*/
    </style>
    <?php include_once "menu.php"; ?>
    <meta charset="UTF-8">
        <title> <?php echo $title; ?> </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
    <body style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
<center>
<?php
    
    $quad= new Quadrado($idquadrado, $lado, $cor, $idtabuleiro);
    echo $quad;
    echo $quad->desenhar();

    $quad= new Quadrado(4, 65, "#000000", 2);
    echo $quad;
    echo $quad->desenhar();

    $quad= new Quadrado(6, 200, "#ff0000", 3);
    echo $quad;
    echo $quad->desenhar();

    $quad= new Quadrado(7, 400, "yellow", 3);
    echo $quad;
    echo $quad->desenhar();
    ?> 
    <center>
    <!-- Mostrar Quadrado  -->
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    
        <style>
        body{
            background-color: #d3d3d3;
        }
        </style>
        <!--Parte do estilo-->

    </body>
</html>