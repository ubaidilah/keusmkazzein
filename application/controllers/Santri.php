<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Santri extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    $this->load->model('Santri_model', 'santri');
  }

  public function index()
  {
    $data['title'] = 'Data Santri';
    $data['user'] = $this->db->get_where('user',['email' =>
    $this->session->userdata('email')])->row_array();

    $data['kelas'] = $this->db->get('kelas')->result_array();
    $data['jurusan'] = $this->db->get('jurusan')->result_array();
    $data['program'] = $this->db->get('program')->result_array();
    $data['santri'] = $this->santri->get_santri();

    $this->form_validation->set_rules('nama', 'Nama Santri', 'required');
    $this->form_validation->set_rules('jk', 'JK', 'required');
    // $this->form_validation->set_rules('nis', 'NIS Siswa', 'required');
    $this->form_validation->set_rules('kelas', 'Kelas', 'required');
    $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
    $this->form_validation->set_rules('program', 'Program', 'required');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar',$data);
      $this->load->view('templates/topbar',$data);
      $this->load->view('santri/list',$data);
      $this->load->view('templates/footer',$data);

    } else {
      $data = [
            'nama_santri' => $this->input->post('nama'),
            'jk' => $this->input->post('jk'),
            'nis' => $this->input->post('nis'),
            'kd_kelas' => $this->input->post('kelas'),
            'kd_jurusan' => $this->input->post('jurusan'),
            'kd_program' => $this->input->post('program'),
      ];
      $this->db->insert('santri', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Santri Berhasil Ditambahkan</div>');
        redirect('santri');
    }
  }


  public function edit($id)
  {
    $data['title'] = 'Edit Data Santri';
    $data['user'] = $this->db->get_where('user',['email' =>
    $this->session->userdata('email')])->row_array();
    $data['santri'] = $this->santri->get_santri_by_id($id);
    $data['kelas'] = $this->db->get('kelas')->result_array();
    $data['jurusan'] = $this->db->get('jurusan')->result_array();
    $data['program'] = $this->db->get('program')->result_array();

    $this->form_validation->set_rules('nama', 'Nama Santri', 'required');
    $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required');
    $this->form_validation->set_rules('kelas', 'Kelas', 'required');
    $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar',$data);
      $this->load->view('templates/topbar',$data);
      $this->load->view('santri/edit',$data);
      $this->load->view('templates/footer',$data);
    } else {
      $data = [
            'nama_santri' => $this->input->post('nama'),
            'nis' => $this->input->post('nis'),
            'jk' => $this->input->post('jk'),
            'kd_kelas' => $this->input->post('kelas'),
            'kd_jurusan' => $this->input->post('jurusan'),
            'kd_program' => $this->input->post('program')
      ];
      $santri = $this->santri->update($data,$id);
      if (!empty($santri)) {
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          Edit Santri Berhasil! </div>');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
          Edit Santri Gagal! </div>');
      }
      redirect('santri');
    }
  }

  public function delete()
  {
    $id=$this->input->post('id');
    $santri = $this->santri->delete($id);
    if (!empty($santri)) {
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Santri Berhasil dihapus! </div>');
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Santri Gagal dihapus! </div>');
    }
    redirect('santri');
  }

}
