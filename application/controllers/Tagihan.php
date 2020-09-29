<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagihan extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    $this->load->model('Tabungan_model', 'tabungan');
    $this->load->model('Jajan_model', 'jajan');
    $this->load->model('Santri_model', 'santri');
    $this->load->model('Tagihan_model', 'tagihan');
  }

  public function index()
  {
    $data['title'] = 'Manajemen Tagihan';
    $data['user'] = $this->db->get_where('user',['email' =>
    $this->session->userdata('email')])->row_array();
    // $data['santri'] = $this->db->get('santri')->result_array();
    $data['tagihan'] = $this->tagihan->get_tagihan();
    $data['santri'] = $this->santri->get_santri();

    $this->form_validation->set_rules('tagihan', 'Nama Tagihan', 'required|trim');
    $this->form_validation->set_rules('total', 'Total Uang Tagihan', 'required|trim');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar',$data);
      $this->load->view('templates/topbar',$data);
      $this->load->view('tagihan/index',$data);
      $this->load->view('templates/footer',$data);
    } else {
      $data = [
            'nama_tagihan' => $this->input->post('tagihan'),
            'total' => $this->input->post('total'),
      ];
      $tagihan = $this->db->insert('tagihan', $data);
      if (!empty($tagihan)) {
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        tagihan Berhasil Ditambah !</div>');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        tagihan Gagal Ditambah !</div>');
      }
        redirect('tagihan');
    }
  }

  public function transaksi()
  {
    $data['title'] = 'Transaksi Tagihan';
    $data['user'] = $this->db->get_where('user',['email' =>
    $this->session->userdata('email')])->row_array();
    // $data['santri'] = $this->santri->get_santri();
    // $data['santri'] = $this->tabungan->get_tabungan();
    $data['jenis_tagihan'] = $this->tagihan->get_tagihan();
    $data['tagihan'] = $this->tagihan->get_data_billing();

      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar',$data);
      $this->load->view('templates/topbar',$data);
      $this->load->view('tagihan/transaksi',$data);
      $this->load->view('templates/footer',$data);
  }

  public function cekout()
  {
    $data['title'] = 'Transaksi Cekout Tagihan';
    $data['user'] = $this->db->get_where('user',['email' =>
    $this->session->userdata('email')])->row_array();
    $santri = $this->input->post('santri');
    $tagihan = $this->input->post('tagihan');
    $data['tanggal'] = $this->input->post('tgl');
    $data['cekout'] = $this->tagihan->get_billing_by_id($santri, $tagihan);

    // var_dump($data);
    // die;
   
    $this->form_validation->set_rules('santri', 'Santri', 'required');
    $this->form_validation->set_rules('tagihan', 'Tagihan', 'required');

  if ($this->form_validation->run() == true && $data['cekout'] == true) {
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('tagihan/cekout',$data);
        $this->load->view('templates/footer',$data);
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Santri Tidak Menitipkan Uang Jajan ! </div>');
      redirect('tagihan/transaksi');
    }
  }

  public function billing($id)
  {
    $data['title'] = 'Buat Data Tagihan';
    $data['user'] = $this->db->get_where('user',['email' =>
    $this->session->userdata('email')])->row_array();
    $data['kelas'] = $this->db->get('kelas')->result_array();
    $data['tagihan'] = $this->tagihan->get_tagihan();
    $data['santri'] = $this->santri->get_santri();
   
    $this->form_validation->set_rules('santri', 'Santri', 'required');
    // $this->form_validation->set_rules('santri', 'Santri', 'required');

  if ($this->input->post('santri') == false && $this->input->post('kelas') == false ) {
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('tagihan/billing',$data);
        $this->load->view('templates/footer',$data);
    } else {
      $santri_list = $this->input->post('santri');
      $kel = $this->input->post('kelas');
      $kode = $this->input->post('kode');
      if ($kode == 1) {
        $kelas_l = $this->db->get_where('santri',['kd_kelas' => $kel])->result_array();
        foreach ($kelas_l as $kelas_na) {
          $result = [
          'santri_id' =>  $kelas_na['id'],
          'tagihan_id' =>  $id,
          ];

          $this->db->insert('invoice_tagihan', $result);

          $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
           Billing Berhasil dibuat! </div>');
          redirect('tagihan/invoice');
        }

      } else {
        foreach ($santri_list as $santri_name) {
          $result2 = [
          'santri_id' =>  $santri_name,
          'tagihan_id' =>  $id,
          ];
          $this->db->insert('invoice_tagihan', $result2);

          $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
           Billing Berhasil dibuat! </div>');
          redirect('tagihan/invoice');
        }

      }
      
    }
  }



  public function save_transaksi()
  {
    $data['user'] = $this->db->get_where('user',['email' =>
    $this->session->userdata('email')])->row_array();
    $user = $data['user']['id'];
    $data = [
          'user_id' => $user,
          'invoice_tagihan_id' => $this->input->post('santri'),
          'date' => $this->input->post('tgl'),
          'total' => $this->input->post('total'),
        ];

     // var_dump($data);   
    $infotransaksi = $this->tagihan->save_transaksi($data);

    $id = $this->input->post('santri');
    $status = [
      'is_status' => 1,
    ];

    $update_transaksi = $this->tagihan->update_tagihan($status,$id);

    if (!empty($infotransaksi && $update_transaksi)) {
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
      Transaksi Berhasil! </div>');
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
      Transaksi Gagal! </div>');
    }

    redirect('tagihan/transaksi');
  }

  public function data()
  {
    $data['title'] = 'Data Tagihan';
    $data['user'] = $this->db->get_where('user',['email' =>
    $this->session->userdata('email')])->row_array();
    $data['data_tagihan'] = $this->tagihan->get_data_billing();
    // $data['transaksi'] = $this->tabungan->get_transaksi_t();

      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar',$data);
      $this->load->view('templates/topbar',$data);
      $this->load->view('tagihan/data',$data);
      $this->load->view('templates/footer',$data);

  }

  public function ajax_view_data_billing($status = 1)
    {
        $posted = $this->input->post();
        $data = $this->tagihan->get_data_billing($posted, $status);
        echo json_encode($data);
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
