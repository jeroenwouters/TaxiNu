<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		if($this->session->userdata('logged_in')){
			$data = $this->session->userdata('logged_in');
			if($data['type'] == 'taxi'){
				redirect('admin_taxi');
			}else{
				$this->load->view('v_head_admin');
				$this->load->view('v_admin');
				$this->load->view('v_footer_admin');
			}
			
		}else{
			$this->load->view('v_login');
		}
	}
	
	public function login()
	{
		$this->load->model('m_users');
		$result =  $this->m_users->login($_POST['user'], $_POST['pass']);
		
		if($result)
		{
			$sess_array = array();
			// $this->load->view('v_head_admin');
			// $this->load->view('v_admin');
			// $this->load->view('v_footer_admin');
			$query = $result['query'];
			if($result['type'] == "taxi"){
				foreach($query as $row)
				{
					$sess_array = array(
					'id' => $row->id,
					'username' => $row->Naam,
					'type' => $result['type']
					);
				}
				$this->session->set_userdata('logged_in', $sess_array);
				redirect('admin_taxi');
			}else{
				foreach($query as $row)
				{
					$sess_array = array(
					'id' => $row->pkUsers,
					'username' => $row->Username,
					'type' => $result['type']
					);
				}
				$this->session->set_userdata('logged_in', $sess_array);
				redirect('admin');
			}
		}
		else
		{
			$this->load->view('v_login');
		}
   }
   
   function logout()
   {
   $this->session->unset_userdata('logged_in');
   redirect('admin', 'refresh');
   }
  
   public function getuser()
	{
		if($this->session->userdata('logged_in')){
			$data = $this->session->userdata('logged_in');
			$this->load->model('m_taxis');
			$query = $this->m_taxis->get($data['id']);
			foreach ($query->result() as $r) {
				$data['fkUser'] = $r->fkUser;
			}
			echo json_encode($data);
		}else{
			$this->load->view('v_login');
		}
	}

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */