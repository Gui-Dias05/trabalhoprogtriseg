<?php
    include_once '../conf/Conexao.php';
    require_once '../conf/conf.inc.php';
    require_once '../classe/ClassForma.php';
    class Retangulo extends Forma{
        private $altura;
        private $base;
        private static $contador;

        public function __construct($id, $altura, $base, $cor, $tabuleiro_idtabuleiro) {
            parent::__construct($id, $cor, $tabuleiro_idtabuleiro);
            $this->setaltura($altura);
            $this->setbase($base);
            self::$contador = self::$contador + 1;
        }

        public function getaltura(){ 
            return $this->altura; 
        }

        public function setaltura($altura){ 
            $this->altura = $altura;
        }      

        public function getbase() {
            return $this->base;
        }

        public function setbase($base) {
                $this->base = $base;
        }

        public function Area() {
            $area = $this->base * $this->altura;
            return $area;
        }

        public function Perimetro() {
            $perimetro = ($this->base * 2) + ($this->altura * 2);
            return $perimetro;
        }

        public function Diagonal() {
            $diagonal = sqrt(pow($this->base, 2) + pow($this->altura, 2));
            return $diagonal;
        }

        public function __toString() {
            return  "[Retângulo]<br>Id do Retangulo: ".$this->getId()."<br>".
                    "Altura: ".$this->getaltura()."<br>".
                    "Base: ".$this->getbase()."<br>".
                    "Cor: ".$this->getcor()."<br>".
                    "Área: ".round($this->Area(),2)."<br>".
                    "Perímetro: ".round($this->Perimetro(),2)."<br>".
                    "Diagonal: ".round($this->Diagonal(),2)."<br>".
                    "Id do Tabuleiro: ".$this->gettabuleiro()."<br>".
                    "Contador: ".self::$contador."<br>";
        }

        public function inseri(){
            $sql = 'INSERT INTO trabalho.retangulo (altura, base, cor, tabuleiro_idtabuleiro) 
            VALUES(:altura, :base, :cor, :tabuleiro_idtabuleiro)';
            $parametros = array(":altura"=>$this->getaltura(), 
                                ":base"=>$this->getbase(), 
                                ":cor"=>$this->getCor(),
                                ":tabuleiro_idtabuleiro"=>$this->getTabuleiro());
            return parent::executaComando($sql,$parametros);
        }

        public function exclui(){
            $sql = 'DELETE FROM trabalho.retangulo WHERE id = :id';
            $parametros = array(":id"=>$this->getId());
            return parent::executaComando($sql,$parametros);
        }

        public function edita(){
            $sql = 'UPDATE trabalho.retangulo 
            SET altura = :altura, base = :base, cor = :cor, tabuleiro_idtabuleiro = :tabuleiro_idtabuleiro
            WHERE id = :id';
            $parametros = array(":altura"=>$this->getaltura(),
                                ":base"=>$this->getbase(),
                                ":cor"=>$this->getCor(),
                                ":tabuleiro_idtabuleiro"=>$this->getTabuleiro(),
                                ":id"=>$this->getId());
            return parent::executaComando($sql,$parametros);
        }

        public static function buscar($buscar = 0, $procurar = ""){
            $sql = "SELECT * FROM retangulo";
            if ($buscar > 0)
                switch($buscar){
                    case(1): $sql .= " WHERE id like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(2): $sql .= " WHERE altura like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(3): $sql .= " WHERE base like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(4): $sql .= " WHERE cor like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(5): $sql .= " WHERE tabuleiro_tabuleiro_idtabuleiro like :procurar"; $procurar = "%".$procurar."%"; break;
                }
            if ($buscar > 0)
                $parametros = array(':procurar'=>$procurar);
            else 
                $parametros = array();
            return parent::buscar($sql, $parametros);
        }

        public function desenha(){
            $str = "<div style='width: ".$this->getaltura()."vh; height: ".$this->getbase()."vh; background: ".$this->getcor().";border: 5px solid;'></div><br>";
            return $str;
        }

        public static function select($rows="*", $where = null, $search = null, $order = null, $group = null) {
            $pdo = Conexao::getInstance();
            $sql= "SELECT $rows FROM retangulo";
            if($where != null) {
                $sql .= " WHERE $where";
                if($search != null) {
                    if(is_numeric($search) == false) {
                        $sql .= " LIKE '%". trim($search) ."%'";
                    } else if(is_numeric($search) == true) {
                        $sql .= " <= '". trim($search) ."'";
                    }
                }
            }
            if($order != null) {
                $sql .= " ORDER BY $order";
            }
            if($group != null) {
                $sql .= " GROUP BY $group";
            }
            $sql .= ";";
            return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>