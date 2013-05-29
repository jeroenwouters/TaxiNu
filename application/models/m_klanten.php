<?php
Class M_klanten extends CI_Model
{
 function insert($data)
 {
    $this->db->insert('tblKlanten', $data);
 }

 function login($email, $pass)
 {
   $this -> db -> select('id, email, pass, naam, tel');
   $this -> db -> from('tblKlanten');
   $this -> db -> where('email = ' . "'" . $email . "'");
   $this -> db -> where('pass = ' . "'" . MD5($pass) . "'");
   $this -> db -> limit(1);

   $query = $this -> db -> get();

   return($query);
}
?>
