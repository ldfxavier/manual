<?php
    class DriveModel extends Model {

        public $_tabela = 'drive';

        public function montar($dados){
            $array = array();
            if($dados):
                foreach($dados as $r):
                    $extensao = explode(".", $r->file);
                    if($extensao[1] == "pdf"):
                        $link_arquivo = ARQUIVO.'/drive/icon_ext_pdf.jpg';
                    elseif($extensao[1] == "docx" || $extensao[1] == "doc"):
                        $link_arquivo = ARQUIVO.'/drive/icon_ext_doc.jpg';
                    elseif($extensao[1] == "jpg" || $extensao[1] == "JPG" || $extensao[1] == "jpeg" || $extensao[1] == "JPEG" || $extensao[1] == "gif" || $extensao[1] == "png"):
                        $link_arquivo = ARQUIVO.'/drive/'.$r->file;
                    else:
                        $link_arquivo = ARQUIVO.'/drive/icon_ext_general.jpg';
                    endif;
                    $array[] = (object)array(
                        'id' => $r->id,
                        'cod' => $r->cod,
                        'titulo' => $r->title,
                        'arquivo' => (object)array(
                            'link' => !empty($r->file) ? ARQUIVO.'/drive/'.$r->file : '',
                            'valor' => $r->file,
                            'extensao' => (object)array(
                                'valor' => $extensao[1],
                                'link' => $link_arquivo
                            ),
                        ),
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

		public function lista(){
			return $this->montar($this->read(null, '`id` DESC'));
		}
    }
