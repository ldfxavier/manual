<?php
class topicoController extends Controller
{
	public function index()
	{
		$this->view('site.index');
	}
		
	public function detalhe(){
		$Noticia = new NoticiasModel;
		$url = $this->getSep(1);
		
		$dados['topico'] = $Noticia->url($url);
		
		return $this->view('site.index', $dados);
	}

	public function busca(){
		$Noticia = new NoticiasModel;
		$texto = $_POST['busca'];

		$dados['busca'] = $Noticia->busca($texto);

		return $this->view('site.busca', $dados);
	}
}
