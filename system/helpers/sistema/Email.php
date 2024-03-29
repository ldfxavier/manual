<?php
    final class Email {

        /**
         * ENVIA MENSAGEM PARA SISTEMA DE DESPARO DE E-MAIL
         * @var $titulo string  Título da mensagem
         * @var $nome   string  Nome de quem vai receber o e-mail
         * @var $email  string  E-mail de quem vai receber o e-mail
         * @var $link   string  Link da página html onde será montado o e-mail
         * @var $dados  array   Array com dados personalizados
         *                          host = string
         *                          porta = int
         *                          login = string
         *                          senha = string
         *                          de = array('email', 'nome')
         *                          resposta = array('email', 'nome')
         * @return      json    Mensagem de envio
        **/
        public function enviar_api($titulo, $nome, $email, $link, $dados = array()){
            $url = 'https://api.markttec.com.br/email/conteudo';

            $nome = is_array($nome) ? json_encode($nome) : $nome;
            $email = is_array($email) ? json_encode($email) : $email;

            $campos = array(
                'nome' => urlencode($nome),
            	'email' => urlencode($email),
            	'titulo' => urlencode($titulo),
                'mensagem' => urlencode(file_get_contents(str_replace(' ', '+', $link)))
            );
            if(!empty($dados)) $campos = array_merge($campos, $dados);

            $post = '';
            foreach($campos as $ind => $valor) $post .= $ind.'='.$valor.'&';
            $post = rtrim($post,'&');

            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch,CURLOPT_POST,count($campos));
            curl_setopt($ch,CURLOPT_POSTFIELDS,$post);

            $resultado = curl_exec($ch);
            curl_close($ch);
            return $resultado;
        }
        public static function api($titulo, $nome, $email, $link, $dados = array()){
            $url = 'https://api.markttec.com.br/email/conteudo';

            $nome = is_array($nome) ? json_encode($nome) : $nome;
            $email = is_array($email) ? json_encode($email) : $email;

            $campos = array(
                'nome' => urlencode($nome),
            	'email' => urlencode($email),
            	'titulo' => urlencode($titulo),
                'mensagem' => urlencode(file_get_contents(str_replace(' ', '+', $link)))
            );
            if(!empty($dados)) $campos = array_merge($campos, $dados);

            $post = '';
            foreach($campos as $ind => $valor) $post .= $ind.'='.$valor.'&';
            $post = rtrim($post,'&');

            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch,CURLOPT_POST,count($campos));
            curl_setopt($ch,CURLOPT_POSTFIELDS,$post);

            $resultado = curl_exec($ch);
            curl_close($ch);
            return $resultado;
        }

        public static function padrao($titulo, $nome, $email, $texto){
            $url = 'https://api.markttec.com.br/email/conteudo';

            $nome = is_array($nome) ? json_encode($nome) : $nome;
            $email = is_array($email) ? json_encode($email) : $email;

            $mensagem = '';
            include('app/views/email/padrao.php');

            $campos = array(
                'nome' => urlencode($nome),
            	'email' => urlencode($email),
            	'titulo' => urlencode($titulo),
                'mensagem' => urlencode($mensagem)
            );
            if(!empty($dados)) $campos = array_merge($campos, $dados);

            $post = '';
            foreach($campos as $ind => $valor) $post .= $ind.'='.$valor.'&';
            $post = rtrim($post,'&');

            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch,CURLOPT_POST,count($campos));
            curl_setopt($ch,CURLOPT_POSTFIELDS,$post);

            $resultado = curl_exec($ch);
            curl_close($ch);
            return $resultado;
        }

        public function enviar($dados){
            require 'mail/PHPMailerAutoload.php';
    
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Debugoutput = 'html';
            $mail->Host = 'url@url.com';
            $mail->Port = 465;
            $mail->SMTPSecure = 'ssl';
            $mail->SMTPAuth = true;
            $mail->Username = "nao-responda@cuca.com.br";
            $mail->Password = "nao@1324";
            $mail->setFrom('nao-responda@cuca.com.br', "Cuca");
            $mail->addReplyTo('nao-responda@cuca.com.br', "Cuca");
            $mail->addAddress($dados["email"], $dados["titulo"]);
            $mail->Subject = $dados["titulo"];
            $mail->msgHTML($dados["mensagem"]);
    
            if (!$mail->send()):
                // echo "Mailer Error: " . $mail->ErrorInfo;
                return false;
            else:
                return true;
            endif;
    
        }
    }
