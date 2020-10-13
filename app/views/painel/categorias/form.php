<?php
	$equipe = $_SESSION['EQUIPE'];
	$permissao = $equipe->permissao->lista;
	$desenvolvedor = $equipe->desenvolvedor == 1 ? true : false;

	$r = isset($_dado) ? $_dado : '';

	if(isset($r->cod)) $cod = $r->cod;
	else $cod = md5(uniqid(time()));

	$coluna = (object)$_coluna;

	$volta = PAINEL.'/app/'.$_app;
?>
<link rel="stylesheet" href="<?= LINK; ?>/app/views/painel/<?= $_app; ?>/scripts/layout.css"/>

<input type="hidden" id="form_app_geral" value="<?= $_app; ?>">
<input type="hidden" id="form_volta_geral" value="<?= $volta; ?>">

<input type="text" class="input_zero" value="">
<?php if(isset($r->id)): ?>
<input type="hidden" name="id" value="<?= $r->id; ?>">
<?php else: ?>
<input type="hidden" name="id" data-falso="1" value="">
<?php endif; ?>
<input type="hidden" name="cod" value="<?= $cod; ?>">

<div class="center">
	<fieldset>
		<div class="legenda">TÍTULOS</div>

		<label>Título:</label>
		<input type="text" data-tamanho="<?= $coluna->titulo->tamanho ?>" name="titulo" value="<?= P::r($r, 'titulo');?>" placeholder="Digite um título">
	</fieldset>
	<fieldset>
		<div class="legenda">PERMISSÕES</div>
		<?= Form::booleano('status', 'Ativar?', P::r($r, 'status->valor'));?>
	</fieldset>
</div>