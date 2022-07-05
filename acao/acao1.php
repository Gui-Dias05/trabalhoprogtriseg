<?php  
include_once "../conf/default.inc.php";
require_once "../conf/Conexao.php";
require_once("../classe/ClassRetangulo.php");

$acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $tri = new Retangulo($id, $_POST['altura'], $_POST['base'], $_POST['cor'], $_POST['tabuleiro_idtabuleiro']);     
        $tri->exclui();
        header("location:cad1.php");
    }

$acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $id = isset($_POST['id']) ? $_POST['id'] : "";

        try{
        if ($id == 0){
            $tri = new Retangulo("", $_POST['altura'], $_POST['base'], $_POST['cor'], $_POST['tabuleiro_idtabuleiro']);
            $tri->inseri();
            header("location:cad1.php");
        }else {
            $tri = new Retangulo($_POST['id'], $_POST['altura'], $_POST['base'], $_POST['cor'], $_POST['tabuleiro_idtabuleiro']);
            $tri->edita();
        }    
        header("location:cad1.php");    
    }catch(Exception $e){
        echo "<h1>Erro ao cadastrar o Triângulo.<h1>
        <br> Erro: <br>".$e->getMessage();
    }     
}

function buscarDados($id){
    $pdo = Conexao::getInstance();
    $consulta = $pdo->query("SELECT * FROM retangulo WHERE id = $id");
    $dados = array();
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        $dados['id'] = $linha['id'];
        $dados['altura'] = $linha['altura'];
        $dados['base'] = $linha['base'];
        $dados['cor'] = $linha['cor'];
        $dados['tabuleiro_idtabuleiro'] = $linha['tabuleiro_idtabuleiro'];
    }
    return $dados;
}
?>