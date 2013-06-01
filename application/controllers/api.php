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

		$this->load->library('pusher');
        if($return == "new"){
		  $this->pusher->trigger('client', 'client_'.$data['id'], $status);
        }
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
            $taxis[] = array('id' => $r->id, 'fkuser' => $r->fkUser, 'Login' => $r->Login, 'Naam' => $r->Naam);
        }

        echo json_encode($taxis);
    } 

    function taxi_post()
    {
        $data = $this->request->body;
        $this->load->model('m_taxis');
        $this->m_taxis->insert($data);
    }   

    function ritten_get()
    {
        $this->load->model('m_bestellingen');
        $query = $this->m_bestellingen->getbytaxi($_GET['userid']);
        foreach($query->result() as $r){
            $bestelling[] = array('id' => $r->id, 'adres1' => $r->Adres1, 'adres2' => $r->Adres2, 'afstand' => $r->Afstand, 'tijd' => $r->Tijd, 'personen' => $r->Personen, 'naam' => $r->Naam, 'email' => $r->Email, 'tel' => $r->Tel, 'status' => $r->Status, 'afgerond' => $r->Afgerond, 'taxi' => $r->fkTaxi);
        }
        echo json_encode($bestelling);
    }

    function ritten_put()
    {
         $data = $this->request->body;
         $status['status'] = $data['status'];
         $this->load->model('m_status');
         $this->m_status->update($status, $data['id'], $data['userid']);
         $status['id'] = $data['id'];
        $this->pusher->trigger('admin_all', 'admin_'.$data['userid'], $status);
    }

}