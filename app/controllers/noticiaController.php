<?php
	class noticiaController extends Controller {
		public function index(){
			$this->lista();
		}
		
		public function detalhe(){
			$Noticia = new NoticiasModel;
			$url = $this->getSep(1);
			
            $dados['noticia'] = $Noticia->url($url);
			$dados["ativo"] = "noticia";
			
            return $this->view('site.noticia_detalhe', $dados);
		}

		public function lista(){
            $Noticia = new NoticiasModel;
			$pagina = $this->getPar('pagina');
			
            $dados['pagina'] = is_numeric($pagina) ? $pagina : 1;
			$dados["ativo"] = "noticia";
			$dados['noticias'] = $Noticia->lista($dados['pagina']);
			
            $this->view('site.noticia', $dados);
		}
	}
