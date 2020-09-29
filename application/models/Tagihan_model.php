<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Tagihan_model extends CI_Model
{

  public function get_tagihan()
  {
    $this->db->select('t.*')
            ->from('tagihan t');

        return $this->db->get()->result_array();
  }

    public function get_data_billing()
  {
    $this->db->select('in.*, s.nama_santri as nama_santri, t.nama_tagihan, t.total as total_tagihan,k.nama_kelas as nama_kelas, j.nama_jurusan as nama_jurusan, u.name')
            ->from('invoice_tagihan in')
            ->join('tagihan t','t.id = in.tagihan_id')
            ->join('santri s','s.id = in.santri_id')
            ->join('kelas k','k.id_kelas = s.kd_kelas')
            ->join('jurusan j','j.id_jurusan = s.kd_jurusan')
            ->join('payment_tagihan py','py.invoice_tagihan_id = in.id', 'left')
            ->join('user u','u.id = py.user_id', 'left');

        return $this->db->get()->result_array();
  }

   public function get_data_billing_santri()
  {
    $this->db->select('in.*, s.nama_santri as nama_santri, t.nama_tagihan, t.total as total_tagihan,k.nama_kelas as nama_kelas, j.nama_jurusan as nama_jurusan')
            ->from('invoice_tagihan in')
            ->join('tagihan t','t.id = in.tagihan_id')
            ->join('santri s','s.id = in.santri_id')
            ->join('kelas k','k.id_kelas = s.kd_kelas')
            ->join('jurusan j','j.id_jurusan = s.kd_jurusan')
            ->where('in.is_status', 0);
            // ->join('program p','p.id = s.kd_program');

        return $this->db->get()->result_array();
  }

   public function get_data_payment_dashboard($id)
  {
    $this->db->select('py.*, in.tagihan_id, t.nama_tagihan, SUM(py.total) as total_pembayaran')
            ->from('payment_tagihan py')
            ->join('invoice_tagihan in','in.id = py.invoice_tagihan_id')
            ->join('tagihan t','t.id = in.tagihan_id', 'left')
            // ->join('santri s','s.id = in.santri_id')
            // ->join('kelas k','k.id_kelas = s.kd_kelas')
            // ->join('jurusan j','j.id_jurusan = s.kd_jurusan')
            ->where('in.tagihan_id', $id);
            // ->join('program p','p.id = s.kd_program');

        return $this->db->get()->result_array();
  }


  public function get_billing_by_id($data, $tagihan)
  {
  $result =  $this->db->select('in.*, s.nama_santri as nama_santri, t.nama_tagihan, t.total as total_tagihan,k.nama_kelas as nama_kelas, j.nama_jurusan as nama_jurusan')
            ->from('invoice_tagihan in')
            ->join('tagihan t','t.id = in.tagihan_id')
            ->join('santri s','s.id = in.santri_id')
            ->join('kelas k','k.id_kelas = s.kd_kelas')
            ->join('jurusan j','j.id_jurusan = s.kd_jurusan')
            ->where('in.id',$data)
            ->where('in.tagihan_id',$tagihan);
        return $this->db->get()->row_array();
  }


  public function get_dashboard()
  {
    $this->db->select('SUM(i.total) as total_infaq')
            ->from('infaq i');
        return $this->db->get()->row_array();
  }

  public function save_transaksi($data)
    {
        $this->db->insert('payment_tagihan',$data);
        return $this->db->insert_id();
    }

    public function update_tagihan($data, $id)
    {
        $this->db->update('invoice_tagihan', $data, array('id'=>$id));
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
