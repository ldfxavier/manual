<?php
    /**
     * PADRÕES DO HEADER
     */
    $header_titulo = (isset($_h_titulo) && !empty($_h_titulo)) ? $_h_titulo.' - '.TITULO : TITULO;
    $header_url = (isset($_h_url) && !empty($_h_url)) ? $_h_url : URL;
    $header_descricao = (isset($_h_descricao) && !empty($_h_descricao)) ? $_h_descricao : DESCRICAO;
    $header_imagem = (isset($_h_imagem) && !empty($_h_imagem)) ? $_h_imagem : IMAGEMSOCIAL;
    $header_robots = (isset($_h_robots) && !empty($_h_robots)) ? $_h_robots : ROBOTS;

    $Noticias = new NoticiasModel;
    $menu = $Noticias->menu();
?>
<!DOCTYPE HTML>
<html lang="pt-br">

    <head>
        <title>{{$header_titulo}}</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" type="image/x-icon" href="<?= LINK; ?>/images/favicon.ico">
	</head>
    <body class="homepage">
        <header id="header">
            <div class="esquerdo">

                <span for="navbar-checkbox" class="navbar-icon">&equiv;</span>
                <span class="nome">Documentação</span>
            </div>
            <form class="pesquisa-container" action="{{LINK}}/topico/busca" method="POST">
                <input type="text" id="pesquisa-bar" placeholder="Pesquisar" name="busca">
                <a href="#"><img class="pesquisa-icon" src="{{LINK}}/images/icons/search-icon.png"></a>
            </form>

        </header>
        <nav id="navbar" class="main-nav">

            <header style="display: none"></header>

            <ul>
                <div class="nav-link" rel="internal">
                <?php
                    if(!empty($menu)):
                        foreach($menu as $m):
                ?>
                    <li data-rel="primeiro" class="titulo-maior"><?= $m['categoria'] ?></li>
                <?php 
                            foreach($m['lista'] as $m_l):
                ?>                            
                    <a href="<?= $m_l->url ?>"><li data-rel="primeiro" class="recuo <?= $_topico->id == $m_l->id ? 'ativo' : '' ?>"><?= $m_l->titulo; ?></li></a>
                <?php
                            endforeach;
                        endforeach;
                    endif;
                ?>
                </div>
            </ul>
        </nav>
            [[VIEW]]			

		</div>
        <form action="/" method="post">
            <input type="hidden" name="LINK" id="LINK" value="{{LINK}}">
            <input type="hidden" name="PAINEL" id="PAINEL" value="{{PAINEL}}">
            <input type="hidden" name="ARQUIVO" id="ARQUIVO" value="{{ARQUIVO}}">
            <input type="hidden" name="MOBILE" id="MOBILE" value="{{Sistema::is_mobile()}}"> 
        </form>
        
        <link rel="stylesheet" type="text/css" href="{{LINK}}/css/style.css{{CACHE}}"/>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="{{LINK}}/js/site.js{{CACHE}}" type="text/javascript"></script>
	</body>
</html>
