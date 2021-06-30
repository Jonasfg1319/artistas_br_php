<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {
		$quadrinho = Container::getModel("Quadrinho");
		$arte = Container::getModel("Arte");
		//$this->View->todos_quadrinhos = new \stdClass();
		$this->view->todos_quadrinhos = $quadrinho->recuperaQuadrinhos();
		$this->view->recupera_todas_artes = $arte->todasArtes();
		$this->render('index');
	}

	public function login() {

		$this->render('login');
	}
   
	public function registrar() {

		$this->render('registrar');
	}

	public function apresentacao_capitulo(){
		$quadrinho = Container::getModel("Quadrinho");
		$capitulos = Container::getModel("Capitulo");
		$this->view->qcap = $quadrinho->recuperaQuadrinhoQ($_GET['qd']);
		$this->view->capi = $capitulos->recuperaCapitulos($_GET['qd']);
		$this->render('apresentacao_capitulo');
	}

	public function capitulo(){
		if(isset($_GET['arte'])){
			$arte = Container::getModel("Arte");
			$this->view->comentarios = $arte->recuperaComentario($_GET['arte'],$_GET['us']);
			$this->view->arte = $arte->recuperaArte($_GET['arte'],$_GET['us']);
		}
		$this->render('capitulo');
	}

	public function pagina_autor(){
		if(isset($_GET['autor'])){
			$autor = Container::getModel("Usuario");
			$artes = Container::getModel('Arte');
			$quadrinhos = Container::getModel('Quadrinho');
			$this->view->quadrinhos = $quadrinhos->recuperaQuadrinhoUser($_GET['autor']);
			$this->view->artes = $artes->recuperaArtesPainel($_GET['autor']);
			$this->view->user = $autor->recuperaUser($_GET['autor']);
		}
		
		$this->render('pagina_autor');
	}

	public function cadastrando(){
		
		if(isset($_POST['registrar'])){
			if($_POST['nome'] != "" && $_POST['sobrenome'] != "" && $_POST['nick'] != "" && $_POST['email'] != "" && $_POST['senha'] != ""){
				$user = Container::getModel("Usuario");
				$user->__set('nick',$_POST['nick']);
				$user->__set('email',$_POST['email']);
				$user->__set('nome',$_POST['nome']);
				$user->__set('sobrenome',_POST['sobrenome']);
			    $opt = ['cost' => 8];
			    $hash = password_hash($_POST['senha'],  PASSWORD_BCRYPT, $opt);
			    $user->__set('senha',$hash);
            if($user->adicionaUsuario() != false){
				header("Location: /login");
			}else{
				header("Location: /registrar?erro=invalido");
			}
			}else{
				header("Location: /registrar?erro=falta_campos");
			}
		}
		
	}

	
	public function autenticar(){
		
		
		if($_POST['email'] != "" && $_POST['senha'] != ""){
		  
			$user = Container::getModel('Usuario');
			$user->__set('email',$_POST['email']);
			$user->__set('senha',$_POST['senha']);
			$this->view->usuario = $user->autenticaUsuario();

			$var = count($this->view->usuario);
			echo $var;
		if($var > 1){
			session_start();
		    $this->view->privilegio = $this->view->usuario['id_privilegio'];
			$_SESSION['id_privilegio'] =  $this->view->usuario['id_privilegio'];
			$_SESSION['img_perfil'] = $this->view->usuario['img_perfil'];
			$_SESSION['nick'] = $this->view->usuario['nick'];
			$_SESSION['id'] = $this->view->usuario['id'];
			header('Location: /');
		}else{
			$this->view->var = $var;
            header("Location: /login?erro=404&var=".$var);
		}
		
		}else{
			header("Location: /login?erro=falta_infos");
		}
		
		
		
		
	}

	public function pag_cap(){
		$paginas = Container::getModel("Pagina");
	    $quadrinho = Container::getModel("Quadrinho");
		$this->view->comentario = $quadrinho->recuperaComentario($_GET['qd'],$_GET['val']);
		$this->view->qd = $paginas->verificaQuadrinho($_GET['qd']);
		$this->view->cap = $paginas->verificaCapitulo($_GET['val']);
		$this->view->paginas = $paginas->TodasPaginas($_GET['qd'],$_GET['val']);
		$this->render("pag_cap");
	}

	public function conteudo(){
		$quadrinho = Container::getModel("Quadrinho");
		$this->view->quadrinho = $quadrinho->pesquisaConteudo("Em Andamento","Aventura");
		$this->render('conteudo');
	}

	public function buscar_conteudo(){
		//print_r($_POST);
		if($_POST['tipo'] == "quadrinhos"){
			$quadrinho = Container::getModel("Quadrinho");
			$this->view->quadrinho = $quadrinho->pesquisaConteudo($_POST['status'],$_POST['genero']);
		    $this->render("conteudo");
		}else{
			$artes = Container::getModel("Arte");
			$this->view->artes = $artes->todasArtes();
			$this->render("conteudo");
		}
	}

	public function pesquisa(){
		//print_r($_POST);
        if($_POST['pesquisa'] != ""){
			$artes = Container::getModel("Arte");
			$quadrinho = Container::getModel("Quadrinho");
			$this->view->quadrinho = $quadrinho->consulta($_POST['pesquisa']);
			$this->view->artes = $artes->consultaArte($_POST['pesquisa']);
			$this->render("conteudo");
		}
		
	}

	public function fechar_sessao(){
		session_start();
		session_destroy();
		header('Location: /');
	}
}


?>