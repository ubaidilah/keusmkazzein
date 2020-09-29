<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Santri_model extends CI_Model
{

  public function get_santri()
  {
    $this->db->select('s.*, k.nama_kelas as nama_kelas, j.nama_jurusan as nama_jurusan, p.nama_program')
            ->from('santri s')
            ->join('kelas k','k.id_kelas = s.kd_kelas')
            ->join('jurusan j','j.id_jurusan = s.kd_jurusan')
            ->join('program p','p.id = s.kd_program');

        return $this->db->get()->result_array();
  }

  public function get_santri_by_id($id)
  {
    $this->db->select('s.*, k.nama_kelas as nama_kelas, j.nama_jurusan as nama_jurusan, p.nama_program')
            ->from('santri s')
            ->join('kelas k','k.id_kelas = s.kd_kelas')
            ->join('jurusan j','j.id_jurusan = s.kd_jurusan')
            ->join('program p','p.id = s.kd_program')
            ->where('s.id',$id);

        return $this->db->get()->row_array();
  }

  public function save($data)
    {
        $this->db->insert('santri',$data);
        return $this->db->insert_id();
    }

    public function update($data, $id)
    {
        $this->db->update('santri', $data, array('id'=>$id));
        return $id;
    }

    public function delete($id)
    {
        $this->db->delete('santri', array('id'=>$id));
        // $this->db->delete('user', array('h_pengajuan_vicon_id'=>$id));
        return $id;
    }

}
