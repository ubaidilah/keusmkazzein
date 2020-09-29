<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keuangan extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    $this->load->model('Jajan_model', 'jajan');
    $this->load->model('tabungan_model', 'tabungan');
    $this->load->model('infaq_model', 'infaq');
    $this->load->model('Santri_model', 'santri');
    $this->load->model('tagihan_model', 'tagihan');
  }

  public function index()
  {
    $data['title'] = 'Dashboard';
    $data['user'] = $this->db->get_where('user',['email' =>
    $this->session->userdata('email')])->row_array();
    // $data['santri'] = $this->db->get('santri')->result_array();
    $data['infaq'] = $this->infaq->get_dashboard();
    $data['jajan'] = $this->jajan->get_dashboard();
    $data['j_transaksi'] = $this->jajan->get_transaksi();
    $data['j_t_transaksi'] = $this->jajan->get_transaksi_t();
    $data['tabungan'] = $this->tabungan->get_dashboard();
    $data['t_t_transaksi'] = $this->tabungan->get_transaksi_t();
    $data['t_transaksi'] = $this->tabungan->get_transaksi_a();

    $tagihan = $this->tagihan->get_tagihan();

    foreach ($tagihan as $tag ) {
      # code...
    $data['t_tagihan_transaksi'] = $this->tagihan->get_data_payment_dashboard($tag['id']);
    }

    $this->form_validation->set_rules('santri', 'Nama Santri', 'is_unique[jajan.id_santri],required|trim');
    $this->form_validation->set_rules('debit', 'Total Uang Masuk', 'required|trim');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar',$data);
      $this->load->view('templates/topbar',$data);
      $this->load->view('keuangan/index',$data);
      $this->load->view('templates/footer',$data);

    } else {
      $data = [
            'id_santri' => $this->input->post('santri'),
            'debit' => $this->input->post('debit'),
            'id_user' => $this->input->post('user'),
            'date' => date('Y-m-d'),
      ];
      $jajan = $this->db->insert('jajan', $data);
      if (!empty($jajan)) {
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Uang Jajan Berhasil Ditambah !</div>');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Uang Jajan Gagal Ditambah !</div>');
      }
        redirect('keuangan');
    }
  }

}
