<?php
Class M_klanten extends CI_Model
{
 function insert($data)
 {
    $this->db->insert('tblKlanten', $data);
 }
}
?>
