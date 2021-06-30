<?php 

namespace App\Models;
 
  use MF\Controller\Action;
  use MF\Model\Model;
 
  class Mensagem extends Model{
     private $id = null;
     private $id_remetente = null;
     private $id_destinatario = null;
     private $mensagem = null;

     public function __get($attr){
           
        return $this->$attr;
      }

      public function __set($attr, $val){
      
        $this->$attr = $val;
     }


     public function novaMensagem(){
        $query = "INSERT INTO mensagens(id_remetente,id_destinatario,mensagem) VALUES(?,?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(1,$this->__get("id_remetente"));
        $stmt->bindValue(2,$this->__get("id_destinatario"));
        $stmt->bindValue(3,$this->__get("mensagem"));
        $stmt->execute();
     }


     public function carregaMensagens($remetente,$destinatario){
        $query = "SELECT * FROM mensagens WHERE id_remetente = ? AND id_destinatario = ? OR id_remetente = ? AND id_destinatario = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(1,$remetente);
        $stmt->bindValue(2,$destinatario);
        $stmt->bindValue(3,$destinatario);
        $stmt->bindValue(4,$remetente);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
     }

     public function all($id){
         $query = "SELECT * FROM mensagens WHERE id_remetente = ? OR id_destinatario = ?";
         $stmt = $this->db->prepare($query);
         $stmt->bindValue(1,$id);
         $stmt->bindValue(2,$id);
         $stmt->execute();

         return $stmt->fetchAll(\PDO::FETCH_ASSOC);

        }

        public function especificas($id){
         $query = "SELECT * FROM mensagens WHERE id_remetente = ? OR id_destinatario = ?";
         $stmt = $this->db->prepare($query);
         $stmt->bindValue(1,$id);
         $stmt->bindValue(2,$id);
         $stmt->execute();

         return $stmt->fetchAll(\PDO::FETCH_ASSOC);

        }


    }


    ?>