<?php  
include_once "../conf/default.inc.php";
require_once "../conf/Conexao.php";
require_once("../classe/ClassCirculo.php");

$acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $quad = new Circulo($id, $_POST['raio'], $_POST['cor'], $_POST['tabuleiro_idtabuleiro']);     
        $quad->exclui();
        header("location:cad4.php");
    }

$acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $id = isset($_POST['id']) ? $_POST['id'] : "";

        try{
        if ($id == 0){
            $quad = new Circulo("", $_POST['raio'], $_POST['cor'], $_POST['tabuleiro_idtabuleiro']);     
            $quad->inseri();
            header("location:cad4.php");
        }else {
            $quad = new Circulo($_POST['id'], $_POST['raio'], $_POST['cor'], $_POST['tabuleiro_idtabuleiro']);
            $quad->edita();
        }    
        header("location:cad4.php");    
    }catch(Exception $e){
        echo "<h1>Erro ao cadastrar o Círculo.<h1>
        <br> Erro: <br>".$e->getMessage();
    }     
}

function buscarDados($id){
    $pdo = Conexao::getInstance();
    $consulta = $pdo->query("SELECT * FROM circulo WHERE id = $id");
    $dados = array();
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        $dados['id'] = $linha['id'];
        $dados['raio'] = $linha['raio'];
        $dados['cor'] = $linha['cor'];
        $dados['tabuleiro_idtabuleiro'] = $linha['tabuleiro_idtabuleiro'];
    }
    return $dados;
}
?>