<?php
Class M_klanten extends CI_Model
{
 function insert($data)
 {
    $this->db->insert('tblKlanten', $data);
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

}
?>
