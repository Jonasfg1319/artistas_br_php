<?php 

namespace App\Models;
 
  use MF\Controller\Action;
  use MF\Model\Model;
 
  class Capitulo extends Model{

      private $id_quadrinho = null;
      private $numero = null;
      private $titulo = null;
      private $titulo_quadrinho = null;

      public function __get($attr){
           
        return $this->$attr;
      }

      public function __set($attr, $val){
      
        $this->$attr = $val;
     }


     public function cadastrarCap(){
        $query = "INSERT INTO capitulos(id_quadrinho,numero,titulo) VALUES(?,?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(1,$this->__get('id_quadrinho'));
        $stmt->bindValue(2,$this->__get('numero'));
        $stmt->bindValue(3,$this->__get('titulo'));
        $stmt->execute();
     }


     public function recuperaC(){
        $query = "SELECT id,numero,titulo FROM capitulos WHERE id_quadrinho = ? AND numero = ? AND titulo = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(1,$this->__get('id_quadrinho'));
        $stmt->bindValue(2,$this->__get('numero'));
        $stmt->bindValue(3,$this->__get('titulo'));
        $stmt->execute();
  
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
      }

      public function recuperaCapitulos($id_q){
        $query = "SELECT id,numero,titulo FROM capitulos WHERE id_quadrinho = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(1,$id_q);
        $stmt->execute();
  
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
      }

  }


  ?>