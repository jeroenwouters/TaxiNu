<?php
Class M_status extends CI_Model
{
	function getstatusbyuser($id){
		$sessiondata = $this->session->userdata('logged_in');
		$this->db->where('fkUser', $sessiondata['id']);
		$this->db->where('fkBestelling', $id);
		$query = $this->db->get('tblStatus');
		if ($query->num_rows() > 0)
		{
			foreach($query->result() as $r){
				$data['status'] = $r->Status;
				$data['taxi'] = $r->fkTaxi;
			}
		}else{
			$data['status'] = 1;
			$data['taxi'] = 0;
		}
		return($data);
	}


   function insert($data){
   		$this->db->where('fkBestelling', $data['fkBestelling']);
   		$this->db->where('fkUser', $data['fkUser']);
   		$query = $this->db->get('tblStatus');
   		if ($query->num_rows() > 0)
		{
			$this->db->where('fkBestelling', $data['fkBestelling']);
   			$this->db->where('fkUser', $data['fkUser']);
			$this->db->update('tblStatus', $data);
			return('update');
		}else{
			$this->db->insert('tblStatus', $data);
			return('new');
		}
	}
	
	function update($data, $id, $id2){
		$this->db->where('fkBestelling', $id);
		$this->db->where('fkUser', $id2);
		$this->db->update('tblStatus', $data);
		 return(TRUE);
		// $this->db->where('fkUser', $id1);
		// $this->db->update('tblStatus', $data);
	}

	function gettaxi($fkBestelling, $fkUser){
		$this->db->where('fkBestelling', $fkBestelling);
		$this->db->where('fkUser', $fkUser);
		$query = $this->db->get('tblStatus');

		foreach ($query->result() as $r) {
			return($r->fkTaxi);
		}
	}

}
?>
