<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jajan extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    $this->load->model('Jajan_model', 'jajan');
    $this->load->model('Santri_model', 'santri');
  }

  public function index()
  {
    $data['title'] = 'Data Uang Jajan';
    $data['user'] = $this->db->get_where('user',['email' =>
    $this->session->userdata('email')])->row_array();
    // $data['santri'] = $this->db->get('santri')->result_array();
    $data['jajan'] = $this->jajan->get_jajan();
    $data['santri'] = $this->santri->get_santri();


    $this->form_validation->set_rules('santri', 'Nama Santri', 'is_unique[jajan.id_santri],required|trim');
    $this->form_validation->set_rules('debit', 'Total Uang Masuk', 'required|trim');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar',$data);
      $this->load->view('templates/topbar',$data);
      $this->load->view('jajan/index',$data);
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
        redirect('jajan');
    }
  }

  public function t_jajan()
  {
    $data['title'] = 'Transaksi Uang Jajan';
    $data['user'] = $this->db->get_where('user',['email' =>
    $this->session->userdata('email')])->row_array();
    $data['santri'] = $this->jajan->get_jajan();
      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar',$data);
      $this->load->view('templates/topbar',$data);
      $this->load->view('jajan/transaksi',$data);
      $this->load->view('templates/footer',$data);


  }

  public function dashboard()
  {
    $data['dasboard'] = $this->jajan->get_dashboard();
    var_dump($data);
    die;
  }

  public function cekout()
  {
    $data['title'] = 'Transaksi Cekout Uang Jajan';
    $data['user'] = $this->db->get_where('user',['email' =>
    $this->session->userdata('email')])->row_array();
    $santri = $this->input->post('santri');
    $data['cekout'] = $this->jajan->get_jajan_by_id($santri);

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
        $this->load->view('jajan/cekout',$data);
        $this->load->view('templates/footer',$data);
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Santri Tidak Menitipkan Uang Jajan ! </div>');
      redirect('jajan/t_jajan');
    }
  }

  public function save_jajan()
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

    $infotransaksi = $this->jajan->save_transaksi($data);

    $id = $this->input->post('santri');
    $saldo_akhir = [
      'date' => $this->input->post('tgl'),
      'debit' => $this->input->post('saldo_akhir'),
    ];

    $infotransaksi = $this->jajan->update_jajan($saldo_akhir,$id);

    if (!empty($infotransaksi && $saldo_akhir)) {
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
      Transaksi Berhasil! </div>');
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
      Transaksi Gagal! </div>');
    }

    redirect('jajan/t_jajan');
  }

  public function rekap()
  {
    $data['title'] = 'Rekap Uang Jajan';
    $data['user'] = $this->db->get_where('user',['email' =>
    $this->session->userdata('email')])->row_array();
    $data['jajan'] = $this->jajan->get_dashboard();
    $data['transaksi'] = $this->jajan->get_transaksi();

      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar',$data);
      $this->load->view('templates/topbar',$data);
      $this->load->view('jajan/report',$data);
      $this->load->view('templates/footer',$data);

  }

  public function edit($id)
  {
    $data['title'] = 'Edit Uang Jajan Santri';
    $data['user'] = $this->db->get_where('user',['email' =>
    $this->session->userdata('email')])->row_array();
    $data['jajan'] = $this->jajan->get_jajan_by_id($id);
    $data['santri'] = $this->santri->get_santri($id);


    $this->form_validation->set_rules('santri', 'Nama Santri', 'required');
    $this->form_validation->set_rules('debit', 'Saldo Akhir', 'required');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar',$data);
      $this->load->view('templates/topbar',$data);
      $this->load->view('jajan/edit',$data);
      $this->load->view('templates/footer',$data);
    } else {
      $data = [
            'id_santri' => $this->input->post('santri'),
            'debit' => $this->input->post('debit'),
            'date' => date('Y-m-d')
      ];

      $jajan = $this->jajan->update_jajan($data,$id);
      if (!empty($jajan)) {
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          Edit Uang Jajan Berhasil! </div>');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
          Edit Uang Jajan Gagal! </div>');
      }
      redirect('jajan');
    }
  }

  public function delete()
  {
    $id=$this->input->post('id');
    $jajan = $this->jajan->delete($id);
    if (!empty($jajan)) {
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Uang Jajan Santri Berhasil dihapus! </div>');
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Uang Jajan Santri Gagal dihapus! </div>');
    }
    redirect('jajan');
  }

}
