<?php
Class M_users extends CI_Model
{
 function login($username, $password)
 {
   $this -> db -> select('pkUsers, Username, Pass');
   $this -> db -> from('tblUsers');
   $this -> db -> where('Username = ' . "'" . $username . "'");
   $this -> db -> where('Pass = ' . "'" . MD5($password) . "'");
   $this -> db -> limit(1);

   $query = $this -> db -> get();

   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }
}
?>
