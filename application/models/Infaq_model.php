<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Infaq_model extends CI_Model
{

  public function get_infaq()
  {
    $this->db->select('i.*, s.nama_santri as nama_santri, u.name as nama_user')
            ->from('infaq i')
            ->join('santri s','s.id = i.id_santri')
            ->join('user u','u.id = i.id_user');

        return $this->db->get()->result_array();
  }


  public function get_dashboard()
  {
    $this->db->select('SUM(i.total) as total_infaq')
            ->from('infaq i');
        return $this->db->get()->row_array();
  }

  public function save_transaksi($data)
    {
        $this->db->insert('transaksi',$data);
        return $this->db->insert_id();
    }

    public function update_jajan($data, $id)
    {
        $this->db->update('jajan', $data, array('id'=>$id));
        return $id;
    }

    public function update($data, $id)
    {
        $this->db->update('santri', $data, array('id'=>$id));
        return $id;
    }

    public function delete($id)
    {
        $this->db->delete('jajan', array('id'=>$id));
        // $this->db->delete('user', array('h_pengajuan_vicon_id'=>$id));
        return $id;
    }

}
