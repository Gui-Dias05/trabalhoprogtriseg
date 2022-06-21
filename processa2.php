<?php  
include_once "conf/default.inc.php";
require_once "conf/Conexao.php";
require_once("classe/ClassUsuario.php");

$acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $idusuario = isset($_GET['idusuario']) ? $_GET['idusuario'] : 0;
        
        $user = new Usuario("", "", "", "");
        $resultado = $user->excluir($idusuario);
        header("location:listar2.php");
    }

$acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $idusuario = isset($_POST['idusuario']) ? $_POST['idusuario'] : "";

        try{
        if ($idusuario == 0){
            $user = new Usuario("", $_POST['nome'], $_POST['user'], $_POST['senha']);      
            $resultado = $user->salvar();
            header("location:listar2.php");
        }else {
            $user = new Usuario($_POST['idusuario'], $_POST['nome'], $_POST['user'], $_POST['senha']);
            $resultado = $user->editar();
        }    
        header("location:listar2.php");    
    }catch(Exception $e){
        echo "<h1>Erro ao cadastrar o Usuario.<h1>
        <br> Erro: <br>".$e->getMessage();
    }     
}

function buscarDados($idusuario){
    $pdo = Conexao::getInstance();
    $consulta = $pdo->query("SELECT * FROM usuario WHERE idusuario = $idusuario");
    $dados = array();
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        $dados['idusuario'] = $linha['idusuario'];
        $dados['nome'] = $linha['nome'];
        $dados['user'] = $linha['user'];
        $dados['senha'] = $linha['senha'];
    }
    return $dados;
}
?>