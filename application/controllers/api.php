<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic bestelling interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class Api extends REST_Controller
{
	function bestelling_get()  
    {  
        
        $this->load->model('m_bestellingen');
        
        if($this->uri->segment(3) == ""){
	         $query = $this->m_bestellingen->get_all(); 
        }else{
        	$query = $this->m_bestellingen->get( $this->uri->segment(3));
        }
        
        $this->load->model('m_status');
        foreach($query->result() as $r){
        		$status = $this->m_status->getstatusbyuser($r->id);
        			$bestelling[] = array('id' => $r->id, 'adres1' => $r->Adres1, 'adres2' => $r->Adres2, 'afstand' => $r->Afstand, 'tijd' => $r->Tijd, 'personen' => $r->Personen, 'naam' => $r->Naam, 'email' => $r->Email, 'tel' => $r->Tel, 'status' => $status['status'], 'afgerond' => $r->Afgerond, 'taxi' => $status['taxi']);
		}
         
        echo json_encode($bestelling);
    } 
    
    function bestelling_put()
    {    
    	$data = $this->request->body;
    	$status['fkBestelling'] = $data['id'];
    	$status['Status'] = $data['status'];
    	$status['Wachttijd'] = $data['wachttijd'];
        $status['fkTaxi'] = $data['taxi'];
    	
    	$sessiondata = $this->session->userdata('logged_in');
    	
    	$status['fkUser'] = $sessiondata['id'];
		
		$this->load->model('m_status');
		$return = $this->m_status->insert($status);
		$status['Username'] = $sessiondata['username'];

		
        $this->load->model('m_bestellingen');
        $query = $this->m_bestellingen->getbyid($data['id']);
        foreach($query->result() as $r){
            $bestelling['id'] = $r->id;
            $bestelling['adres1'] = $r->Adres1;
            $bestelling['adres2'] = $r->Adres2;
            $bestelling['tijd'] = $r->Tijd; 
            $bestelling['personen'] = $r->Personen; 
            $bestelling['naam'] = $r->Naam; 
            $bestelling['tel'] = $r->Tel; 
            $bestelling['status'] = $r->Status; 
            $bestelling['afgerond'] = $r->Afgerond; 
            $bestelling['taxi'] = $r->fkTaxi;
            $bestelling['afstand'] = $r->Afstand;
            $bestelling['notif_email'] = $r->notif_email;
            $bestelling['email'] = $r->Email;
            $bestelling['regid'] = $r->regid;
        }
        $this->load->library('pusher');
        if($return == "new"){
            $this->pusher->trigger('client', 'client_'.$data['id'], $status);
            if($bestelling['notif_email'] == 1){
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

                $this->email->from(' 23ste.dropping@gmail.com', 'Taxinu');
                $this->email->to( $bestelling['email']);
                $this->email->subject('Taxinu bestelling');
                $message = $this->load->view('v_mail_bestelling',$bestelling,TRUE);
                //$this->email->message('<a href="'.base_url().'home/aanvragen/'.$bestelling['id'].'"/>klik hier</a>');
                $this->email->message($message);
                $this->email->send();
                
            }
            if($bestelling['regid'] != ""){
                $this->load->library('gcm');
                $this->gcm->setMessage('Taxi aanvraag van '.$status['Username']);
                $this->gcm->addRecepient($bestelling['regid']);
                $status['type'] = "aanvraag";
                $this->gcm->setData($status);
                 // then send
                $this->gcm->send();
            }

        }
        $this->pusher->trigger('admin_all', 'taxi_'.$data['taxi'], $bestelling);
        $destory['id'] = $bestelling['id'];
        $destory['nieuwtaxi'] = $data['taxi'];
        $this->pusher->trigger('admin_all', 'taxi_destroy_'.$data['taxioud'], $destory);
    } 	
    
    function bestelling_post()
    {
	    $data = $this->request->body;
	    $this->load->model('m_bestellingen');
	    $this->m_bestellingen->insert($data);
    }	
    
    function bestelling_delete()
    {
        $data = $this->request->body;
	    // $this->load->model('m_status');
	    // $this->m_status->delete();
    }
    /*
    function bestellingen_get()
    {
        $this->load->model('m_bestellingen');
        $query = $this->m_bestellingen->get_all();
        
        foreach($query->result() as $r){
        $bestellingen[] = array('id' => $r->id, 'adres1' => $r->Adres1, 'adres2' => $r->Adres2, 'tijd' => $r->Tijd, 'Personen' => $r->Personen);
		}
		                
		echo json_encode($bestellingen);
    }
    */
    function taxi_get()  
    {  
        $this->load->model('m_taxis');
        
        $query = $this->m_taxis->get( $_GET['userid']);
        
        foreach($query->result() as $r){
            $taxis[] = array('id' => $r->id, 'fkuser' => $r->fkUser, 'Login' => $r->Login, 'Naam' => $r->Naam, 'Pauze' => $r->pauze);
        }

        echo json_encode($taxis);
    } 

    function taxi_post()
    {
        $data = $this->request->body;
        $this->load->model('m_taxis');
        $this->m_taxis->insert($data);
    }   

    function taxi_put(){
        $data = $this->request->body;
        $data2['Naam'] = $data['Naam'];
        $this->load->model('m_taxis');
        $this->m_taxis->update($data2, $data['id']);
    }

    function taxi_delete(){
        $this->load->model('m_taxis');
        $this->m_taxis->delete($this->uri->segment('3'));  
    }

    function ritten_get()
    {
        $this->load->model('m_bestellingen');
        $query = $this->m_bestellingen->getbytaxi($_GET['userid']);
        foreach($query->result() as $r){
            $bestelling[] = array('id' => $r->id, 'adres1' => $r->Adres1, 'adres2' => $r->Adres2, 'afstand' => $r->Afstand, 'tijd' => $r->Tijd, 'personen' => $r->Personen, 'naam' => $r->Naam, 'email' => $r->Email,'regid' => $r->regid, 'tel' => $r->Tel, 'status' => $r->Status, 'afgerond' => $r->Afgerond, 'taxi' => $r->fkTaxi);
        }
        echo json_encode($bestelling);
    }

    function ritten_put()
    {
         $data = $this->request->body;
         
             $status['Status'] = $data['status'];
             $this->load->model('m_status');
             $this->m_status->update($status, $data['id'], $data['userid']);
          if($data['status'] == 4 || $data['status'] == 5 ){
             $status['id'] = $data['id'];
             $this->pusher->trigger('admin_all', 'admin_'.$data['userid'], $status);
          }

    }

    function phonegapBestelling_post(){
        $data = $this->request->body;

        $tijd = $data['Tijd'];
        $data['Tijd'] = substr($tijd, 6, 4).'-'.substr($tijd, 3, 2).'-'.substr($tijd, 0, 2).' '.substr($tijd, 11, 5);

        $this->load->model('m_bestellingen');
        $data['id'] = $this->m_bestellingen->insertbestelling($data);
        $data['adres1'] = $data['Adres1'];
        $data['adres2'] = $data['Adres2'];
        $data['tijd'] = $data['Tijd'];
        $data['naam'] = $data['Naam'];
        $data['email'] = $data['Email'];
        $data['tel'] = $data['Tel'];
        $data['personen'] = $data['Personen'];
        $data['status'] = 1;
        $data['taxi'] = 0;
        $this->load->library('pusher');
        $this->pusher->trigger('admin_all', 'taxi_bestelt', $data);

        echo json_encode($data['id']);
    }

    function klant_put(){
        $data = $this->request->body;
        $this->load->model('m_klanten');
        $data['pass'] = md5($data['pass']);
        $this->m_klanten->update($data['id'], $data);
    }

    function phonegapHistorie_get(){
        $this->load->model('m_bestellingen');
        $query = $this->m_bestellingen->getbyemail($_GET['email']);
        $idbefore = 0;
        foreach($query->result() as $r){
        	if($r->fkBestelling != $idbefore){
            $data[] = array(
                'Username' => $r->Username,
                'Adres1' => $r->Adres1,
                'Adres2' => $r->Adres2,
                'Tijd' => $r->Tijd,
                'Personen' => $r->Personen,
                'Naam' => $r->Naam,
                'Email' => $r->Email,
                'Tel' => $r->Tel,
                'Afgerond' => $r->Afgerond,
                'fkBestelling' => $r->fkBestelling,
                'fkUser' => $r->fkUser,
                'Status' => $r->Status,
                'id' => $r->id
            );
            $idbefore = $r->fkBestelling;
            }
              
        }

        echo json_encode($data);
    }
    
    function phonegapAanvragen_get(){
	    $this->load->model('m_bestellingen');
        $query = $this->m_bestellingen->getaanvragen($_GET['id']);
        foreach($query->result() as $r){
            $data[] = array(
                'Username' => $r->Username,
                'Adres1' => $r->Adres1,
                'Adres2' => $r->Adres2,
                'Tijd' => $r->Tijd,
                'Personen' => $r->Personen,
                'Naam' => $r->Naam,
                'Email' => $r->Email,
                'Tel' => $r->Tel,
                'Afgerond' => $r->Afgerond,
                'fkBestelling' => $r->fkBestelling,
                'fkUser' => $r->fkUser,
                'Status' => $r->Status, 
                'Wachttijd' => $r->Wachttijd,
            );
        }

        echo json_encode($data);
    }
    
    

}