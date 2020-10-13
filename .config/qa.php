<?php
	/**
	 * CONFIGURAÇÃO GERAL DO HEADER
	**/
	$qa_header = array(
		'robots' => 'noindex, nofollow',
	);

	/**
	 * CONFIGURAÇÕES GERIAS DO SITE
	**/
	$qa_config = array(
		'erro' => true,
		'fuso' => 'America/Sao_Paulo',
		'https' => 'auto',
		'www' => 'auto',
		'emailsistema' => 'ldfxavier@gmail.com'
	);

	/**
	 * LINKS DO SISTEMA
	**/
	$qa_link = array(
		'link' => array('localhost'),
		'painel' => '{{LINK}}/painel',
		'arquivo' => '{{LINK}}/arquivos',
		'diretorio' => 'arquivos'
	);

	/**
	 * CONFIGURAÇÃO DO PDO
	**/
	$qa_pdo = array(
		'host' => 'localhost',
		'banco' => 'manual',
		'usuario' => 'manual',
		'senha' => 'Manual@1324'
	);

	/**
	 * APIs DO GOOGLE
	**/
	$qa_google = [
		'analytics' => true,
		'client_id' => '603486271743-v89jlcsaq60rsluj2b8hahvrgqnsvs1f.apps.googleusercontent.com',
		'client_key' => 'AIzaSyB1GakuvI1ulXf0CjPkA1K7fE0h__MNon8'
	];

	/**
	 * API DO FACEBOOK
	**/
	$qa_facebook = [
		'key' => '1604946669720593'
	];

	/**
	 * DADOS OPCIONAIS DO SISTEMA
	**/
	$qa_opcionais = [

	];
