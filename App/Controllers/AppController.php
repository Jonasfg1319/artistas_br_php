<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {
   public $titulo_cap = "";
   public function painel_usuario(){
        session_start();
        $arte = Container::getModel("Arte");
        $quadrinhos = Container::getModel("Quadrinho");
        $this->view->todos_quadrinhos = $quadrinhos-> recuperaQuadrinhoUser($_SESSION['id']);
        $this->view->todas_artes = $arte->recuperaArtesPainel($_SESSION['id']);
        $this->render("painel_usuario");
   }

   public function cadastrar_quadrinho(){
      $this->render("cadastrar_quadrinho");
 }

 public function cadastrar_arte(){
   $this->render("cadastrar_arte");
}

public function nova_arte_cadastrada(){
   session_start();
   $arte = Container::getModel('Arte');
   $arte->__set('id_usuario', $_SESSION['id']);
   $arte->__set('titulo', $_POST['titulo']);
   $arte->__set('descricao', $_POST['descricao']);
   $arte->__set('img', $_FILES['arte']['name']);
   $arte->__set('autor', $_SESSION['nick']);
   $nome_pasta = $_SESSION['id'];
   if(!is_dir($nome_pasta)){
  	 mkdir("Midia/".$nome_pasta,0777,true);
     }else{
        echo "já tem";
     }

   if(!is_dir("Artes")){
  	 mkdir("Midia/".$nome_pasta."/Artes",0777,true);
     }else{
        echo "já tem";
     }
   
   move_uploaded_file($_FILES['arte']['tmp_name'], "Midia/".$nome_pasta."/"."Artes/".$arte->__get('img'));
   $arte->cadastrarArte();
   header("Location: /painel_usuario");
}

 public function quadrinho_registrado(){
    print_r($_POST);
    
    if($_POST['titulo'] != "" && $_POST['descricao'] != "" && $_POST['genero'] != "" && $_POST['status'] != "" && $_FILES['capa']['name'] != ""){
       session_start();
       $quadrinho = Container::getModel("Quadrinho");
       
       $quadrinho->__set("id_usuario", $_SESSION['id']);
       $quadrinho->__set("titulo", $_POST['titulo']);
       $quadrinho->__set("descricao", $_POST['descricao']);
       $quadrinho->__set("genero", $_POST['genero']);
       $quadrinho->__set("status", $_POST['status']);
       $quadrinho->__set("capa", $_FILES['capa']['name']);
       $quadrinho->__set("autor", $_SESSION['nick']);
       $quadrinho->cadastrarQuadrinho();
       
       $nome_pasta = $_SESSION['id'];
         if(!is_dir($nome_pasta)){
         mkdir("Midia/".$nome_pasta,0777,true);
         }else{
            echo "já tem";
         }

         if(!is_dir("Quadrinhos")){
         mkdir("Midia/".$nome_pasta."/Quadrinhos",0777,true);
         }else{
            echo "já tem";
         }
         
         
         if(!is_dir("Quadrinhos")){
            mkdir("Midia/".$nome_pasta."/Quadrinhos/".$_POST['titulo'],0777,true);
            }else{
               echo "já tem";
            }
      $titulo_cap = $_POST['titulo'];
      move_uploaded_file($_FILES['capa']['tmp_name'], "Midia/".$nome_pasta."/"."Quadrinhos/".$_POST['titulo']."/".$quadrinho->__get('capa'));

       $this->view->dados = $quadrinho->recuperaQ($_SESSION['id']);
       echo "chegou";
       print_r($this->view->dados);
       header("Location: /novo_capitulo?quadrinho=".$this->view->dados[0]['id']."&titulo=".$_POST['titulo']);
    }else{
       header("Location: /cadastrar_capitulo");
    }
   
   //header("Location: /novo_capitulo");
 }

 public function novo_capitulo(){
    $this->render("novo_capitulo");
 }

 public function cap_cadastrado(){
    session_start();
    print_r($_POST);
    print_r($_FILES);
    $contagem = count($_FILES);
    $capitulo = Container::getModel("Capitulo");
    $paginas = Container::getModel("Pagina");

    $capitulo->__set("id_quadrinho",$_GET['quadrinho']);
    $capitulo->__set("titulo",$_POST['titulo']);
    $capitulo->__set("numero",$_POST['numero']);
    $capitulo->__set("titulo_quadrinho", $_GET['titulo']);
    
    $nome_pasta = $_SESSION['id'];
    $titulo_qd = $capitulo->__get("titulo_quadrinho");
    if(!is_dir($nome_pasta)){
      mkdir("Midia/".$nome_pasta,0777,true);
      }else{
         echo "já tem";
      }
      
      if(!is_dir("Quadrinhos")){
         mkdir("Midia/".$nome_pasta."/Quadrinhos",0777,true);
      }else{
            echo "já tem";
           }

      if(!is_dir($titulo_qd)){
         mkdir("Midia/".$nome_pasta."/Quadrinhos/".$titulo_qd,0777,true);
      }else{
         echo "já tem";
      }

      if(!is_dir("Capitulos")){
         mkdir("Midia/".$nome_pasta."/Quadrinhos/".$titulo_qd."/Capitulos",0777,true);
      }else{
            echo "já tem";
          }

      

   //

    $capitulo->cadastrarCap();
    $this->view->dados2 = $capitulo->recuperaC();
    for($pag = 1; $pag <=$contagem; $pag++){
       $paginas->__set("id_quadrinho", $_GET['quadrinho']);
       $paginas->__set("id_capitulo",$this->view->dados2[0]['id']);
       $paginas->__set("img",$_FILES['pagina-'.$pag]['name']);
       $paginas->cadastrarPag();

       $nome_pasta = $_SESSION['id'];
       if(!is_dir($nome_pasta)){
         mkdir("Midia/".$nome_pasta,0777,true);
         }else{
            echo "já tem";
         }if(!is_dir("Quadrinhos")){
            mkdir("Midia/".$nome_pasta."/Quadrinhos",0777,true);
         }else{
               echo "já tem";
         }if(!is_dir($titulo_qd)){
            mkdir("Midia/".$nome_pasta."/Quadrinhos/".$titulo_qd,0777,true);
         }else{
               echo "já tem";
         }if(!is_dir("Capitulos")){
            mkdir("Midia/".$nome_pasta."/Quadrinhos/".$titulo_qd."/Capitulos",0777,true);
         }else{
               echo "já tem";
             }
         if(!is_dir($_POST['numero']." - ".$_POST['titulo'])){
            mkdir("Midia/".$nome_pasta."/Quadrinhos/".$titulo_qd."/Capitulos/".$_POST['numero']." - ".$_POST['titulo'],0777,true);
         }else{
                  echo "já tem";
            }
         
         
         move_uploaded_file($_FILES['pagina-'.$pag]['tmp_name'], "Midia/".$nome_pasta."/Quadrinhos/".$titulo_qd."/Capitulos/".$_POST['numero']." - ".$_POST['titulo']."/".$paginas->__get('img'));
         
         header("Location: /?".$titulo_qd);
      }

    header("Location: /");
 }

 public function comentario(){
    $comentarios = Container::getModel("Comentario");
    session_start();
    if(isset($_GET['arte'])){
      $comentarios->__set("id_usuario",$_SESSION['id']);
      $comentarios->__set("nick_usuario",$_SESSION['nick']);
      $comentarios->__set("id_arte",$_GET['arte']);
      $comentarios->__set("id_autor",$_GET['us']);
      $comentarios->__set("coment",$_POST['coment']);
      $comentarios->postarComentario(2);
      header("Location: /capitulo?arte=".$_GET['arte']."&us=".$_GET['us']);
       //echo "É uma arte";
    }else if(isset($_GET['val'])){
      $comentarios->__set("id_usuario",$_SESSION['id']);
      $comentarios->__set("nick_usuario",$_SESSION['nick']);
      $comentarios->__set("id_quadrinho",$_GET['qd']);
      $comentarios->__set("id_cap",$_GET['val']);
      $comentarios->__set("id_autor",$_GET['user']);
      $comentarios->__set("coment",$_POST['coment']);
      $comentarios->postarComentario(1);
      header("Location: /pag_cap?val=".$_GET['val']."&qd=".$_GET['qd']);
      //echo "É um quadrinho";
    }else{
       echo "erro";
    }
 }

 

  public function editar_dados(){
   session_start();
   $user = Container::getModel("Usuario");
   $this->view->dadosUser = $user->recuperaUser($_SESSION['id']);
   $this->render("editar_dados");
  }

  public function salvar_dados(){
       print_r($_POST);
  }

  public function mensagens(){
   \session_start();
   $mensagens = Container::getModel("Mensagem");
   $this->view->todasMensagens = $mensagens->all($_SESSION['id']);
   $this->view->mensagens = $mensagens->carregaMensagens($_GET['remetente'],$_GET['destinatario']);
   $this->render("mensagens");
}

  public function adicionaMsg(){
   session_start();
   $mensagens = Container::getModel("Mensagem");
   $mensagens->__set("id_remetente",$_SESSION['id']);
   $mensagens->__set("id_destinatario",$_GET['destinatario']);
   $mensagens->__set("mensagem",$_POST['mensagem']);
   $mensagens->novaMensagem();
   //echo "foi";
   header("Location: /mensagens?destinatario=".$_GET['destinatario']."&remetente=".$_GET['remetente']);
  }

}




?>