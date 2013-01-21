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
				$status = $r->Status;
			}
		}else{
			$status = 1;
		}
		return($status);
	}

   function insert($data){
		$this->db->insert('tblStatus', $data);
	}
	
	function update($data, $id1, $id2){
		$this->db->where('fkBestelling', $id2);
		$data2['status'] = 0;
		$this->db->update('tblStatus', $data2);
		$this->db->where('fkUser', $id1);
		$this->db->update('tblStatus', $data);
	}

}
?>
