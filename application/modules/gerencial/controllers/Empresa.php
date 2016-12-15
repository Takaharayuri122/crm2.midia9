<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include(APPPATH . '/controllers/Evo_Utilities.php');

class Empresa extends Evo_Utilities {

	public function index() {
		if ($this->logged()) {
			$this->template('gerencial/v_consulta_empresa', null);
		}
	}

	/*JSON REQUEST FOR ANGULAR*/

	public function getEmpresas($limit = null, $id = null) {
		if ($this->logged()) {
			if ($this->nivel() == '99') {
				$query['nivel'] = $this->nivel();
				$query['grupo'] = $this->db->from('empresa')->where('EMP_CodigoPai', "0")->get()->result();
				if ($id) {
					$query['empresa'] = $this->db->from('empresa')
																				->join('usuario_empresa', 'EMP_CodigoEmpresa = USUE_CodigoEmpresa')
																				->join('usuario', 'USUE_CodigoUsuario = USR_CodigoUsuario')
																				->where('USUE_CodigoUsuario', $this->session->usuario->USR_CodigoUsuario)
																				->where('EMP_CodigoEmpresa', $id)
																				->limit($limit)
															  				->get()
															  				->first_row();
				}
				else {
					$query['empresa'] = $this->db->from('empresa')
																				->join('usuario_empresa', 'EMP_CodigoEmpresa = USUE_CodigoEmpresa')
																				->join('usuario', 'USUE_CodigoUsuario = USR_CodigoUsuario')
																				->where('USUE_CodigoUsuario', $this->session->usuario->USR_CodigoUsuario)
																				->limit($limit)
																				->order_by('EMP_CodigoEmpresa', 'DESC')
															  				->get()
															  				->result();
					/*foreach ($query['empresa'] as $row) {
						$query['empresa']['0']->EMP_Key = $row->EMP_CodigoEmpresa;
					}*/
					for($i=0; $i < count($query['empresa']); $i++) {
						$query['empresa'][$i]->EMP_Key = $this->url_encryptor->encode($query['empresa'][$i]->EMP_CNPJ);
					}
				}
			}
			$this->json($query);
		}
	}

	public function addEmpresa() {
		if ($this->logged()) {
			$dados = $this->input->post();
			$query = $this->db->insert('empresa', $dados);
			if ($query) {
				$this->getEmpresas();
			}
			else {
				$retorno['error'] = true;
			}
		}
	}
}
	
