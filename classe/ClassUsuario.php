<?php
require_once "conf/Conexao.php";
class Usuario{
    private $idusuario;
    private $nome;
    private $user; 
    private $senha; 
    public function __construct($idusuario, $nome, $user, $senha){ 
        $this->setidusuario  ($idusuario);
        $this->setnome  ($nome);
        $this->setuser ($user);
        $this->setsenha ($senha);
    }
    //construct

    public function getidusuario(){ return $this->idusuario; }
    public function setidusuario($idusuario){ $this->idusuario = $idusuario;}
    public function getnome() {return $this->nome;}
    public function getuser() {return $this->user;}
    public function setnome($nome){if ($nome >  0)$this->nome = $nome;}
    public function setuser($user){if (strlen($user) > 0)$this->user = $user;}
    public function getsenha() {return $this->senha;}
    public function setsenha($senha){if ($senha >  0)$this->senha = $senha;}
    //get e set

    /*public function Area(){
        $area = $this->nome * $this->nome;
        return $area;

    }
    public function Perimetro(){
        $perimetro = $this->nome + $this->nome+ $this->nome + $this->nome;
        return $perimetro;
     
    }
    public function Diagonal(){
        $diagonal = $this->nome * 1.44;
        return $diagonal;
    }

    public function __toString(){
        return  "[usuario]<br>nome: ".$this->getnome()."<br>".
        "user: ".$this->getuser()."<br>".
        "Area: ".$this->Area()."<br>".
        "Perimetro: ".$this->Perimetro()."<br>".
        "Diagonal: ".$this->Diagonal()."<br>";
    }*/

    public function salvar(){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO usuario (nome, user, senha) VALUES(:nome, :user, :senha)');
        $stmt->bindValue(':nome', $this->getnome());
        $stmt->bindValue(':user', $this->getuser());
        $stmt->bindValue(':senha', $this->getsenha());
        return $stmt->execute();

    }
    // criação função salvar 

    public function excluir($idusuario){
        $pdo = Conexao::getInstance();
        $stmt = $pdo ->prepare('DELETE FROM usuario WHERE idusuario = :idusuario');
        $stmt->bindValue(':idusuario', $idusuario);    
        return $stmt->execute();
    }
    // criação função excluir

    public function editar(){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE usuario SET nome = :nome, user = :user, senha = :senha
        WHERE idusuario = :idusuario');
    
        $stmt->bindValue(':idusuario', $this->getidusuario());
        $stmt->bindValue(':nome', $this->getnome());
        $stmt->bindValue(':user', $this->getuser());
        $stmt->bindValue(':senha', $this->getsenha());
        return $stmt->execute();
    }
    //criação função editar

    public function listar($buscar = 0, $procurar = ""){
        $pdo = Conexao::getInstance();
        $sql = "SELECT * FROM usuario";
        if ($buscar > 0)
            switch($buscar){
                case(1): $sql .= " WHERE idusuario = :procurar"; break;
                case(2): $sql .= " WHERE nome like :procurar"; break;
                case(3): $sql .= " WHERE user like :procurar"; break;
            }
        $stmt = $pdo->prepare($sql);
        if ($buscar > 0)
            $stmt->bindValue(':procurar', $procurar, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    //criação função listar

    function desenhar(){
        $str = "<div style='width: ".$this->getnome()."px; height: ".$this->getnome()."px; background: ".$this->getuser()."'></div>";
        return $str;
    }
    //criação função desenhar e prepare

    public function efetuarlogin($user, $senha){
        $pdo = Conexao::getInstance();
        $sql = "SELECT nome FROM usuario WHERE user = '$user' AND senha = '$senha';";
        $resultado = $pdo->query($sql)->fetchAll();
        if($resultado){
            $_SESSION['nome'] = $resultado[0]['nome'];
            return true;
        } else {
            $_SESSION['nome'] = null;
            return false;
        }
    
    }
    //criação função efetuar login


}
        
?>