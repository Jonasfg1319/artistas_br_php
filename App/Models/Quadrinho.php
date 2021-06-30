<?php 

namespace App\Models;
 
  use MF\Controller\Action;
  use MF\Model\Model;
 
  class Quadrinho extends Model{
    
    private $id_usuario = null;
    private $titulo = null;
    private $descricao = null;
    private $capa = null;
    private $genero = null;
    private $status = null;
    private $autor = null;

    public function __get($attr){
       
        return $this->$attr;
        
    }

    public function __set($attr,$value){
       
        $this->$attr = $value;

    }

    public function cadastrarQuadrinho(){
      $query = "INSERT INTO quadrinhos(id_usuario,titulo,descricao,capa,genero,status,autor) VALUES(?,?,?,?,?,?,?)";
      $stmt = $this->db->prepare($query);
      $stmt->bindValue(1,$this->__get("id_usuario"));
      $stmt->bindValue(2,$this->__get("titulo"));
      $stmt->bindValue(3,$this->__get("descricao"));
      $stmt->bindValue(4,$this->__get("capa"));
      $stmt->bindValue(5,$this->__get("genero"));
      $stmt->bindValue(6,$this->__get("status"));
      $stmt->bindValue(7,$this->__get("autor"));

      $stmt->execute();
    }

    public function recuperaQ($id_user){
      $query = "SELECT id,titulo,descricao FROM quadrinhos WHERE id_usuario = $id_user AND titulo = ?";
      $stmt = $this->db->prepare($query);
      $stmt->bindValue(1,$this->__get("titulo"));
      $stmt->execute();
     
      return $stmt->fetchAll(\PDO::FETCH_ASSOC);
      
    }

    public function recuperaQuadrinhos(){
      $query = "SELECT id,id_usuario,titulo,descricao,capa,genero,status,autor FROM quadrinhos";
      $stmt = $this->db->prepare($query);
      $stmt->execute();
     
      return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function recuperaQuadrinhoQ($id_q){
      $query = "SELECT id,id_usuario,titulo,descricao,autor,capa,genero,status FROM quadrinhos WHERE id = $id_q ";
      $stmt = $this->db->prepare($query);
      $stmt->execute();
     
      return $stmt->fetch(\PDO::FETCH_ASSOC);
      
    }

    public function recuperaQuadrinhoUser($id_us){
      $query = "SELECT id,id_usuario,titulo,descricao,autor,capa,genero,status FROM quadrinhos WHERE id_usuario = ?";
      $stmt = $this->db->prepare($query);
      $stmt->bindValue(1,$id_us);
      $stmt->execute();
     
      return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    

    public function pesquisaConteudo($status,$genero){
       $query = "SELECT id,id_usuario,titulo,descricao,autor,capa,genero,status FROM quadrinhos WHERE status = ? AND genero = ?";
       $stmt = $this->db->prepare($query);
       $stmt->bindValue(1,$status);
       $stmt->bindValue(2,$genero);
       $stmt->execute();
     
       return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function consulta($pesquisa){
      $query = "SELECT id,id_usuario,titulo,descricao,autor,capa,genero,status FROM quadrinhos WHERE titulo  LIKE '%$pesquisa%' ";
      $stmt = $this->db->prepare($query);
      $stmt->execute();

      return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function recuperaComentario($id_quadrinho,$id_cap){
      $query = "SELECT * FROM comentarios WHERE id_quadrinho = ? AND id_cap = ?";
      $stmt = $this->db->prepare($query);
      $stmt->bindValue(1,$id_quadrinho);
      $stmt->bindValue(2,$id_cap);
      //$stmt->bindValue(3,$id_autor);
      $stmt->execute();

      return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

  }