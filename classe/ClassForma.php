<?php
    //include_once 'conf/Conexao.php';
    //require_once 'conf/conf.inc.php';
    require_once "../classe/ClassDatabase.php";
    abstract class Forma extends Database{
        private $id;
        private $cor;
        private $tabuleiro_idtabuleiro;
        private static $contador = 0;

        public function __construct($id, $cor, $tabuleiro_idtabuleiro) {
            $this->setid($id);
            $this->setcor($cor);
            $this->settabuleiro($tabuleiro_idtabuleiro);
            self::$contador = self::$contador + 1;
        }

        public function getid(){ 
            return $this->id; 
        }

        public function setid($id){ 
            $this->id = $id;
        }      

        public function getcor() {
            return $this->cor;
        }

        public function setcor($cor) {
            if (strlen($cor) > 0)    
                $this->cor = $cor;
        }

        public function gettabuleiro() {
            return $this->tabuleiro_idtabuleiro;
        }

        public function settabuleiro($tabuleiro_idtabuleiro) {
            if ($tabuleiro_idtabuleiro >  0)
                $this->tabuleiro_idtabuleiro = $tabuleiro_idtabuleiro;
        }

        public function __toString() {
            return  "[Forma]<br>id: ".$this->getid()."<br>".
                    "Cor: ".$this->getcor()."<br>".
                    "Id do Tabuleiro: ".$this->gettabuleiro()."<br>".
                    "Contador: ".self::$contador."<br>";
        }
        
        public abstract function desenha();
        public abstract function Area();
        public abstract function inseri();
        public abstract function edita();
        public abstract function exclui();
        public abstract static function listar($tipo = 0, $info = "");
    }
?>