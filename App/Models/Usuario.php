<?php 

namespace App\Models;
 
  use MF\Controller\Action;
  use MF\Model\Model;
 
  class Usuario extends Model{
      
      private $nick = null;
      private $email = null;
      private $nome = null;
      private $sobrenome = null;
      private $id = null;
      private $id_privilegio = 2;
      private $senha = null;
      private $img_perfil = "Emilie.jpg";


      public function __get($attr){
           
           return $this->$attr;
      }

      public function __set($attr, $val){
         
           $this->$attr = $val;
      }


      public function adicionaUsuario(){
          $verificacao = $this->disponibilidadeNickEmail();
      	if($verificacao[0] < 1 && $verificacao[1] < 1){
               $query = "INSERT INTO usuarios(nick,email,senha,id_privilegio,nome,sobrenome,img_perfil) VALUES(:nick,:email,:senha,:id_privilegio,:nome,:sobrenome,:img_perfil)";
               $stmt = $this->db->prepare($query);
               $stmt->bindValue("nick",$this->__get("nick"));
               $stmt->bindValue(":email",$this->__get('email'));
               $stmt->bindValue(":senha",$this->__get('senha'));
               $stmt->bindValue(":id_privilegio",$this->__get('id_privilegio'));
               $stmt->bindValue(":nome",$this->__get('nome'));
               $stmt->bindValue(":sobrenome",$this->__get('sobrenome'));
               $stmt->bindValue(":img_perfil",$this->__get('img_perfil'));
               $stmt->execute();
               
               return true;

           }else{
                return false;
           }
      	



      }

      public function autenticaUsuario(){
          $senha_guardada = $this->recuperaSenha();
          $senha_passada = $this->__get('senha');
          if(\password_verify($senha_passada,$senha_guardada)){
          $query = "SELECT nick,img_perfil,id,id_privilegio FROM usuarios WHERE email = :email and senha = :senha";
          $stmt = $this->db->prepare($query);
          
      	$stmt->bindValue(":email",$this->__get('email'));
      	$stmt->bindValue(":senha",$senha_guardada);
      	$stmt->execute();
          
           return $stmt->Fetch(\PDO::FETCH_ASSOC);

          }else{
               $vetor = []; 
               return $vetor;
          }
      	

      	
      }


      public function recuperaSenha(){
           $query = "SELECT senha FROM usuarios WHERE email = :email";
           $stmt = $this->db->prepare($query);
           $stmt->bindValue(":email",$this->__get('email'));
           $stmt->execute();
           $registros =  $stmt->fetchAll(\PDO::FETCH_ASSOC);
           $senha_recuperada = $registros[0]['senha'];
           return $senha_recuperada;
      }

    
      public function disponibilidadeNickEmail(){
           $consultas = [];
          
           $query = "SELECT email FROM usuarios WHERE email = :email";
           $stmt = $this->db->prepare($query);
           $stmt->bindValue(":email",$this->__get('email'));
           $stmt->execute();
           
           
           array_push($consultas, $stmt->fetch(\PDO::FETCH_ASSOC));

           $query = "SELECT nick FROM usuarios WHERE nick = :nick";
           $stmt = $this->db->prepare($query);
           $stmt->bindValue(":nick",$this->__get('nick'));
           $stmt->execute();
           array_push($consultas, $stmt->fetch(\PDO::FETCH_ASSOC));
           

           return $consultas;
      }

      public function recuperaUser($id){
        $query = "SELECT nick,nome,sobrenome,id,img_perfil,email,descricao FROM usuarios WHERE id = $id";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
      }

  }


?>