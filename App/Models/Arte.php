<?php 

namespace App\Models;
 
  use MF\Controller\Action;
  use MF\Model\Model;
 
  class Arte extends Model{
     private $id = null;
     private $id_usuario = null;
     private $titulo = null;
     private $descricao = null;
     private $img = null;
     private $autor = null;

     public function __get($attr){
           
        return $this->$attr;
   }

   public function __set($attr, $val){
      
        $this->$attr = $val;
   }


   public function cadastrarArte(){
       $query = "INSERT INTO artes(id_usuario,titulo,descricao,img,autor) VALUES(?,?,?,?,?)";
       $stmt = $this->db->prepare($query);
       $stmt->bindValue(1,$this->__get('id_usuario'));
       $stmt->bindValue(2,$this->__get('titulo'));
       $stmt->bindValue(3,$this->__get('descricao'));
       $stmt->bindValue(4,$this->__get('img'));
       $stmt->bindValue(5,$this->__get('autor'));
       $stmt->execute();
   }

   public function recuperaArtesPainel($id_user){
       $query = "SELECT id,id_usuario,titulo,descricao,img FROM artes WHERE id_usuario = $id_user ";
       $stmt = $this->db->prepare($query);
       $stmt->execute();

       return $stmt->fetchAll(\PDO::FETCH_ASSOC);
   }

   public function recuperaArte($id_arte,$id_user){

      $query = "SELECT img,id_usuario,id FROM artes WHERE id = $id_arte AND id_usuario = $id_user";
      $stmt = $this->db->prepare($query);
      $stmt->execute();
      
      return $stmt->fetchAll(\PDO::FETCH_ASSOC);
   }

   public function todasArtes(){
    $query = "SELECT img,titulo,id_usuario,id,descricao,autor FROM artes";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
      
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);

   }
  
   public function consultaArte($pesquisa){
       $query = "SELECT img,titulo,id_usuario,id,descricao,autor From artes WHERE titulo LIKE '%$pesquisa%' ";
       $stmt = $this->db->prepare($query);
       $stmt->execute();
         
       return $stmt->fetchAll(\PDO::FETCH_ASSOC);
       
   
    }

    public function recuperaComentario($id_arte,$id_autor){
      $query = "SELECT * FROM comentarios WHERE id_arte = ? AND id_autor = ?";
      $stmt = $this->db->prepare($query);
      $stmt->bindValue(1,$id_arte);
      $stmt->bindValue(2,$id_autor);
      $stmt->execute();

      return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
   

  }

  ?>