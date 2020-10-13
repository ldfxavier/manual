<?php
class CategoriasModel extends Model
{

    public $_tabela = 'categorias';

    public function montar($dados)
    {
        $array = array();
        if ($dados) :
            foreach ($dados as $r) :
                $array[] = (object)array(
                    'id' => $r->id,
                    'cod' => $r->cod,
                    'titulo' => $r->titulo,
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

    public function lista()
    {
        $dados = $this->montar($this->read('status = 1'));

        return (object)$dados;
    }

    public function url($url)
    {
        $dado = $this->montar($this->read("`url` = '{$url}' AND " . $this->_where));
        if ($dado) return $dado[0];
        return false;
    }

    public function cod($cod)
    {
        $noticia = $this->montar($this->read("`cod` = '{$cod}' AND `status` = '1'"));
        return $noticia[0];
    }
}
