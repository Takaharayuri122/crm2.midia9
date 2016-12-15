<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evo_Template extends CI_Controller {

	public function template($content, $dados = array()) {

		$dados['header'] = $this->load->view('v_header',$dados, true);
		$dados['menu'] = $this->load->view('v_menu',$dados, true);
		$dados['content'] = $this->load->view($content ,$dados, true);
		$this->load->view('v_main',$dados);
	}

}
