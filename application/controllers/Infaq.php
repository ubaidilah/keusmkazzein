<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Infaq extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    $this->load->model('Tabungan_model', 'tabungan');
    $this->load->model('Jajan_model', 'jajan');
    $this->load->model('Santri_model', 'santri');
    $this->load->model('Infaq_model', 'infaq');
  }

  public function index()
  {
    $data['title'] = 'Infaq Milad';
    $data['user'] = $this->db->get_where('user',['email' =>
    $this->session->userdata('email')])->row_array();
    $data['santri'] = $this->db->get('santri')->result_array();
    $data['infaq'] = $this->infaq->get_infaq();
    // var_dump($data);
    // die;
      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar',$data);
      $this->load->view('templates/topbar',$data);
      $this->load->view('infaq/index',$data);
      $this->load->view('templates/footer',$data);
    

    
  }

  public function transaksi()
  {
    $data['title'] = 'Transaksi Infaq';
    $data['user'] = $this->db->get_where('user',['email' =>
    $this->session->userdata('email')])->row_array();
    $data['santri'] = $this->santri->get_santri();
    // $data['santri'] = $this->tabungan->get_tabungan();

    $this->form_validation->set_rules('santri', 'Nama Santri', 'is_unique[infaq.id_santri],required|trim');
    $this->form_validation->set_rules('total', 'Total Uang Masuk', 'required|trim');
    $this->form_validation->set_rules('tgl', 'Tanggal Uang Masuk', 'required|trim');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar',$data);
      $this->load->view('templates/topbar',$data);
      $this->load->view('infaq/transaksi',$data);
      $this->load->view('templates/footer',$data);
    } else {
      $data = [
            'id_santri' => $this->input->post('santri'),
            'total' => $this->input->post('total'),
            'id_user' => $data['user']['id'],
            'is_status' => 1,
            'date' => $this->input->post('tgl'),
            'keterangan' => $this->input->post('keterangan'),
      ];
      $infaq = $this->db->insert('infaq', $data);
      if (!empty($infaq)) {
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        infaq Berhasil Ditambah !</div>');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        infaq Gagal Ditambah !</div>');
      }
        redirect('infaq/transaksi');
    }

  }



  public function rekap()
  {
    $data['title'] = 'Rekap Tabungan';
    $data['user'] = $this->db->get_where('user',['email' =>
    $this->session->userdata('email')])->row_array();
    $data['tabungan'] = $this->tabungan->get_dashboard();
    $data['transaksi'] = $this->tabungan->get_transaksi();

      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar',$data);
      $this->load->view('templates/topbar',$data);
      $this->load->view('tabungan/report',$data);
      $this->load->view('templates/footer',$data);
  }

}
