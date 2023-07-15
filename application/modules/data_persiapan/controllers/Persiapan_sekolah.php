<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Persiapan_sekolah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('form_validation');
        $this->load->model('PersiapanSekolah_model', 'sekolah');
    }

    public function index()
    {
        $this->form_validation->set_rules('nama_sekolah', 'Campus', 'required');
        $this->form_validation->set_rules('kd_sekolah', 'Kode Campus', 'required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Sekolah';
            $data['home'] = 'Persiapan';
            $data['subtitle'] = $data['title'];
            $data['main_menu'] = main_menu();
            $data['sub_menu'] = sub_menu();
            $data['cek_akses'] = cek_akses_user();
            $data['pegawai'] = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai')])->row_array();
            $data['pegawai'] = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai'), 'kd_gugus' => $this->session->userdata('kd_gugus')])->row_array();
            $data['pegawai'] = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai'), 'kd_sekolah' => $this->session->userdata('kd_sekolah')])->row_array();
         
            $data['gugus'] = $this->db->get('m_gugus')->row_array();
            $data['sekolah'] = $this->db->get('m_sekolah')->row_array();
                       
            $data['data_sekolah'] = $this->sekolah->getSekolah();
            $data['data_gugus'] = $this->db->get_where('m_gugus')->result_array();
            
            $this->load->view('layout/header-top', $data);           
            $this->load->view('layout/header-bottom', $data);           
            $this->load->view('layout/main-navigation', $data);
            $this->load->view('data_persiapan/persiapan_sekolah/list', $data);
            $this->load->view('layout/footer-top');           
            $this->load->view('layout/footer-bottom');
            $this->benchmark->mark('code_end');
        } else {

            $data =
                [
                    'kd_gugus' => $this->input->post('kd_gugus'),
                    'nama_sekolah' => $this->input->post('nama_sekolah'),
                    'kd_sekolah' => $this->input->post('kd_sekolah'),
                    'is_active' => 1,
                ];
            $this->db->insert('m_sekolah', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
           Berhasi Tambah Data !</div>');
            redirect('data_persiapan/persiapan_sekolah');
        }
    }

    public function delSekolah($sek_id)
    {
        $data = ['kd_sekolah' => $sek_id];
        $this->db->delete('m_sekolah', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Berhasil Hapus Data !</div>');
        redirect('data_persiapan/persiapan_sekolah');
    }

}
