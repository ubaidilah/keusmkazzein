<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class User_model extends CI_Model
{
  public function save($data)
    {
        $this->db->insert('user',$data);
        return $this->db->insert_id();
    }

    public function update($data, $id)
    {
        $this->db->update('user', $data, array('id'=>$id));
        return $id;
    }

    public function delete($id)
    {
        $this->db->delete('user', array('id'=>$id));
        // $this->db->delete('user', array('h_pengajuan_vicon_id'=>$id));
        return $id;
    }

}
