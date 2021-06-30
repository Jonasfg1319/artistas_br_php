<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {

		$routes['home'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		);

		$routes['login'] = array(
			'route' => '/login',
			'controller' => 'indexController',
			'action' => 'login'
		);
	   
		$routes['registrar'] = array(
			'route' => '/registrar',
			'controller' => 'indexController',
			'action' => 'registrar'
		);

		$routes['apresentacao_capitulo'] = array(
			'route' => '/apresentacao_capitulo',
			'controller' => 'indexController',
			'action' => 'apresentacao_capitulo'
		);
		 
		$routes['capitulo'] = array(
			'route' => '/capitulo',
			'controller' => 'indexController',
			'action' => 'capitulo'
		);

		$routes['pagina_autor'] = array(
			'route' => '/pagina_autor',
			'controller' => 'indexController',
			'action' => 'pagina_autor'
		);

		$routes['cadastrando'] = array(
			'route' => '/cadastrando',
			'controller' => 'indexController',
			'action' => 'cadastrando'
		);

		
		$routes['autenticar'] = array(
			'route' => '/autenticar',
			'controller' => 'indexController',
			'action' => 'autenticar'
		);

		$routes['fechar_sessao'] = array(
			'route' => '/fechar_sessao',
			'controller' => 'indexController',
			'action' => 'fechar_sessao'
		);
		
        $routes['painel_usuario'] = array(
			'route' => '/painel_usuario',
			'controller' => 'AppController',
			'action' => 'painel_usuario'
		);

		$routes['cadastrar_quadrinho'] = array(
			'route' => '/cadastrar_quadrinho',
			'controller' => 'AppController',
			'action' => 'cadastrar_quadrinho'
		);

		$routes['cadastrar_arte'] = array(
			'route' => '/cadastrar_arte',
			'controller' => 'AppController',
			'action' => 'cadastrar_arte'
		);

		$routes['nova_arte_cadastrada'] = array(
			'route' => '/nova_arte_cadastrada',
			'controller' => 'AppController',
			'action' => 'nova_arte_cadastrada'
		);

		$routes["quadrinho_registrado"] = array(
			'route' => '/quadrinho_registrado',
			'controller' => 'AppController',
			'action' => 'quadrinho_registrado'
		);

		$routes["novo_capitulo"] = array(
			'route' => '/novo_capitulo',
			'controller' => 'AppController',
			'action' => 'novo_capitulo'
		);

		$routes["cap_cadastrado"] = array(
			'route' => '/cap_cadastrado',
			'controller' => 'AppController',
			'action' => 'cap_cadastrado'
		);

		$routes["pag_cap"] = array(
			'route' => '/pag_cap',
			'controller' => 'IndexController',
			'action' => 'pag_cap'
		);

		
		$routes["conteudo"] = array(
			'route' => '/conteudo',
			'controller' => 'IndexController',
			'action' => 'conteudo'
		);

		$routes["buscar_conteudo"] = array(
			'route' => '/buscar_conteudo',
			'controller' => 'IndexController',
			'action' => 'buscar_conteudo'
		);

		$routes["pesquisa"] = array(
			'route' => '/pesquisa',
			'controller' => 'IndexController',
			'action' => 'pesquisa'
		);

		$routes["comentario"] = array(
			'route' => '/comentario',
			'controller' => 'AppController',
			'action' => 'comentario'
		);

		$routes["editar_dados"] = array(
			'route' => '/editar_dados',
			'controller' => 'AppController',
			'action' => 'editar_dados'
		);

		$routes["salvar_dados"] = array(
			'route' => '/salvar_dados',
			'controller' => 'AppController',
			'action' => 'salvar_dados'
		);

		$routes["mensagens"] = array(
			'route' => '/mensagens',
			'controller' => 'AppController',
			'action' => 'mensagens'
		);
       
		$routes["adicionaMsg"] = array(
			'route' => '/adicionaMsg',
			'controller' => 'AppController',
			'action' => 'adicionaMsg'
		);


		

		$this->setRoutes($routes);
	}

}

?>