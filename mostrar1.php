<?php   
   require_once "classe/ClassTabuleiro.php";
   $title = "Recuperação";
   $lado = isset($_GET["lado"]) ? $_GET["lado"] : 10;
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
        <?php include_once "menu.php"; ?>
    <meta charset="UTF-8">
        <title> <?php echo $title; ?> </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"></head>
    <body class="">

    <?php
            $tab = new tabuleiro("", $lado);
            echo $tab;
            echo $tab->desenhar();
    ?>
    <!-- Mostrar Quadrado -->
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    
    <style>
    body{
        background-color: #d3d3d3;
    }
    </style>
    <!--Parte do estilo-->
    
    </body>
</html>