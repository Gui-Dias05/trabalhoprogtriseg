<?php   
 include_once "conf/default.inc.php";
 require_once "conf/Conexao.php";
 require_once "classe/ClassTabuleiro.php";

 $acao = "";
 if(isset($_POST['acao'])){$acao = $_POST['acao'];}else if(isset($_GET['acao'])){$acao = $_GET['acao'];}   

   $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
   if ($acao == "excluir"){
       $idtabuleiro = isset($_GET['idtabuleiro']) ? $_GET['idtabuleiro'] : 0;
       $tab = new tabuleiro("", "");
       $resultado = $tab->excluir($idtabuleiro);
       header("location:listar1.php");
   }
   $acao = isset($_POST['acao']) ? $_POST['acao'] : "";

    if ($acao == "salvar"){
        $idtabuleiro = isset($_POST['idtabuleiro']) ? $_POST['idtabuleiro'] : "";
        if ($idtabuleiro == 0){
            $tab = new tabuleiro("", $_POST['lado']);      
            $resultado = $tab->salvar();
            header("location:index1.php");
        }else {
            $tab = new tabuleiro($_POST['idtabuleiro'], $_POST['lado']);
            $resultado = $tab->editar();
        }    
        header("location:listar1.php");    
    }     
    
    function buscarDados($idtabuleiro){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM tabuleiro WHERE idtabuleiro = $idtabuleiro");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['idtabuleiro'] = $linha['idtabuleiro'];
            $dados['lado'] = $linha['lado']; 
        }
        return $dados;
    }
?>
