<?php
require_once "conf/Conexao.php";
class Quadrado{
    private $idquadrado;
    private $lado;
    private $cor; 
    private $tabuleiro_idtabuleiro;
    private static $contador=0;
   public function __construct($idquadrado, $lado, $cor, $tabuleiro_idtabuleiro){ 
        $this->setidquadrado  ($idquadrado);
        $this->setLado  ($lado);
        $this->setCor ($cor);
        $this->settabuleiro_idtabuleiro ($tabuleiro_idtabuleiro);
        self::$contador=self::$contador + 1;
    }
    //construct

    public function getidquadrado(){ return $this->idquadrado; }
    public function setidquadrado($idquadrado){ $this->idquadrado = $idquadrado;}
    public function getLado() {return $this->lado;}
    public function getCor() {return $this->cor;}
    public function setLado($lado){if ($lado >  0)$this->lado = $lado;}
    public function setCor($cor){if (strlen($cor) > 0)$this->cor = $cor;}
    public function gettabuleiro_idtabuleiro() {return $this->tabuleiro_idtabuleiro;}
    public function settabuleiro_idtabuleiro($tabuleiro_idtabuleiro){if ($tabuleiro_idtabuleiro >  0)$this->tabuleiro_idtabuleiro = $tabuleiro_idtabuleiro;}
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
        return  "<br><br>[Quadrado]<br>Lado: ".$this->getLado()."<br>".
        "Cor: ".$this->getCor()."<br>".
        "Area: ".$this->Area()."<br>".
        "Perimetro: ".$this->Perimetro()."<br>".
        "Diagonal: ".$this->Diagonal()."<br>".
        "Contador: ".self::$contador."<br><br>";
    }
    //criação função toString

    public static function salvar($lado,$cor,$tabuleiro_idtabuleiro){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO trabalho.quadrado (idquadrado, lado, cor, tabuleiro_idtabuleiro) VALUES(null ,:lado, :cor, :tabuleiro_idtabuleiro)');
        $stmt->bindValue(':lado', $lado, PDO::PARAM_STR);
        $stmt->bindValue(':cor', $cor, PDO::PARAM_STR);
        $stmt->bindValue(':tabuleiro_idtabuleiro',$tabuleiro_idtabuleiro, PDO::PARAM_STR);
        return $stmt->execute();
    }
    //criação função salvar

    public static function excluir($idquadrado){
        $pdo = Conexao::getInstance();
        $stmt = $pdo ->prepare('DELETE FROM quadrado WHERE idquadrado = :idquadrado');
        $stmt->bindValue(':idquadrado', $idquadrado, PDO::PARAM_STR);        
    return $stmt->execute();
    }
    //criação função excluir

    public static function editar($idquadrado,$lado,$cor,$tabuleiro_idtabuleiro){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE trabalho.quadrado SET lado = :lado, cor = :cor, tabuleiro_idtabuleiro = :tabuleiro_idtabuleiro
        WHERE idquadrado = :idquadrado');

        $stmt->bindValue(':idquadrado', $idquadrado, PDO::PARAM_STR);
        $stmt->bindValue(':lado', $lado, PDO::PARAM_STR);
        $stmt->bindValue(':cor', $cor, PDO::PARAM_STR);
        $stmt->bindValue(':tabuleiro_idtabuleiro', $tabuleiro_idtabuleiro, PDO::PARAM_STR);
        return $stmt->execute(); 
    }
    //criação função editar

    public function listar($buscar = 0, $procurar = ""){
        $pdo = Conexao::getInstance();
        $sql = "SELECT * FROM quadrado";
        if ($buscar > 0)
            switch($buscar){
                case(1): $sql .= " WHERE idquadrado = :procurar"; break;
                case(2): $sql .= " WHERE lado like :procurar"; break;
                case(3): $sql .= " WHERE cor like :procurar"; break;
    }
    $stmt = $pdo->prepare($sql);
        if ($buscar > 0)
            $stmt->bindValue(':procurar', $procurar, PDO::PARAM_STR);
            $stmt->execute();
        return $stmt->fetchAll();
    } 
    //criação função listar e prepare
    
    public function desenhar(){
        $str = "<div style='width: ".$this->getLado()."px; height: ".$this->getLado()."px; background: ".$this->getCor()."'></div>";
        return $str;
    }
    //criação função desenhar

}
        
?>