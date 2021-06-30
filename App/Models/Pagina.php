<?php 

namespace App\Models;
 
  use MF\Controller\Action;
  use MF\Model\Model;
 
  class Pagina extends Model{

      private $id_quadrinho = null;
      private $id_capitulo = null;
      private $img = null;

      public function __get($attr){
           
        return $this->$attr;
      }

      public function __set($attr, $val){
      
        $this->$attr = $val;
     }
    
     public function cadastrarPag(){
        $query = "INSERT INTO paginas(id_quadrinho,id_capitulo,img) VALUES(?,?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(1,$this->__get('id_quadrinho'));
        $stmt->bindValue(2,$this->__get('id_capitulo'));
        $stmt->bindValue(3,$this->__get('img'));
        $stmt->execute();
     }

     public function TodasPaginas($qd_id,$cap_id){
       
        $query = "SELECT img FROM paginas WHERE id_quadrinho = $qd_id AND id_capitulo = $cap_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchALL(\PDO::FETCH_ASSOC);
     }

     public function verificaQuadrinho($qd_id){
        $query ="SELECT id_usuario,titulo FROM quadrinhos WHERE id = $qd_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
     }
    
     public function verificaCapitulo($cap_id){
        $query ="SELECT numero,titulo FROM capitulos WHERE id = $cap_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }


  }


  ?>