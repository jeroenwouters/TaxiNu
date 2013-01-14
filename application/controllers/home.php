<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

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
		$this->load->view('v_head');
		$this->load->view('v_header_home');
		$this->load->view('v_info');
		$this->load->view('v_footer');
	}
	
	public function detail()
	{
		$this->load->view('v_head');
		$this->load->view('v_header_detail', $_POST);
		$this->load->view('v_info');
		$this->load->view('v_footer');
	}
	
	public function besteltaxi()
	{
		$tijd = $_POST['tijd'];
		$_POST['tijd'] = substr($tijd, 6, 4).'-'.substr($tijd, 0, 2).'-'.substr($tijd, 3, 2).' '.substr($tijd, 11, 5);
		
		$this->load->model('m_bestellingen');
		
		
		$_POST['id'] = $this->m_bestellingen->insertbestelling($_POST);
		$data['id'] = $_POST['id'];
		
		$this->load->library('pusher');
		$this->pusher->trigger('admin_all', 'taxi_bestelt', $_POST);

		$this->load->view('v_pending', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */