<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Persiapan_gugus extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('form_validation');
        $this->load->model('PersiapanGugus_model', 'gugus');
    }

    public function index()
    {
        $this->form_validation->set_rules('nama_gugus', 'gugus', 'required');
        $this->form_validation->set_rules('kd_gugus', 'Kode gugus', 'required');
        $this->form_validation->set_rules('sebutan_kepala', 'Kepala Gugus', 'required');
        $this->form_validation->set_rules('nip', 'NIP', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('telp', 'Telepon', 'required');       
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('web', 'Website', 'required');
        $this->form_validation->set_rules('kodepos', 'Kode Pos', 'required');       

        if ($this->form_validation->run() == false) {
            $this->benchmark->mark('code_start');
            $data['title'] = 'Gugus';
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

            $data['sch'] = $this->gugus->getLGugus();

            $this->load->view('layout/header-top', $data);           
            $this->load->view('layout/header-bottom', $data);           
            $this->load->view('layout/main-navigation', $data);
            $this->load->view('data_persiapan/persiapan_gugus/list', $data);
            $this->load->view('layout/footer-top');           
            $this->load->view('layout/footer-bottom');
            $this->benchmark->mark('code_end');
        } else {
            $upload_image = $_FILES['logo'];
            //var_dump($upload_image);
            //die;
            if ($upload_image) {
                $config['allowed_types'] = 'jpeg|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './panel/dist/upload/logo/';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('logo')) {

                    $old_img = $this->input->post('old_image', true);
                    // var_dump($old_img);
                    // die;
                    if ($old_img != '') {
                        unlink(FCPATH . './panel/dist/upload/logo/' . $old_img);
                    }
                    $new_img = $this->upload->data('file_name');
                    $this->db->set('logo', $new_img);
                } else {
                    echo $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                }
            }
            $kd_gugus = $this->input->post('kd_gugus');
            $cekh = $this->db->get_where('m_gugus', ['kd_gugus' => $kd_gugus])->row_array();
            var_dump($kd_gugus);
            die;
            $data =
                [
                    'nama_gugus' => $this->input->post('nama_gugus'),
                    'sebutan_kepala' => $this->input->post('sebutan_kepala'),
                    'nip' => $this->input->post('nip'),
                    'alamat' => $this->input->post('alamat'),
                    'gugus_provinsi_id' => $this->input->post('gugus_provinsi_id'),
                    'gugus_kota_id' => $this->input->post('gugus_kota_id'),
                    'gugus_kecamatan_id' => $this->input->post('gugus_kecamatan_id'),
                    'telp' => $this->input->post('telp'),
                    'email' => $this->input->post('email'),
                    'web' => $this->input->post('web'),
                    'kodepos' => $this->input->post('kodepos'),
                    'is_active' => 1,           
                ];
                if ($cekh == 0) {
                    $this->db->insert('m_gugus', $data);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Berhasil Tambah Data !</div>');
                    redirect('data_persiapan/persiapan_gugus');
                } else {
                    $this->db->where('kd_gugus', $kd_gugus);
                    $this->db->update('m_gugus', $data);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Berhasil Ubah Data !</div>');
                    redirect('data_profil/profil_sekolah');
                }
           
        }
    }

    public function data_gugus()
    {
        $this->form_validation->set_rules('nama_gugus', 'gugus', 'required');
        $this->form_validation->set_rules('kd_gugus', 'Kode gugus', 'required');
        $this->form_validation->set_rules('sebutan_kepala', 'Kepala Gugus', 'required');
        $this->form_validation->set_rules('nip', 'NIP', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('telp', 'Telepon', 'required');       
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('web', 'Website', 'required');
        $this->form_validation->set_rules('kodepos', 'Kode Pos', 'required');       

        if ($this->form_validation->run() == false) {           
        } else {

            $upload_image = $_FILES['logo'];
            // var_dump($upload_image);
            // die;
            if ($upload_image) {
                $config['allowed_types'] = 'jpeg|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './panel/dist/upload/logo/';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('logo')) {

                    $old_img = $this->input->post('old_image', true);
                    // var_dump($old_img);
                    // die;
                    if ($old_img != '') {
                        unlink(FCPATH . './panel/dist/upload/logo/' . $old_img);
                    }
                    $new_img = $this->upload->data('file_name');
                    $this->db->set('logo', $new_img);
                } else {
                    echo $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                }
            }
            $kd_gugus = $this->input->post('kd_gugus');
            $cekh = $this->db->get_where('m_gugus', ['kd_gugus' => $kd_gugus])->row_array();
            // var_dump($cekh);
            // die;
            $data =
                [
                    'nama_gugus' => $this->input->post('nama_gugus'),
                    'sebutan_kepala' => $this->input->post('sebutan_kepala'),
                    'nip' => $this->input->post('nip'),
                    'alamat' => $this->input->post('alamat'),
                    'gugus_provinsi_id' => $this->input->post('gugus_provinsi_id'),
                    'gugus_kota_id' => $this->input->post('gugus_kota_id'),
                    'gugus_kecamatan_id' => $this->input->post('gugus_kecamatan_id'),
                    'telp' => $this->input->post('telp'),
                    'email' => $this->input->post('email'),
                    'web' => $this->input->post('web'),
                    'kodepos' => $this->input->post('kodepos'),
                    'is_active' => 1,           
                ];
                if ($cekh == 0) {
                    $this->db->insert('m_gugus', $data);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Berhasil Tambah Data !</div>');
                    redirect('data_persiapan/persiapan_gugus');
                } else {
                    $this->db->where('kd_gugus', $kd_gugus);
                    $this->db->update('m_gugus', $data);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Berhasil Ubah Data !</div>');
                    redirect('data_persiapan/persiapan_gugus');
                }
           
        }
    }

    // public function delGugus($sek_id)
    // {
    //     $data = ['gugus_id' => $sek_id];
    //     $this->db->delete('m_gugus', $data);
    //     $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
    //        Berhasil Hapus Data !</div>');
    //     redirect('data_persiapan/persiapan_gugus');
    // }

    // public function editGugus()
    // {
    //     $id = $this->input->post('ed_id', true);
    //     $nama_gugus = $this->input->post('ed_nama_gugus', true);
    //     $kd_gugus = $this->input->post('ed_kd_gugus', true);
    //     $data = [
    //         'nama_gugus' => $nama_gugus,
    //         'kd_gugus' => $kd_gugus,
    //     ];
    //     $this->db->where('gugus_id', $id);
    //     $this->db->update('m_gugus', $data);
    //     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    //         Berhasil Ubah Data !</div>');
    //     redirect('data_persiapan/persiapan_gugus');
    // }
}
