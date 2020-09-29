<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Menu_model extends CI_Model
{
  public function getSubMenu()
  {
      $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                FROM `user_sub_menu` JOIN `user_menu`
                ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                ";
      return $this->db->query($query)->result_array();
  }

  public function getSubMenu_byId($id)
  {
      $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                FROM `user_sub_menu` JOIN `user_menu`
                ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                WHERE `user_sub_menu`.`id` =$id
                ";
      return $this->db->query($query)->row_array();
  }

  public function subupdate($data, $id)
    {
        $this->db->update('user_sub_menu', $data, array('id'=>$id));
        return $id;
    }

    public function delete_submenu($id)
    {
        $this->db->delete('user_sub_menu', array('id'=>$id));
        // $this->db->delete('h_vicon_riwayat_status', array('h_pengajuan_vicon_id'=>$id));
        return $id;
    }

     public function delete($id)
    {
        $this->db->delete('user_menu', array('id'=>$id));
        // $this->db->delete('h_vicon_riwayat_status', array('h_pengajuan_vicon_id'=>$id));
        return $id;
    }

    public function update($data, $id)
    {
        $this->db->update('user_menu', $data, array('id'=>$id));
        return $id;
    }

}
