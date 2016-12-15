<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include(APPPATH . '/controllers/Evo_Utilities.php');
class Login extends Evo_Utilities {

  public function index(){
    if ($this->logged()) {
      redirect('dashboard','refresh');
    }
  }

  /*JSON FUNCTIONS*/
  public function auth() {
    if ($_POST) {
      $email = $this->input->post('email');
      $senha = $this->crypter($this->input->post('senha'));

      $query = $this->db->from('usuario')
                        ->where('USR_Email',$email)
                        ->get()
                        ->first_row();
      if ($query) {
        if ($senha == $query->USR_Senha) {

          $empresas = $this->db->from('empresa')
                              ->join('usuario_empresa','EMP_CodigoEmpresa   = USUE_CodigoEmpresa') 
                              ->where('USUE_CodigoUsuario', $query->USR_CodigoUsuario)
                              ->order_by('EMP_CodigoPai')
                              ->get()
                              ->result();

          $empresa = $this->db->from('empresa')
                              ->join('usuario_empresa','EMP_CodigoEmpresa = USUE_CodigoEmpresa') 
                              ->where('USUE_CodigoUsuario', $query->USR_CodigoUsuario)
                              ->where('EMP_CodigoPai', '0')
                              ->group_by('USUE_CodigoEmpresa')
                              ->get()
                              ->first_row();

          $this->session->set_userdata('usuario', $query);
          $this->session->usuario->empresa_padrao = $empresa;
          $this->session->usuario->empresa = $empresas;

          $retorno['success'] = 'Autenticado com Sucesso'; 

        }
        else {
          $retorno['error'] = 'Senha incorreta';  
        }
      }
      else {
        $retorno['error'] = 'E-mail não cadastrado';  
      }
    }
    else {
      $retorno['error'] = 'POST REQUIRED';
    }
    $this->json($retorno);
  }

  public function sair(){
    $this->session->unset_userdata('usuario');
    $this->session->sess_destroy();
    redirect('login','refresh');
  }
}
  
