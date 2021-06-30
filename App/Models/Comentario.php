<?php 

namespace App\Models;
 
  use MF\Controller\Action;
  use MF\Model\Model;
 
  class Comentario extends Model{
     private $id = null;
     private $id_usuario = null;
     private $nick_usuario = null;
     private $id_arte = null;
     private $id_quadrinho = null;
     private $id_cap = null;
     private $id_autor = null;
     private $coment = null;

     public function __get($attr){
           
        return $this->$attr;
      }

      public function __set($attr, $val){
      
        $this->$attr = $val;
     }



     public function postarComentario($valor){
         if($valor == 1){
            $query = "INSERT INTO comentarios(id_usuario,nick_usuario,id_quadrinho,id_cap,id_autor,coment) VALUES(?,?,?,?,?,?)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1,$this->__get("id_usuario"));
            $stmt->bindValue(2,$this->__get("nick_usuario"));
            $stmt->bindValue(3,$this->__get("id_quadrinho"));
            $stmt->bindValue(4,$this->__get("id_cap"));
            $stmt->bindValue(5,$this->__get("id_autor"));
            $stmt->bindValue(6,$this->__get("coment"));
         }else{
            $query = "INSERT INTO comentarios(id_usuario,nick_usuario,id_arte,id_autor,coment) VALUES(?,?,?,?,?)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1,$this->__get("id_usuario"));
            $stmt->bindValue(2,$this->__get("nick_usuario"));
            $stmt->bindValue(3,$this->__get("id_arte"));
            $stmt->bindValue(4,$this->__get("id_autor"));
            $stmt->bindValue(5,$this->__get("coment"));

        }

         $stmt->execute();
     }

    


  }


?>