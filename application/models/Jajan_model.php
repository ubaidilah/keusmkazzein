<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Jajan_model extends CI_Model
{

   public function __construct()
  {
    parent::__construct();
     date_default_timezone_set("Asia/Bangkok");
  }

  public function get_jajan()
  {
    $this->db->select('j.*, s.nama_santri as nama_santri, u.name as nama_user')
            ->from('jajan j')
            ->join('santri s','s.id = j.id_santri')
            ->join('user u','u.id = j.id_user');

        return $this->db->get()->result_array();
  }


  public function get_dashboard()
  {
    $this->db->select('SUM(j.debit) as saldo_jajan')
            ->from('jajan j');
        return $this->db->get()->row_array();
  }

  public function get_transaksi()
  {
    $this->db->select('SUM(t.kredit) as saldo_jajan')
            ->from('transaksi t')
            ->where('date_created between date_sub(curdate(), INTERVAL 7 DAY) and curdate()')
            ->where('kd_tipe_transaksi','2')
            ->where('jenis_transaksi','1');
        return $this->db->get()->row_array();
  }

  public function get_transaksi_t()
  {
    $this->db->select('SUM(t.kredit) as saldo_jajan')
            ->from('transaksi t')
            ->where('date_created between date_sub(curdate(), INTERVAL 7 DAY) and curdate()')
            ->where('kd_tipe_transaksi','2')
            ->where('jenis_transaksi','2');
        return $this->db->get()->row_array();
  }

  public function get_jajan_by_id($id)
  {
  $result =  $this->db->select('j.*, s.nama_santri as nama_santri, u.name as nama_user')
            ->from('jajan j')
            ->join('santri s','s.id = j.id_santri')
            ->join('user u','u.id = j.id_user')
            ->where('j.id',$id);
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
