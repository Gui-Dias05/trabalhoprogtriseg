<?php
class Retangulo extends Forma{
    private $altura;
    private $base;
    public function __construct($id, $cor, $tabuleiro_idtabuleiro,$altura, $base){ 
        parent::__construct($id);
        $this->setAltura($altura);
        $this->setBase($base);
    }
    public function getaltura(){ return $this->altura; }
    public function setaltura($altura){ $this->altura = $altura;}
    public function getbase() {return $this->base;}
    public function setbase($base){if (strlen($base) > 0)$this->base = $base;}
    
    public function __toString(){
        $str= parent::__toString();
        $str.= "Tamanho da altura" .$this->getAltura().
        "<br> Tamanho da base".$this->getBase();
        return $str;
    }
    


}
        
?>