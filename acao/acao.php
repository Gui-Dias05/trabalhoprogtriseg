<?php  
include_once "../conf/default.inc.php";
require_once "../conf/Conexao.php";
require_once("../classe/ClassQuadrado.php");

if(isset($_POST['acao'])) {
    $acao = $_POST['acao'];
} else if(isset($_GET['acao'])) {
    $acao = $_GET['acao'];
} else {
    $acao = "";
}

if($acao == "insert") {
    try{
        $quad = new Quadrado("", $lado, $cor, $idtabuleiro);
        $quad->inseri();
        header("location:cad.php");
    } catch(Exception $e) {
        echo "<h1>Erro ao cadastrar as informações.</h1><br> Erro:".$e->getMessage();
    }
} else if($acao == "editar") {
    try{
        $quad = new Quadrado($id, $lado, $cor, $idtabuleiro);
        $quad->edita();
        header("location:cad.php");
    } catch(Exception $e) {
        echo "<h1>Erro ao editar as informações.</h1><br> Erro:".$e->getMessage();
    }
} else if($acao == "excluir") {
    try{
        $quad = new Quadrado($id, "", "", "");
        $quad->exclui();
        header("location:cad.php");
    } catch(Exception $e) {
        echo "<h1>Erro ao excluir as informações.</h1><br> Erro:".$e->getMessage();
    }
} 
?>