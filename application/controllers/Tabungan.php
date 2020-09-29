<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabungan extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    $this->load->model('Tabungan_model', 'tabungan');
    $this->load->model('Jajan_model', 'jajan');
    $this->load->model('Santri_model', 'santri');
  }

  public function index()
  {
    $data['title'] = 'Data Tabungan';
    $data['user'] = $this->db->get_where('user',['email' =>
    $this->session->userdata('email')])->row_array();
    // $data['santri'] = $this->db->get('santri')->result_array();
    $data['tabungan'] = $this->tabungan->get_tabungan();
    $data['santri'] = $this->santri->get_santri();

    $this->form_validation->set_rules('santri', 'Nama Santri', 'is_unique[tabungan.id_santri],required|trim');
    $this->form_validation->set_rules('debit', 'Total Uang Masuk', 'required|trim');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar',$data);
      $this->load->view('templates/topbar',$data);
      $this->load->view('tabungan/index',$data);
      $this->load->view('templates/footer',$data);
    } else {
      $data = [
            'id_santri' => $this->input->post('santri'),
            'debit' => $this->input->post('debit'),
            'user_id' => $this->input->post('user'),
            'date' => date('Y-m-d'),
      ];
      $tabungan = $this->db->insert('tabungan', $data);
      if (!empty($tabungan)) {
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Tabungan Berhasil Ditambah !</div>');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Tabungan Gagal Ditambah !</div>');
      }
        redirect('tabungan');
    }
  }

  public function transaksi()
  {
    $data['title'] = 'Transaksi Tabungan';
    $data['user'] = $this->db->get_where('user',['email' =>
    $this->session->userdata('email')])->row_array();
    // $data['santri'] = $this->santri->get_santri();
    $data['santri'] = $this->tabungan->get_tabungan();

      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar',$data);
      $this->load->view('templates/topbar',$data);
      $this->load->view('tabungan/transaksi',$data);
      $this->load->view('templates/footer',$data);


  }

  public function cekout()
  {
    $data['title'] = 'Transaksi Cekout Tabungan';
    $data['user'] = $this->db->get_where('user',['email' =>
    $this->session->userdata('email')])->row_array();
    $santri = $this->input->post('santri');
    $data['cekout'] = $this->tabungan->get_tabungan_by_id($santri);
    $data['detail'] = [
          'santri' => $this->input->post('santri'),
          'tgl' => $this->input->post('tgl'),
          'kredit' => $this->input->post('kredit'),
          'keterangan' => $this->input->post('keterangan'),
          'tipe' => $this->input->post('tipe'),
          'jenis' => $this->input->post('jenis'),
    ];

    $this->form_validation->set_rules('santri', 'Santri', 'required');
    $this->form_validation->set_rules('tgl', 'Tanggal', 'required');
    $this->form_validation->set_rules('kredit', 'Jumlah Uang', 'required');

  if ($this->form_validation->run() == true && $data['cekout'] == true) {
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('tabungan/cekout',$data);
        $this->load->view('templates/footer',$data);
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Santri Tidak Menitipkan Tabungan ! </div>');
      redirect('tabungan/transaksi');
    }
  }

  public function save_transaksi()
  {
    $data['user'] = $this->db->get_where('user',['email' =>
    $this->session->userdata('email')])->row_array();
    $user = $data['user']['id'];
    $data = [
          'user_id' => $user,
          'santri_id' => $this->input->post('santri'),
          'date_created' => $this->input->post('tgl'),
          'kredit' => $this->input->post('kredit'),
          'kd_tipe_transaksi' => $this->input->post('tipe'),
          'jenis_transaksi' => $this->input->post('jenis'),
          'debit' => $this->input->post('debit'),
          'keterangan' => $this->input->post('keterangan'),
        ];

    $infotransaksi = $this->tabungan->save_transaksi($data);

    $id = $this->input->post('santri');
    $saldo_akhir = [
      'date' => $this->input->post('tgl'),
      'debit' => $this->input->post('saldo_akhir'),
    ];

    $infotransaksi = $this->tabungan->update($saldo_akhir,$id);

    if (!empty($infotransaksi && $saldo_akhir)) {
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
      Transaksi Berhasil! </div>');
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
      Transaksi Gagal! </div>');
    }

    redirect('tabungan/transaksi');
  }

  public function rekap()
  {
    $data['title'] = 'Rekap Tabungan';
    $data['user'] = $this->db->get_where('user',['email' =>
    $this->session->userdata('email')])->row_array();
    $data['tabungan'] = $this->tabungan->get_dashboard();
    $data['transaksi'] = $this->tabungan->get_transaksi_t();

      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar',$data);
      $this->load->view('templates/topbar',$data);
      $this->load->view('tabungan/report',$data);
      $this->load->view('templates/footer',$data);

  }

  public function edit($id)
  {
    $data['title'] = 'Edit Tabungan Santri';
    $data['user'] = $this->db->get_where('user',['email' =>
    $this->session->userdata('email')])->row_array();
    $data['tabungan'] = $this->tabungan->get_tabungan_by_id($id);
    $data['santri'] = $this->santri->get_santri($id);


    $this->form_validation->set_rules('santri', 'Nama Santri', 'required');
    $this->form_validation->set_rules('debit', 'Saldo Akhir', 'required');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar',$data);
      $this->load->view('templates/topbar',$data);
      $this->load->view('tabungan/edit',$data);
      $this->load->view('templates/footer',$data);
    } else {
      $data = [
            'id_santri' => $this->input->post('santri'),
            'debit' => $this->input->post('debit'),
            'date' => date('Y-m-d')
      ];

      $tabungan = $this->tabungan->update($data,$id);
      if (!empty($tabungan)) {
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          Edit Tabungan Berhasil! </div>');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
          Edit Tabungan Gagal! </div>');
      }
      redirect('tabungan');
    }
  }

   public function delete()
  {
    $id=$this->input->post('id');
    $tabungan = $this->tabungan->delete($id);
    if (!empty($tabungan)) {
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
       Tabungan Berhasil dihapus! </div>');
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
       Tabungan Gagal dihapus! </div>');
    }
    redirect('jajan');
  }

}
