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
     $data['type'] = "admin";
     $data['query'] = $query->result();
     return($data);
   }
   else
   {
      $this -> db -> select('id, Login, Naam, Pass');
      $this -> db -> from('tblTaxis');
      $this -> db -> where('Login = ' . "'" . $username . "'");
      $this -> db -> where('Pass = ' . "'" . MD5($password) . "'");
      $this -> db -> limit(1);

       $query2 = $this -> db -> get();
       if($query2 -> num_rows() == 1)
       {
          $data['type'] = "taxi";
          $data['query'] = $query2->result();
          return($data);
       }else{
        $this -> db -> select('id, email, Naam, pass');
        $this -> db -> from('tblKlanten');
        $this -> db -> where('email = ' . "'" . $username . "'");
        $this -> db -> where('pass = ' . "'" . MD5($password) . "'");
        $this -> db -> limit(1);

         $query2 = $this -> db -> get();
         if($query2 -> num_rows() == 1)
         {
            $data['type'] = "klant";
            $data['query'] = $query2->result();
            return($data);
         }else{
          return false;
         }
       }
   }
 }
 
 function getuser(){
 	 $sessiondata = $this->session->userdata('logged_in');
	 $this->db->where('pkUsers', $sessiondata['id']);
	 $query = $this->db->get('tblUsers');
	 return($query);
 }

 function getall(){
    $query = $this->db->get('tblUsers');
    return($query);
 }
}
?>
