<?php
class M_bestellingen extends CI_Model {
	
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_all(){
    	$query = $this->db->get('tblBestellingen');
	    return($query);
    }
    
    function get($id){
	    $this->db->where('id', $id);
	    $query = $this->db->get('tblBestellingen');
	    return($query);
    }
    
    function update($data, $id){
	    $this->db->where('id', $id);
	    $this->db->update('tblBestellingen', $data);
	    return(TRUE);
    }
    
    function insert($data){
		$this->db->insert('tblBestellingen', $data);
	}
	
	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete('tblBestellingen');
	}
	
	function insertbestelling($data){
		$this->db->insert('tblBestellingen', $data);
		
		return($this->db->insert_id());
	}

	function getbytaxi($id){
		$this->db->select('*');
		$this->db->from('tblStatus');
		$this->db->join('tblBestellingen', 'tblBestellingen.id = tblStatus.fkBestelling');
		$this->db->where('fkTaxi', $id);
		$query = $this->db->get();
		return($query);
	}

	function getbyid($id){
		$this->db->select('*');
		$this->db->from('tblStatus');
		$this->db->join('tblBestellingen', 'tblBestellingen.id = tblStatus.fkBestelling');
		$this->db->join('tblUsers', 'tblStatus.fkUser = tblUsers.pkUsers');
		$this->db->where('tblBestellingen.id', $id);
		$query = $this->db->get();
		return($query);
	}

}