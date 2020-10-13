<?php
class NoticiasModel extends Model
{

    public $_tabela = 'noticia';

    public function montar($dados)
    {
        $array = array();
        if ($dados) :
            $Painel = new PainelModel;
            foreach ($dados as $r) :
                $array[] = (object)array(
                    'id' => $r->id,
                    'cod' => $r->cod,
                    'titulo' => $r->titulo,
                    'texto' => $r->texto,
                    'categoria' => $r->categoria,
                    'imagem' => (object)array(
                        'link' => !empty($r->imagem) ? ARQUIVO . '/noticias/' . $r->imagem : '',
                        'valor' => $r->imagem
                    ),
                    'video' => (object)array(
                        'iframe' => !empty($r->video) ? Converter::video($r->video) : '',
                        'valor' => $r->video
                    ),
                    'url' => (object)[
                        'link' => LINK . '/noticia/' . $r->url,
                        'valor' => $r->url
                    ],
                    'link' => LINK . '/noticias/detalhe/' . $r->cod,
                    'data' => (object)array(
                        'criacao' => (object)array(
                            'br' => Converter::data($r->data_criacao, 'd/m/Y'),
                            'valor' => $r->data_criacao
                        ),
                        'atualizacao' => (!empty($r->data_atualizacao) && $r->data_atualizacao != '0000-00-00 00:00:00') ? Converter::data($r->data_atualizacao, 'd/m/Y H:i') : ''
                    ),
                    'status' => (object)array(
                        'valor' => $r->status == 1 ? 1 : 2,
                        'texto' => $r->status == 1 ? 'Ativo' : 'Inativo',
                        'cor' => $r->status == 1 ? '#16A085' : '#E05D6F'
                    )
                );
            endforeach;
        endif;
        return $array;
    }

    public function montar_basico($dados)
    {
        $array = array();
        if ($dados) :
            foreach ($dados as $r) :
                $array[] = (object)array(
                    'id' => $r->id,
                    'titulo' => $r->titulo,
                    'texto' => Converter::limite($r->texto, 100),
                    'categoria' => $r->categoria,
                    'url' => (object)[
                        'link' => LINK . '/topico/' . $r->url,
                        'valor' => $r->url
                    ]
                );
            endforeach;
        endif;
        return $array;
    }

    public function menu()
    {
        $Painel = new PainelModel;

        $dados = $this->montar_basico($this->read("`status` = 1"));
        $retorno = [];

        foreach($dados as $r):
            $retorno[$r->categoria]['categoria'] = $Painel->p_campo('categorias', 'titulo', "`id` = {$r->categoria}");
            $retorno[$r->categoria]['lista'][] = (Object)[
                'id' => $r->id,
                'titulo' => $r->titulo,
                'url' => $r->url->link
            ];
        endforeach;
        return $retorno;
    }

    public function busca($texto)
    {
        $dados = $this->montar_basico($this->read("`titulo` LIKE '%{$texto}%' OR `texto` LIKE '%{$texto}%'"));
        
        if ($dados) return $dados;
        return false;
    }

    public function url($url)
    {
        $dado = $this->montar($this->read("`url` = '{$url}'"));
        if ($dado) return $dado[0];
        return false;
    }

    public function cod($cod)
    {
        $noticia = $this->montar($this->read("`cod` = '{$cod}' AND `status` = '1'"));
        return $noticia[0];
    }
}
