<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_taxi extends CI_Controller {

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
				$this->load->view('v_head_admin_mobile');
				$this->load->view('v_admin_mobile');
				$this->load->view('v_footer_admin_mobile');

			}else{
				redirect('admin');
			}
		}else{
			redirect('admin');
		}
	}

	function gcmloc(){
		$this->load->library('gcm');
		$this->gcm->setMessage('location');
		foreach ($_POST['regid'] as $r) {
			$this->gcm->addRecepient($r);
		} 
		$loc['lat'] = $_POST['lat'];
		$loc['lang'] = $_POST['lang'];
		$loc['type'] = "loc";
		var_dump($loc);
		$this->gcm->setData($loc);
           // then send
		$this->gcm->send();
	}

	function getpauze(){
		$this->load->model('m_taxis');
		$query = $this->m_taxis->getbyid($this->uri->segment(3));
		foreach ($query->result() as $r) {
			echo json_encode($r);
		}
		
	}

	function pauze(){
		$this->load->model('m_taxis');
		$this->m_taxis->update($_POST, $_POST['id']);
		$this->load->library('pusher');
		$this->pusher->trigger('taxi_'.$_POST['id'], 'taxi_pauze_'.$_POST['id'], $_POST);
	}
}	
