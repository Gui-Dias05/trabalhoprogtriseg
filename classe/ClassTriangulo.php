<?php
    //include_once 'conf/Conexao.php';
    //require_once 'conf/conf.inc.php';
    require_once 'ClassForma.php';
    class Triangulo extends Forma{
        private $lado1;
        private $lado2;
        private $lado3;

        public function __construct($id, $cor, $tabuleiro_idtabuleiro, $lado1, $lado2, $lado3) {
            parent::__construct($id, $cor, $tabuleiro_idtabuleiro);
            $this->setlado1($lado1);
            $this->setlado2($lado2);
            $this->setlado3($lado3);
        }

        public function getlado1(){ 
            return $this->lado1; 
        }

        public function setlado1($lado1){ 
            $this->lado1 = $lado1;
        }      

        public function getlado2(){ 
            return $this->lado2; 
        }

        public function setlado2($lado2){ 
            $this->lado2 = $lado2;
        }      

        public function getlado3() {
            return $this->lado3;
        }

        public function setlado3($lado3) {
                $this->lado3 = $lado3;
        }

        public function __toString() {
            $str = parent::__toString();
            $str .= "Lado1: ".$this->getlado1()."<br>".
                    "Lado2: ".$this->getlado2()."<br>".
                    "Lado3: ".$this->getlado3()."<br>".
                    "Tipo: ".$this->tipo()."<br>";
            return $str;
        }
        
        public function tipo(){
            if($this->getlado1() == $this->getlado2() && $this->getlado2() == $this->getlado3()){
                return "equilátero";
            }elseif($this->getlado1() == $this->getlado2() || $this->getlado1() == $this->getlado3() || $this->getlado2() == $this->getlado3()){
                return "isóceles";
            }else{
                return "escaleno";
            }
        }

        public function desenhar(){
             $str = "<div style='width: 0px; height: 0px; border-left: ".$this->lado1."px solid transparent; border-right: ".$this->lado2."px solid transparent; border-bottom: ".$this->lado3."px solid ".parent::getcor().";'></div><br>";
             return $str;
         }
    }

    // $tri = new Triangulo(1, 'black', 2, 2, 2, 2);
    // echo $tri."<br> <br>";
    // $tri = new Triangulo(2, 'green', 3, 2, 1, 1);
    // echo $tri."<br> <br>";


    // testar depois
    // public function text(){
        //     $y = deg2rad(55);
        //     $c = "";
        //     return $c=sqrt(pow($this->getlado1(), 2)+pow($this->getlado2(), 2)-2*$this->getlado1()*$this->getlado2()*cos($y));
        // }

    //echo $tri->text() ."<br>";
?>



