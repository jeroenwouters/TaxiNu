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
        
        foreach($query->result() as $r){
        $bestelling[] = array('id' => $r->id, 'adres1' => $r->Adres1, 'adres2' => $r->Adres2, 'tijd' => $r->Tijd, 'personen' => $r->Personen, 'naam' => $r->Naam, 'email' => $r->Email, 'tel' => $r->Tel, 'status' => $r-> Status);
		}
         
        echo json_encode($bestelling);
    } 
    
    function bestelling_put()
    {    
    	$data = $this->request->body;
    	$id = $data['id'];
	    $this->load->model('m_bestellingen');
	    $this->m_bestellingen->update($data, $id);
	    if($data['status'] == 2){
		    $this->load->library('pusher');
		    $sessiondata = $this->session->userdata('logged_in');
		    $databedrijf = $sessiondata['username'];
		    $this->pusher->trigger('client', 'client_'.$id, $databedrijf);
	    }
    } 	
    
    function bestelling_post()
    {
	    $data = $this->request->body;
	    $this->load->model('m_bestellingen');
	    $this->m_bestellingen->insert($data);
    }	
    
    function bestelling_delete()
    {
	    $this->load->model('m_bestellingen');
	    $this->m_bestellingen->delete($this->uri->segment(3));
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
}