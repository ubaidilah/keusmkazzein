<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Tabungan_model extends CI_Model
{

 public function __construct()
  {
    parent::__construct();
     date_default_timezone_set("Asia/Bangkok");
  }
  
  public function get_tabungan()
  {
    $this->db->select('t.*, s.nama_santri as nama_santri, u.name as nama_user')
            ->from('tabungan t')
            ->join('santri s','s.id = t.id_santri')
            ->join('user u','u.id = t.user_id');

        return $this->db->get()->result_array();
  }

  public function get_dashboard()
  {
    $this->db->select('SUM(t.debit) as saldo_tabungan')
             ->from('tabungan t');
        return $this->db->get()->row_array();
  }

  public function get_transaksi_t()
  {
    $this->db->select('SUM(t.kredit) as uang_tabungan')
            ->from('transaksi t')
            ->where('date_created between date_sub(curdate(), INTERVAL 7 DAY) and curdate()')
            ->where('kd_tipe_transaksi','1')
            ->where('jenis_transaksi','2');
        return $this->db->get()->row_array();
  }

  public function get_transaksi_a()
  {
    $this->db->select('SUM(t.kredit) as uang_tabungan')
            ->from('transaksi t')
            ->where('date_created between date_sub(curdate(), INTERVAL 7 DAY) and curdate()')
            ->where('kd_tipe_transaksi','1')
            ->where('jenis_transaksi','1');
        return $this->db->get()->row_array();
  }

  public function get_tabungan_by_id($id)
  {
    $this->db->select('t.*, s.nama_santri as nama_santri, u.name as nama_user')
            ->from('tabungan t')
            ->join('santri s','s.id = t.id_santri')
            ->join('user u','u.id = t.user_id')
            ->where('t.id',$id);
        return $this->db->get()->row_array();
  }

  public function save_transaksi($data)
    {
        $this->db->insert('transaksi',$data);
        return $this->db->insert_id();
    }

    public function update($data, $id)
    {
        $this->db->update('tabungan', $data, array('id'=>$id));
        return $id;
    }

      public function delete($id)
    {
        $this->db->delete('tabungan', array('id'=>$id));
        // $this->db->delete('user', array('h_pengajuan_vicon_id'=>$id));
        return $id;
    }

}
