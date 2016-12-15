<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include(APPPATH . '/controllers/Evo_Template.php');

class Evo_Utilities extends Evo_Template {

	private $salt = 'midia9';

	public function logged($dados = array()){

		if ($this->session->userdata('usuario')) {
			return true;
		}
		else {
			$this->load->view('v_login', $dados);
			$this->session->unset_userdata('usuario');
			$this->session->sess_destroy();
			return false;
		}
	}

	public function crypter($text){
		$result = $this->pbkdf2->calc('sha256', $text, md5($this->salt), 1000, strlen($text)*2);
		return base64_encode($result);
	}
	
	public function json($retorno = array()) {
		echo json_encode($retorno);
	}

	public function nivel() {
		return $this->session->usuario->USR_Nivel;
	}

	public function empresa_padrao() {
		return $this->session->usuario->empresa_padrao->EMP_CodigoEmpresa;
	}

	public function enviar_sms($text, $numero) {
		// Get cURL resource
		$text = str_replace(" ", "+", $text);
		$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		curl_setopt_array($curl, array(
		    CURLOPT_URL => 'http://172.246.132.10/app/modulo/api/index.php?action=sendsms&lgn=MIDIA9&pwd=1234&msg=' . $text . '&numbers=' . $numero,
		));
		// Send the request & save response to $resp
		$resp = curl_exec($curl);
		// Close request to clear up some resources
		//echo $resp;
		curl_close($curl);
		//echo curl_getinfo($curl, CURLINFO_EFFECTIVE_URL);
	}

	public function limpa_string($string) {
		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
		return preg_replace('/[^A-Za-z0-9]/', '', $string); // Removes special chars.
	}

	public function enviar_email($para, $dados = array(), $view, $email_empresa, $assunto, $remetente = null){
		$email_view = $this->load->view($view,$dados, true);
		 
		$this->load->library('email');
		$config['protocol'] = 'mail';
		$config['smtp_port'] = 'smtp';
		$config['smtp_host'] = 'server01.midia9.com.br';
		$config['smtp_user'] = 'crm@marketingmidia9.com.br';
		$config['smtp_pass'] = 'server018698';
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$config['wordwrap'] = TRUE;
		$config['smtp_crypto'] = 'ssl';
		$config['priority'] = '1';
		$this->email->initialize($config);

		if ($remetente) {
			$remetente  = $remetente;
		}
		else {
			$remetente = 'Lead Agência Midia9';
		}
		$this->email->from('crm@marketingmidia9.com.br',  @$remetente);
		$this->email->reply_to(@$dados['email']);
		$this->email->to(urldecode(@$para));
		$this->email->cc(urldecode(@$email_empresa)); 
		$this->email->bcc('leads@midia9.com.br, debug@marketingmidia9.com.br'); 
		$this->email->subject($assunto);
		$this->email->message($email_view);	

		$this->email->send();

		var_dump($this->email->print_debugger());
		var_dump(urldecode($email_empresa));
		var_dump(urldecode($para));
	}

	public function atualiza_sessao($sessao,$query = array()){
		$sessao = $query;
		redirect('dashboard','refresh');
	}

 	public function enviar_email_gmail($para, $dados = array(), $view, $email_empresa, $assunto, $remetente = null){
 		$email_view = $this->load->view($view,$dados, true);
		 
		$this->load->library('email');
		$config['protocol'] = 'mail';
		$config['smtp_port'] = '465';
		$config['smtp_host'] = 'ssl://smtp.googlemail.com';
		$config['smtp_user'] = 'leadmidia9@gmail.com';
		$config['smtp_pass'] = 'server018698';
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$config['wordwrap'] = TRUE;
		$config['priority'] = '1';
		$this->email->initialize($config);

		if ($remetente) {
			$remetente  = $remetente;
		}
		else {
			$remetente = 'Lead Agência Midia9';
		}
		$this->email->from('leadmidia9@gmail.com',  $remetente);
		$this->email->reply_to($dados['email']);
		$this->email->to(urldecode($para));
		$this->email->cc(urldecode($email_empresa)); 
		$this->email->bcc('leads@midia9.com.br, debug@marketingmidia9.com.br,leadmidia9@gmail.com'); 
		$this->email->subject($assunto);
		$this->email->message($email_view);	

		$this->email->send();

		var_dump($this->email->print_debugger());
		var_dump(urldecode($email_empresa));
		var_dump(urldecode($para));
		var_dump($config);
 	}

 		public function enviar_email_evobit($para, $dados = array(), $view, $email_empresa, $assunto, $remetente = null){
 		$email_view = $this->load->view($view,$dados, true);
		 
		$this->load->library('email');
		$config['protocol'] = 'smtp';
		$config['smtp_port'] = 587;
		$config['smtp_host'] = 'mx1.weblink.com.br';
		$config['smtp_user'] = 'crm@evobit.org';
		$config['smtp_pass'] = 'server';
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$config['wordwrap'] = TRUE;
		$config['smtp_crypto'] = 'ssl';
		$config['priority'] = '1';
		$this->email->initialize($config);

		if ($remetente) {
			$remetente  = $remetente;
		}
		else {
			$remetente = 'Lead Agência Midia9';
		}
		$this->email->from('crm@evobit.org',  $remetente);
		$this->email->reply_to($dados['email']);
		$this->email->to(urldecode($para));
		$this->email->cc(urldecode($email_empresa)); 
		$this->email->bcc('leads@midia9.com.br,crm@evobit.org,leadmidia9@gmail.com'); 
		$this->email->subject($assunto);
		$this->email->message($email_view);	

		$this->email->send();

		var_dump($this->email->print_debugger());
		var_dump(urldecode($email_empresa));
		var_dump(urldecode($para));
		var_dump($config);
 	}
}
