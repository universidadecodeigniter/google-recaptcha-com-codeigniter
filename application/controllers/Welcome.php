<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$dados['siteKey'] = 'SUA_SITE_KEY';
		$dados['secretKey'] = 'SUA_SECRET_KEY';

		if ($this->input->post('g-recaptcha-response')) {
			$recaptcha = new \ReCaptcha\ReCaptcha($dados['secretKey']);
			$resp = $recaptcha->verify($this->input->post('g-recaptcha-response'), $_SERVER['REMOTE_ADDR']);

			if ($resp->isSuccess()) {
				echo "reCaptcha validado com sucesso.";
			} else {
				echo "Problemas ao validar o reCaptcha: ". implode(', ', $resp->getErrorCodes());
			}
		} else {
			$this->load->view('welcome_message', $dados);
		}
	}
}
