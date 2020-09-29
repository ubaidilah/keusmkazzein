<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    is_logged_in();
  }

  public function index()
  {
    $data['title'] = 'Dashboard';
    $data['user'] = $this->db->get_where('user',['email' =>
    $this->session->userdata('email')])->row_array();

    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar',$data);
    $this->load->view('templates/topbar',$data);
    $this->load->view('admin/index',$data);
    $this->load->view('templates/footer',$data);


  }

  public function role()
  {
    $data['title'] = 'Role';
    $data['user'] = $this->db->get_where('user',['email' =>
    $this->session->userdata('email')])->row_array();

    $data['role'] = $this->db->get('role')->result_array();
    $this->form_validation->set_rules('role', 'Nama Role', 'required');
    if ($this->form_validation->run() == false) {
    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar',$data);
    $this->load->view('templates/topbar',$data);
    $this->load->view('admin/role',$data);
    $this->load->view('templates/footer',$data);
    } else {
      $data = [
            'role' => $this->input->post('role'),
      ];
      $role_id = $this->db->insert('role', $data);
      if (!empty($role_id)) {
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          Role Access Berhasil ditambah! </div>');
          redirect('admin/role');

      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Role Access Gagal ditambah! </div>');
        redirect('admin/role');

      }
    }

  }

  public function roleaccess($role_id)
  {
    $data['title'] = 'Role Access';
    $data['user'] = $this->db->get_where('user',['email' =>
    $this->session->userdata('email')])->row_array();

    $data['role'] = $this->db->get_where('role', ['id' => $role_id])
    ->row_array();

    $this->db->where('id !=', 1);
    $data['menu'] = $this->db->get('user_menu')->result_array();
    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar',$data);
    $this->load->view('templates/topbar',$data);
    $this->load->view('admin/role-access',$data);
    $this->load->view('templates/footer',$data);

  }

  public function changeaccess(){
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
          'role_id' => $role_id,
          'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
          $this->db->insert('user_access_menu', $data);
        } else {
          $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Access Changed!</div>');
  }

}
