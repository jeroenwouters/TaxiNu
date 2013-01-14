<?php
class M_bestellingen extends CI_Model {
	
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function insertbestelling($data){
		$this->db->insert('tblBestellingen', $data);
		
		return($this->db->insert_id());
	}

}