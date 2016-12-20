<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include(APPPATH . '/controllers/Evo_Utilities.php');

class Usuario extends Evo_Utilities {
	public function index() {
		if ($this->logged()) {
			$this->template('gerencial/v_usuario', null);
		}
	}

	/*JSON REQUEST FOR ANGUAR*/

	public function getUsuario($limit = null, $id = null) {
		if ($this->logged()) {
			$query['nivel'] = $this->nivel();
			$query['empresa'] = $this->session->usuario->empresa_padrao;
			if ($id) {
				if($this->nivel() == "99") {
					$query['usuarios'] = $this->db->from('usuario')
												->join('usuario_empresa', 'EMP_CodigoEmpresa = USUE_CodigoEmpresa')
												->join('usuario', 'USUE_CodigoUsuario = USR_CodigoUsuario')
												->where('USUE_CodigoEmpresa', $this->session->usuario->empresa_padrao->EMP_CodigoEmpresa)
												->where('USR_CodigoUsuario', $id)
												->limit($limit)
							  				->get()
							  				->first_row();
				}
			}
			else {
				if($this->nivel() == "1") {
					$query['usuarios'] = $this->db->from('usuario')
												->join('usuario_empresa', 'EMP_CodigoEmpresa = USUE_CodigoEmpresa')
												->join('usuario', 'USUE_CodigoUsuario = USR_CodigoUsuario')
												->where('USUE_CodigoEmpresa', $this->session->usuario->empresa_padrao->EMP_CodigoEmpresa)
												->where_not_in('USR_Nivel', '99')
												->limit($limit)
												->group_by('USR_CodigoUsuario')
												->order_by('USR_CodigoUsuario', 'DESC')
							  				->get()
							  				->result();
				}

				if($this->nivel() == "99") {
					$query['usuarios'] = $this->db->select('USR_Ativo, USR_Celular, USR_CodigoEmpresa, USR_CodigoUsuario, USR_Email, USR_Fila, USR_Foto, USR_Nivel, USR_Nome, USR_ReceberEmail, USR_ReceberRelatorioSMS, USR_ResetarSenha, USR_Status, USR_Telefone, EMP_RazaoSocial')
												->from('empresa')
												->join('usuario_empresa', 'EMP_CodigoEmpresa = USUE_CodigoEmpresa')
												->join('usuario', 'USUE_CodigoUsuario = USR_CodigoUsuario')
												->limit($limit)
												->group_by('USR_CodigoUsuario')
												->order_by('USR_CodigoUsuario', 'DESC')
								  			->get()
								  			->result();
				}
			}
			$this->json($query);
		}
	}

	public function addUsuario() {
		if ($this->logged()) {
			$dados = $this->input->post();

			$dados['USR_Celular'] = $this->limpa_string($dados['USR_Celular']);
			if (@$dados['USR_Senha']) $dados['USR_Senha'] = $this->crypter($dados['USR_Senha']);
			if (!@$dados['USR_Senha']) $dados['USR_Senha'] = $this->crypter('midia@123');
			$dados['USR_Fila'] = 0;
			$dados['USR_ResetarSenha'] = 0;
			$dados['USR_ReceberRelatorioSMS'] = 1;
			$dados['USR_Ativo'] = 1;
			$dados['USR_ReceberEmail'] = 1;

			$query = $this->db->insert('usuario', $dados);
			if ($query) {
				$dados2['USUE_CodigoUsuario'] = $this->db->insert_id();
				$dados2['USUE_Nivel'] = $dados['USR_Nivel'];
				$dados2['USUE_CodigoEmpresa'] = $this->session->usuario->empresa_padrao->EMP_CodigoEmpresa;
				
				$query = null;

				$query = $this->db->insert('usuario_empresa', $dados2);
				if ($query) {
					$retorno['success'] = true;
				}
				else {
					$retorno['error'] = 'Impossivel adicionar usuário a empresa';
					$this->json($retorno);
				}
			}
			else {
				$retorno['error'] = 'Impossivel adicionar usuário';
				$this->json($retorno);
			}
		}
	}

	public function setStatus($id, $status) {
		if($this->logged()) {
			$query = $this->db->where('USR_CodigoUsuario', $id)
					 		  ->update('usuario',array('USR_Status' => $status));
			if ($query) {
				$retorno['success'] = true;
			}
			else {
				$retorno['error'] = true;
			}
			$this->json($retorno);
		}
	}

	public function update() {
		$dados = $this->input->post();
		if (@$dados['USR_Senha']) $dados['USR_Senha'] = $this->crypter($dados['USR_Senha']);

		$query = $this->db->where('USR_CodigoUsuario', $dados['USR_CodigoUsuario'])
						  ->update('usuario', $dados);
	}
}