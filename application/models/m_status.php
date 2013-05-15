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
		$this->db->insert('tblStatus', $data);
	}
	
	function update($data, $id, $id2){
		$this->db->where('fkBestelling', $id);
		$this->db->where('fkUser', $id2);
		$this->db->update('tblStatus', $data);
		 return(TRUE);
		// $this->db->where('fkUser', $id1);
		// $this->db->update('tblStatus', $data);
	}

}
?>
