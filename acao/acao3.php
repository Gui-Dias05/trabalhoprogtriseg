<?php  
include_once "../conf/default.inc.php";
require_once "../conf/Conexao.php";
require_once("../classe/ClassTabuleiro.php");

$acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $idTabuleiro = isset($_GET['idTabuleiro']) ? $_GET['idTabuleiro'] : 0;
        
        $tab = Tabuleiro::exclui($idTabuleiro);
        header("location:cad3.php");
    }

$acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $idTabuleiro = isset($_POST['idTabuleiro']) ? $_POST['idTabuleiro'] : "";

        try{
        if ($idTabuleiro == 0){
            $tab = Tabuleiro::inseri($_POST['lado']);  
            header("location:cad3.php");
        }else {
            $tab = Tabuleiro::edita($_POST['idTabuleiro'], $_POST['lado']);
        }    
        header("location:cad3.php");    
    }catch(Exception $e){
        echo "<h1>Erro ao cadastrar o Tabuleiro.<h1>
        <br> Erro: <br>".$e->getMessage();
    }     
}

function buscarDados($idTabuleiro){
    $pdo = Conexao::getInstance();
    $consulta = $pdo->query("SELECT * FROM tabuleiro WHERE idTabuleiro = $idTabuleiro");
    $dados = array();
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        $dados['idTabuleiro'] = $linha['idTabuleiro'];
        $dados['lado'] = $linha['lado'];
    }
    return $dados;
}
?>