<?php
Class M_klanten extends CI_Model
{
 function insert($data)
 {
    $this->db->insert('tblKlanten', $data);
 }

 function getall(){
    $query = $this->db->get('tblKlanten');
    return($query);
 }

 function login($email, $pass)
 {
    $this->db->where('email', $email);
    $this->db->where('pass', md5($pass));
        
        // Run the quey
        $query = $this->db->get('tblKlanten');
        // Let's check if there are any results
        if($query->num_rows == 1){
          return($query->result());
        }
}

function get($id){
	$this->db->where('id', $id);
	$query = $this->db->get('tblKlanten');

	return($query);
}

function update($id, $data){
    $this->db->where('id', $id);
    $this->db->update('tblKlanten', $data);
}

}
?>
