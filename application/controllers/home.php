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
		
		$_POST['status'] = 1;
		$_POST['taxi'] = 0;
		$this->load->library('pusher');
		$this->pusher->trigger('admin_all', 'taxi_bestelt', $_POST);
		
		redirect('home/aanvragen/'.$_POST['id']);
		}
	}

	public function aanvragen(){
		$data['id'] = $this->uri->segment(3);
		$this->load->model('m_bestellingen');
		$data['query'] = $this->m_bestellingen->getbyid($data['id']);
		$this->load->view('v_head');
		$this->load->view('v_pending', $data);
		$this->load->view('v_footer');
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
		$status['id'] = $this->uri->segment(3);
		$status['status'] = 3;
		$this->pusher->trigger('admin_all', 'admin_'.$this->uri->segment(4), $status);
		$this->pusher->trigger('admin_all', 'delete', $datapush);
		
		$taxi = $this->m_status->gettaxi($this->uri->segment(3), $this->uri->segment(4));
		$this->pusher->trigger('admin_all', 'green_taxi_'.$taxi, $this->uri->segment(3));

		$this->m_status->delete_over($this->uri->segment(3), $this->uri->segment(4));
		
		$email_config = Array(
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => '465',
            'smtp_user' => '23ste.dropping@gmail.com',
            'smtp_pass' => 'negerballen',
            'mailtype'  => 'html',
            'starttls'  => true,
            'newline'   => "\r\n"
         );

         $this->load->library('email', $email_config);
         $query = $this->m_bestellingen->get($this->uri->segment(3));
         foreach ($query->result() as $r) {
         	$email = $r->Email;
         }
         $this->email->from(' 23ste.dropping@gmail.com', 'Taxinu');
         $this->email->to($email);
         $this->email->subject('Taxinu volg taxi');
         $this->email->message('<a href="'.base_url().'home/volgtaxi/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'"/>klik hier</a>');

          $this->email->send();

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

    function user(){
    	$this->load->view('v_head');
		$this->load->view('v_user');
		$this->load->view('v_footer');
    }

    function setemail(){
    	$data['notif_email'] = 1;
    	$this->load->model('m_bestellingen');
    	$this->m_bestellingen->update($data, $_POST['id']);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */