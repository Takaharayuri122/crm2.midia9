<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include(APPPATH . '/controllers/Evo_Utilities.php');

class Dashboard extends Evo_Utilities {

	public function index() {
		if ($this->logged()) {
			$this->template('dashboard/v_home', null);
		}
	}

	/*JSON REQUESTS FOR ANGULAR*/
	public function getDashboardInfos() {
		if ($this->logged()) {
			if ($this->nivel() == '99') {
			/*Verificando se a Empresa é a Midia9*/
				if ($this->empresa_padrao() == '1') {
					$query['le_recebidos'] = $this->db->count_all_results('lead');
					$query['le_finalizados'] = $this->db->where('LE_Status', '4')->count_all_results('lead');
					$query['le_aberto'] = $this->db->where('LE_Status', '0')->count_all_results('lead');
					$query['le_negociacao'] = $this->db->where('LE_Status', '1')->count_all_results('lead');
					$query['le_perdida'] = $this->db->where('LE_Status', '2')->count_all_results('lead');
					$query['le_efetivada'] = $this->db->where('LE_Status', '4')->count_all_results('lead');
					$query['le_hoje'] = $this->db->where('LE_Data', Date('Y-m-d'))->count_all_results('lead');
				}
			}
			$this->json($query);
		}
	}

}
