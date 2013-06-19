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
			}

			if($data['type'] == 'klant'){
				redirect('home/user');
			}
			
			if($data['type'] == 'admin'){
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
			}

			if($result['type'] == "admin"){
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

			if($result['type'] == "klant"){
				foreach($query as $row)
				{
					$sess_array = array(
					'id' => $row->id,
					'username' => $row->email,
					'type' => $result['type']
					);
				}
				$this->session->set_userdata('logged_in', $sess_array);
				redirect('home/user');
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

   function sendgcm(){
   	$this->load->library('gcm');
   	$this->gcm->setMessage('Test message '.date('d.m.Y H:s:i'));
   	$this->gcm->addRecepient('APA91bFZHKeyhDd8Hu8dC80p4TUgC1xLvKmYmNRjJMvp1vhuyr9yLHfYJY-3Y9kbW5qHkyZtUdbxJlv9qegZf8b6fLlO5m5HgTYQCwKwfF7dLGS69L1wbwJgM2XF3BeKE63BA78mAR9IGXutXpbLip8aPQhgiyo3WQ');
   	$this->gcm->setData(array(
        'some_key' => 'some_val'
    ));
     // then send
        if ($this->gcm->send())
            echo 'Success for all messages';
        else
            echo 'Some messages have errors';

    // and see responses for more info
        print_r($this->gcm->status);
        print_r($this->gcm->messagesStatuses);
   }

   function insertgcm(){
   	$this->db->insert('gcm', $_POST);
   }
  
   public function getuser()
	{
		if($this->session->userdata('logged_in')){
			$data = $this->session->userdata('logged_in');
			$this->load->model('m_taxis');
			$query = $this->m_taxis->getbyid($data['id']);
			foreach ($query->result() as $r) {
				$data['fkUser'] = $r->fkUser;
			}
			echo json_encode($data);
		}else{
			$this->load->view('v_login');
		}
	}

	 function cancelorderadmin(){
        $this->load->model('m_status');
        $this->m_status->delete($this->uri->segment(3), $this->uri->segment(4));
        $this->pusher->trigger('client', 'client_remove'.$this->uri->segment(3), $this->uri->segment(3));
    }
    
    function phoengapcheckdubbel(){
	    $this->load->model('m_bestellingen');
        $query = $this->m_bestellingen->getbyemail($_POST['email']);
        $data = "false";
        foreach($query->result() as $r){
        	if($r->Status == 3 || $r->Afgerond == 0){
	        	$data = "true";
        	}
        }
        
        echo json_encode($data);
    }

    function bestellingtoevoegen(){
    	$data1['Naam'] = $_POST['naam'];
		$data1['Tel'] = $_POST['tel'];
		$data1['Adres1'] = $_POST['adres1'];
		$data1['Adres2'] = $_POST['adres2'];
		$tijd = $_POST['tijd'];
		$data1['tijd'] = substr($tijd, 6, 4).'-'.substr($tijd, 3, 2).'-'.substr($tijd, 0, 2).' '.substr($tijd, 11, 5);
		$data1['Afgerond'] = $_POST['afgerond'];

    	$this->load->model('m_bestellingen');
    	$data2['fkBestelling'] = $this->m_bestellingen->insert($data1);
    	
    	$data2['fkUser'] = $_POST['fkUser'];
    	$data2['Status'] = $_POST['status'];
    	$data2['fkTaxi'] = $_POST['taxi'];

    	$this->load->model('m_status');
    	$this->m_status->insertnew($data2);

    	$data1['fkUser'] = $_POST['fkUser'];
    	$data1['Status'] = $_POST['status'];
    	$data1['fkTaxi'] = $_POST['taxi'];

    	$this->load->library('pusher');
    	$this->pusher->trigger('admin_all', 'taxi_'.$data2['fkTaxi'], $_POST);

    	echo json_encode($data2);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */