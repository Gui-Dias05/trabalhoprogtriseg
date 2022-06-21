<?php
require_once "conf/Conexao.php";
class tabuleiro{
    private $idtabuleiro;
    private $lado;
    public function __construct($idtabuleiro, $lado){ 
        $this->setidtabuleiro  ($idtabuleiro);
        $this->setLado  ($lado);
    }
    //construct

    public function getidtabuleiro(){ return $this->idtabuleiro; }
    public function setidtabuleiro($idtabuleiro){ $this->idtabuleiro = $idtabuleiro;}
    public function getLado() {return $this->lado;}
    public function setLado($lado){if ($lado >  0)$this->lado = $lado;}
    //get e set

    public function Area(){
        $area = $this->lado * $this->lado;
        return $area;
    }
    //criação função área

    public function Perimetro(){
        $perimetro = $this->lado + $this->lado+ $this->lado + $this->lado;
        return $perimetro;
    }
    //criação função perímetro

    public function Diagonal(){
        $diagonal = $this->lado * 1.44;
        return $diagonal;
    }
    //criação função diagonal

    public function __toString(){
        return  "[tabuleiro]<br>Lado: ".$this->getLado()."<br>".
        "Area: ".$this->Area()."<br>".
        "Perimetro: ".$this->Perimetro()."<br>".
        "Diagonal: ".$this->Diagonal()."<br>";
    }
    //criação função toString

    public function salvar(){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO tabuleiro (lado) VALUES(:lado)');
        $stmt->bindValue(':lado', $this->getLado());
        return $stmt->execute();
    }

    public function excluir($idtabuleiro){
        $pdo = Conexao::getInstance();
        $stmt = $pdo ->prepare('DELETE FROM tabuleiro WHERE idtabuleiro = :idtabuleiro');
        $stmt->bindValue(':idtabuleiro', $idtabuleiro);           
        return $stmt->execute();
    }
    //criação função excluir

    public function editar(){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE tabuleiro SET lado = :lado
        WHERE idtabuleiro = :idtabuleiro');
    
        $stmt->bindValue(':idtabuleiro', $this->getidtabuleiro());
        $stmt->bindValue(':lado', $this->getLado());
        return $stmt->execute();
    }
    //criação função editar

    public function listar($buscar = 0, $procurar = ""){
        $pdo = Conexao::getInstance();
        $sql = "SELECT * FROM tabuleiro";
        if ($buscar > 0)
            switch($buscar){
                case(1): $sql .= " WHERE idtabuleiro = :procurar"; break;
                case(2): $sql .= " WHERE lado like :procurar"; break;
            }
        $stmt = $pdo->prepare($sql);
        if ($buscar > 0)
            $stmt->bindValue(':procurar', $procurar, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    //criação função listar e prepare

    public function desenhar(){
        $str = "<div style='width: ".$this->getLado()."px; height: ".$this->getLado()."px; border: 3px solid;'></div>";
        return $str;
    }
    //criação função desenhar

    public function buscar($id){
        require_once("conf/Conexao.php");

        $conexao = Conexao::getInstance();

        $query = 'SELECT * FROM tabuleiro';
        if($idtabuleiro > 0){
            $query .= ' WHERE idtabuleiro = :Idtabuleiro';
            $stmt->bindParam(':Idtabuleiro', $idtabuleiro);
        }
            $stmt = $conexao->prepare($query);
            if($stmt->execute())
                return $stmt->fetchAll();
    
            return false;
    }

}
        
?>