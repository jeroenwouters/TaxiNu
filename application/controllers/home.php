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
		//$this->load->view('v_info');
		$this->load->view('v_footer');
	}
	
	public function detail()
	{
		$config = array(
               array(
                     'field'   => 'adres1', 
                     'label'   => 'Vertrekplaats', 
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'adres2', 
                     'label'   => 'Bestemming', 
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'tijd', 
                     'label'   => 'Tijd', 
                     'rules'   => 'required'
                  )
          );
        $this->form_validation->set_rules($config);
        		
		if ($this->form_validation->run() == FALSE)
		{
			$_POST['error'] = validation_errors();
			$this->session->set_flashdata('val_home', $_POST);
			redirect('');
		}else{			
			$this->load->view('v_head');
			$this->load->view('v_header_detail', $_POST);
			//$this->load->view('v_info');
			$this->load->view('v_footer');
		}
		
	}
	
	
	public function besteltaxi()
	{
		$config = array(
               array(
                     'field'   => 'adres1', 
                     'label'   => 'Vertrekplaats', 
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'adres2', 
                     'label'   => 'Bestemming', 
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'tijd', 
                     'label'   => 'Tijd', 
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'personen', 
                     'label'   => 'Personen', 
                     'rules'   => 'required'
                  )	
          );
        $this->form_validation->set_rules($config);
        		
		if ($this->form_validation->run() == FALSE)
		{
			$_POST['adres1'] = set_value('adres1');
			$_POST['adres2'] = set_value('adres2');
			$_POST['tijd'] = set_value('tijd');
			
			$this->load->view('v_head');
			$this->load->view('v_header_detail',$_POST);
			//$this->load->view('v_info');
			$this->load->view('v_footer');
		}else{
		$tijd = $_POST['tijd'];
		$_POST['tijd'] = substr($tijd, 6, 4).'-'.substr($tijd, 3, 2).'-'.substr($tijd, 0, 2).' '.substr($tijd, 11, 5);
		
		$this->load->model('m_bestellingen');
		
		
		$_POST['id'] = $this->m_bestellingen->insertbestelling($_POST);
		$data['id'] = $_POST['id'];
		$_POST['status'] = 1;
		$_POST['taxi'] = 0;
		$this->load->library('pusher');
		$this->pusher->trigger('admin_all', 'taxi_bestelt', $_POST);
		
		$this->load->view('v_head');
		$this->load->view('v_pending', $data);
		//$this->load->view('v_info');
		$this->load->view('v_footer');
		}
	}
	
	public function bevestig()
	{
		$data['Status'] = 3;
		$this->load->model('m_status');
		$this->m_status->update($data, $this->uri->segment(3), $this->uri->segment(4));
		
		$data2['Afgerond'] = 1;
		$this->load->model('m_bestellingen');
		$this->m_bestellingen->update($data2, $this->uri->segment(3));
		
		$this->load->library('pusher');
		$datapush['idbestelling'] = $this->uri->segment(3);
		$datapush['iduser'] = $this->uri->segment(4);
		$this->pusher->trigger('admin_all', 'admin_'.$this->uri->segment(4), $this->uri->segment(3));
		$this->pusher->trigger('admin_all', 'delete', $datapush);
		
		// $this->load->view('v_head');
		// $this->load->view('v_taxibesteld');
		//$this->load->view('v_info');
		// $this->load->view('v_footer');
		redirect('home/volgtaxi/'.$this->uri->segment(3).'/'.$this->uri->segment(4));
	}

	public function volgtaxi(){
		$this->load->model('m_status');
		$data['taxi'] = $this->m_status->gettaxi($this->uri->segment(3), $this->uri->segment(4));

		$this->load->view('v_head');
		$this->load->view('v_taxibesteld', $data);
		$this->load->view('v_footer');
	}

	 function register(){
        $this->load->model('m_klanten');
        $_POST['pass'] = md5($_POST['pass']);
        $this->m_klanten->insert($_POST);
     }

    function login(){
    	$this->load->model('m_klanten');

    	$data =  $this->m_klanten->login($_POST['username'], $_POST['password']);
	    if($data){
	    	echo json_encode($data);
	    }else{
	    	echo json_encode("false");
	    }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */