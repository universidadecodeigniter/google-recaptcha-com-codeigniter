<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()
	{
        // Define as chaves de acesso à API
        $dados['siteKey'] = 'SUA_SITE_KEY';
		$dados['secretKey'] = 'SUA_SECRET_KEY';

        // Verifica se o campo com o código do reCaptcha foi enviado para o servidor
        if ($this->input->post('g-recaptcha-response')) {
            // Faz a instanciação e verificação do reCaptcha
            $recaptcha = new \ReCaptcha\ReCaptcha($dados['secretKey']);
			$resp = $recaptcha->verify($this->input->post('g-recaptcha-response'), $_SERVER['REMOTE_ADDR']);

            // Verifica se o reCaptcha foi preenchido com sucesso
			if ($resp->isSuccess()) {
				echo "reCaptcha validado com sucesso.";
			} else {
				echo "Problemas ao validar o reCaptcha: ". implode(', ', $resp->getErrorCodes());
			}
		} else {
            // Carrega a view para exibição do reCaptcha no browser
            $this->load->view('welcome_message', $dados);
		}
	}
}
