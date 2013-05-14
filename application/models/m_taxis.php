<?php
Class M_taxis extends CI_Model
{

 function get($id){
 	 $this->db->where('fkuser', $id);
	 $query = $this->db->get('tblTaxis');
   return($query);
 }

 function insert($data){
  $this->db->insert('tblTaxis', $data);
 }

 function update($data, $id){
    $this->db->where('id', $id);
    $this->db->update('tblTaxis', $data);
  }

  function delete($id){
    $this->db->where('id', $id);
    $this->db->delete('tblTaxis');
  }
}
?>
