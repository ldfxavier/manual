<?php
$mobile = Sistema::is_mobile() ? 'mobile' : '';
//$mobile = 'mobile';
$menu = isset($_SESSION['MENU']) && !$mobile ? $_SESSION['MENU'] : 'fechado';

$equipe = $_SESSION['EQUIPE'];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta name="robots" content="noindex,nofollow">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<meta charset="UTF-8">
	<title>ÁREA RESTRITA - <?= TITULO ?></title>

	<link rel="icon" href="<?= LINK ?>/images/painel/favicon.png" type="image/png">

	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
	<link rel="stylesheet" href="<?= LINK ?>/css/painel.css">

	<script src="https://apis.google.com/js/api:client.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9HASI3g0Kml1KR8-qo3fyIq-5t4Y_fOo"></script>
	<script src="<?= LINK ?>/js/fw/editor/tinymce.min.js" type="text/javascript"></script>
	<script src="https://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
	<script src="<?= LINK ?>/js/painel.js" type="text/javascript"></script>

</head>

<body>

	<div id="conteudo_site" class="<?= $menu ?> <?= $mobile ?>">
		<i id="menu_topo" data-font="&#xe800;"></i>
		<div id="bg_topo"></div>

		<nav id="menu_principal">
			<div class="conteudo">
				<header>
					<figure><a class="but_social_abrir imagem_trocar" href="#social" style="background-image: url(<?= $equipe->imagem ?>70)" data-width="70"></a></figure>
					<div class="dados_linha">
						<div class="texto">BEM-VINDO</div>
						<div class="nome"><?= $equipe->nome->primeiro ?><br><?= $equipe->nome->ultimo ?></div>

						<div class="botao">
							<a class="but_senha_abrir" <?php echo ($equipe->mudar_senha == 1) ? 'id="but_forca_mudar_senha"' : '' ?> href="#senha" data-ajuda="Alterar senha"><i data-font="&#xe80d;"></i></a>
							<a class="but_bloquear_abrir" href="#bloquear" data-ajuda="Bloquear sistema"><i data-font="&#xe80e;"></i></a>
							<a href="<?= PAINEL ?>/sair" data-ajuda="Sair do sistema"><i data-font="&#xe80f;"></i></a>
						</div>
					</div>
				</header>

				<ul class="menu_principal">
					<?php
					Menu::principal('USUÁRIOS', $_app, '#FFCC33', array(
						array('Equipe', 'usuario_equipe', 0),
						// array('Usuário', 'usuario_usuario', 0)
					));
					Menu::principal('PUBLICAÇÕES', $_app, '#dd4b39', array(
						array('Tópicos', 'noticias', 0),
						array('Categorias', 'categorias', 0),
					));
					Menu::principal('ADMINISTRATIVO', $_app, '#FF99FF', array(
						// array('Status', 'administrativo_status', 0, true),
					));
					?>
				</ul>

			</div>
		</nav>

		<main id="conteudo_principal">
			[[VIEW]]
		</main>

		<div id="botao_mobile"></div>

		<?php include('app/views/painel/padrao/historico/add.php'); ?>
		<?php include('app/views/painel/padrao/historico/visualizar.php'); ?>
		<?php include('app/views/painel/padrao/social/index.php'); ?>
		<?php include('app/views/painel/padrao/autorizacao/index.php'); ?>
		<?php include('app/views/painel/padrao/senha/alterar.php'); ?>
		<?php include('app/views/painel/padrao/senha/bloquear.php'); ?>
		<?php include('app/views/painel/padrao/contato/index.php'); ?>
		<?php include('app/views/painel/padrao/endereco/index.php'); ?>
		<?php include('app/views/painel/padrao/agenda/index.php'); ?>
	</div>

	<form action="/">
		<input type="hidden" name="PAINEL" id="PAINEL" value="<?= PAINEL ?>">
		<input type="hidden" name="ARQUIVO" id="ARQUIVO" value="<?= ARQUIVO ?>">
		<input type="hidden" name="LINK" id="LINK" value="<?= LINK ?>">
		<input type="hidden" name="MOBILE" id="MOBILE" value="<?= Sistema::is_mobile() ?>">
		<input type="hidden" name="EQUIPE_NOME" id="EQUIPE_NOME" value="<?= $_SESSION['EQUIPE']->nome->valor ?>">
		<input type="hidden" name="SISTEMA" id="SISTEMA" value="<?= SISTEMA ?>">
	</form>

	<div id="but_historico_reload"></div>

</body>

</html>