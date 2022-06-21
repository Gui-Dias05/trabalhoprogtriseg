<?php
    //include_once 'conf/Conexao.php';
    //require_once 'conf/conf.inc.php';
    class Forma{
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

        public static function inserir($cor, $tabuleiro_idtabuleiro){
            $pdo = Conexao::getInstance();
                $stmt = $pdo->prepare('INSERT INTO recuperacao.quadrado (cor, tabuleiro_idtabuleiro) VALUES (:cor, :tabuleiro_idtabuleiro)');
                $stmt->bindParam(':cor', $cor, PDO::PARAM_STR);
                $stmt->bindParam(':tabuleiro_idtabuleiro', $tabuleiro_idtabuleiro, PDO::PARAM_INT);
                return $stmt->execute();
        }

        public static function excluir($id){
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('DELETE FROM quadrado WHERE id = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        }

        public static function editar($id, $cor, $tabuleiro_idtabuleiro){
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('UPDATE quadrado SET cor = :cor, tabuleiro_idtabuleiro = :tabuleiro_idtabuleiro WHERE id = :id');
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':cor', $cor, PDO::PARAM_STR);
            $stmt->bindValue(':tabuleiro_idtabuleiro', $tabuleiro_idtabuleiro, PDO::PARAM_INT);
            return $stmt->execute();
        }
    }
?>