<?php
require_once "classe/ClassTabuleiro.php";

function exibir($chave, $dados){
    $str = 0;
    foreach($dados as $linha){
        $str .= "<option value='".$linha[$chave[0]]."'>".$linha[$chave[1]]."</option>";
    }
    return $str;
}

function lista_tabuleiro($idtabuleiro){
    $tab = new tabuleiro("","");
    $lista = $tab->buscar($idtabuleiro);
    return exibir(array('idtabuleiro', 'idtabuleiro'), $lista);
}
?>