<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include(APPPATH . '/controllers/Evo_Utilities.php');

class Lead extends Evo_Utilities {

	public function index() {
		if ($this->logged()) {
			$this->template('marketing/v_leads', null);
		}
	}

	public function getLeads($limit = null, $id = null) {
		if ($this->logged()) {
			if ($id) {

			}
			else {
				$query['nivel'] = $this->nivel();
				$query['empresas'] = $this->db->from('empresa')
																			->join('usuario_empresa', 'EMP_CodigoEmpresa = USUE_CodigoEmpresa')
																			->group_by('EMP_CodigoEmpresa')
																			->where('EMP_CodigoPai <>', 0)
																			->get()
																			->result();

				$query['filtro_produto'] = $this->db->from('produto')
																					  ->distinct('PRO_Nome')
																					  ->get()
																					  ->result();
				$query['filtro_tipo'] = $this->db->from('lead_tipo')
																				 ->get()
																				 ->result();

				$query['leads'] = $this->db->from('lead')
													->join('produto', 'LE_CodigoProduto = PRO_CodigoProduto')
													->join('usuario', 'LE_CodigoUsuario = USR_CodigoUsuario')
													->join('lead_tipo', 'LE_CodigoTipo = LET_CodigoTipo','LEFT')
													->join('empresa', 'LE_CodigoEmpresa = EMP_CodigoEmpresa')
													->limit($limit)
													->order_by('LE_CodigoLead', 'DESC')
													->get()
													->result();

				$query['interacoes'] = $this->db->from('lead')
																				->join('interacao', 'INT_CodigoLead = LE_CodigoLead', 'LEFT')
																				->join('produto', 'LE_CodigoProduto = PRO_CodigoProduto')
																				->join('usuario', 'INT_CodigoUsuario = USR_CodigoUsuario')
																				->join('lead_tipo', 'LE_CodigoTipo = LET_CodigoTipo','LEFT')
																				->join('empresa', 'LE_CodigoEmpresa = EMP_CodigoEmpresa')
																				->get()
																				->result();
					
			}
			$this->json($query);
		}
	}

	public function addLead() {
		if ($this->logged()) {
			if ($_POST) {
				$dados = $this->input->post();
				$dados['LE_CodigoUsuario'] = $this->session->usuario->USR_CodigoUsuario;
				if(!$dados['LE_CodigoEmpresa']) {
					$dados['LE_CodigoEmpresa'] = $this->session->usuario->empresa_padrao->EMP_CodigoEmpresa;
				}
				$dados['LE_Data'] = Date('Y-m-d');
				$dados['LE_Hora'] = Date('H:i:s');

				$query = $this->db->insert('lead', $dados);

				if ($query) {
					$this->getLeads(99);
				}
				else {
					$retorno['error'] = 'Não foi possivel salvar o Lead';
				}
			}
			else {
				$retorno['error'] = 'Server: POST REQUIRED';
			}
		}
	}

	public function setStatusLead($id, $status, $message = null) {
		if ($this->logged()) {
			if ($id) {
				$query = $this->db->where('LE_CodigoLead', $id)
								 					->update('lead', array('LE_Status' => $status));
				if ($query) {
					$retorno['success'] = true;
					if ($message == 'undefined') {
						$message = 'Atualizou Status';
					}
					$this->interacao($id, $message, $status);
				}
				else {
					$retorno['error'] = true;
				}
			}
			else {
				$retorno['error'] = 'ID Required';
			}
			$this->json($retorno);
		}
	}

	public function interacao($id, $msg, $status) {
		if($this->logged()){
			$dados['INT_CodigoLead'] = $id;
			$dados['INT_CodigoUsuario'] = $this->session->usuario->USR_CodigoUsuario;
			$dados['INT_Data'] = Date('Y-m-d');
			$dados['INT_Hora'] = Date('H:i:s');
			$dados['INT_Mensagem'] = urldecode($msg);
			$dados['INT_Status'] = $status;
			$dados['INT_CodigoEmpresa'] = $this->session->usuario->empresa_padrao->EMP_CodigoEmpresa;

			$query = $this->db->insert('interacao', $dados);

		}	
	}
}
