<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Status_pegawai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_aktif_login();
        cek_akses_user();
        is_logged_in();
        $this->load->library('form_validation');
        $this->load->model('Status_pegawai_model', 'status_pegawai');
    }

    public function index()
    {
        if ($this->form_validation->run() == false) {
            $this->benchmark->mark('code_start');
            $data['title'] = 'Status Pegawai';
            $data['home'] = 'Master Pegawai';
            $data['subtitle'] = $data['title'];
            $data['main_menu'] = main_menu();
            $data['sub_menu'] = sub_menu();
            $data['cek_akses'] = cek_akses_user();
            $data['pegawai'] = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai')])->row_array();
            $data['pegawai'] = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai'), 'kd_gugus' => $this->session->userdata('kd_gugus')])->row_array();
            $data['pegawai'] = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai'), 'kd_sekolah' => $this->session->userdata('kd_sekolah')])->row_array();
                     
            $data['gugus'] = $this->db->get('m_gugus')->row_array();
            $data['sekolah'] = $this->db->get('m_sekolah')->row_array();
            $data['role'] = $this->db->get('pegawai_role')->result_array();
           
            $data['data_pegawai'] = $this->status_pegawai->get_data_admin();   

            $this->load->view('layout/header-top',$data);
            $this->load->view('master_pegawai/status_pegawai/list_css');
            $this->load->view('layout/header-bottom',$data);         
            $this->load->view('layout/main-navigation', $data);
            $this->load->view('master_pegawai/status_pegawai/list', $data);
            $this->load->view('layout/footer-top');
            $this->load->view('master_pegawai/status_pegawai/list_js');
            $this->load->view('layout/footer-bottom');
            $this->benchmark->mark('code_end');
        } else {
        }
    }

    public function tampildata()
    {
        $pegawai = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai')])->row_array();
        $pegawai = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai'), 'kd_gugus' => $this->session->userdata('kd_gugus')])->row_array();
        $pegawai = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai'), 'kd_sekolah' => $this->session->userdata('kd_sekolah')])->row_array();
                 
        $gugus = $this->db->get('m_gugus')->row_array();
        $sekolah = $this->db->get('m_sekolah')->row_array();

        if($pegawai['kd_gugus'] == $gugus['kd_gugus']){
            cek_post();
            $list = $this->status_pegawai->tampildata();
            // var_dump($list);
            // die;
            $record = array();
            $no = $_POST['start'];
            foreach ($list as $data) 
                if ($data['kd_gugus'] == $gugus['kd_gugus']){
                $no++;
    
                // tombol action - dicek juga punya akses apa engga gengs....
                $tombol_action = (cek_akses_user()['role_id'] == 1 ? '<a href="status_pegawai/editdata/' . $data['data_id'] . '" class="btn btn-outline-success btn-sm"><i class="bi bi-person-check"></i> Proses</a>':'').
                (cek_akses_user()['role_id'] == 1 ? ' <a href="status_pegawai/deldata/' . $data['nik'] . '" class="btn btn-outline-danger btn-sm"> <i class="bi bi-trash-fill"></i> Hapus</a>' : '');
                // column buat data tables --
                $row = [
                    'no' => $no,
                    'nik' => $data['kd_gugus'],
                    'nama_lengkap' => $data['nama_lengkap'],
                    'telp' => $data['telp'],
                    'email_pribadi' => $data['email_pribadi'].'<br/>'.$data['email_pegawai'],
                    'tgl_masuk' => $data['tgl_masuk'],
                    'is_active' => ($data['is_active'] == 1 ? "<i class='text-info'>User Aktif</i>" : "<i class='text-danger'>User Tidak Aktif</i>"),
                    'role' => $data['role'],
                    'action' => $tombol_action,
                ];
                $record[] = $row;
            }
            $output = array(
                "draw" => $this->input->post('draw'),
                "recordsTotal" => $this->status_pegawai->count_all(),
                "recordsFiltered" => $this->status_pegawai->count_filtered(),
                "data" => $record,
            );
            //output to json format
            echo json_encode($output);
        }
        if($pegawai['kd_sekolah'] == $sekolah['kd_sekolah']){
            cek_post();
            $list = $this->status_pegawai->tampildata();
            // var_dump($list);
            // die;
            $record = array();
            $no = $_POST['start'];
            foreach ($list as $data) 
                if ($data['kd_sekolah'] == $sekolah['kd_sekolah']) {                
                $no++;
    
                // tombol action - dicek juga punya akses apa engga gengs....
                $tombol_action = (cek_akses_user()['role_id'] == 1 ? '<a href="status_pegawai/editdata/' . $data['data_id'] . '" class="btn btn-outline-info">Proses</a>' : '') ;
                // column buat data tables --
                $row = [
                    'no' => $no,
                    'nik' => $data['nik'],
                    'nama_lengkap' => $data['nama_lengkap'],
                    'telp' => $data['telp'],
                    'email_pribadi' => $data['email_pribadi'],
                    'tgl_masuk' => $data['tgl_masuk'],
                    'is_active' => ($data['is_active'] == 1 ? "<i class='text-info'>User Aktif</i>" : "<i class='text-danger'>User Tidak Aktif</i>"),
                    'role' => $data['role'],
                    'action' => $tombol_action,
                ];
                $record[] = $row;
            }
            $output = array(
                "draw" => $this->input->post('draw'),
                "recordsTotal" => $this->status_pegawai->count_all(),
                "recordsFiltered" => $this->status_pegawai->count_filtered(),
                "data" => $record,
            );
            //output to json format
            echo json_encode($output);
        } 
     
    }

    public function editData($id)
    {
        $this->benchmark->mark('code_start');
        $data['title'] = 'Status Pegawai';
        $data['home'] = 'Master Pegawai';
        $data['subtitle'] = $data['title'];
        $data['main_menu'] = main_menu();
        $data['sub_menu'] = sub_menu();
        $data['cek_akses'] = cek_akses_user();
        $data['pegawai'] = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai')])->row_array();
        $data['pegawai'] = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai'), 'kd_gugus' => $this->session->userdata('kd_gugus')])->row_array();
        $data['pegawai'] = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai'), 'kd_sekolah' => $this->session->userdata('kd_sekolah')])->row_array();
                 
        $data['gugus'] = $this->db->get('m_gugus')->row_array();
        $data['sekolah'] = $this->db->get('m_sekolah')->row_array();

        $data['data_pegawai'] = $this->status_pegawai->get_editData($id);
        $data['role'] = $this->db->get_where('pegawai_role',['status' => 0 ])->result_array();
        
        $this->load->view('layout/header-top',$data);
        $this->load->view('master_pegawai/status_pegawai/edit_css');
        $this->load->view('layout/header-bottom',$data);
        $this->load->view('layout/main-navigation', $data);
        $this->load->view('master_pegawai/status_pegawai/list_edit', $data);
        $this->load->view('layout/footer-top');
        $this->load->view('master_pegawai/status_pegawai/edit_js');
        $this->load->view('layout/footer-bottom');
        $this->benchmark->mark('code_end');
    }

    public function updateData()
    {
        cek_post();
        if (cek_akses_user()['role_id'] == 0) {
            redirect(base_url('unauthorized'));
        }
        echo $this->status_pegawai->updateData();
        $this->session->set_flashdata('message', ' 
        <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i>Ubah Data ! </h5>
        </div>
        ');
        redirect('master_pegawai/status_pegawai');
    }

    public function deldata($id)
    {
        $data = ['nik' => $id];
        $this->db->delete('pegawai', $data);
        $this->session->set_flashdata('message', ' 
        <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i>Berhasil Hapus Data ! </h5>
        </div>
        ');
        redirect('master_pegawai/status_pegawai');
    }

    public function create()
    {
        $this->benchmark->mark('code_start');
        $data['title'] = 'Data Pegawai';
        $data['home'] = 'Master Data';
        $data['subtitle'] = $data['title'];
        $data['main_menu'] = main_menu();
        $data['sub_menu'] = sub_menu();
        $data['cek_akses'] = cek_akses_user();
        $data['pegawai'] = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai')])->row_array();
        $data['pegawai'] = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai'), 'kd_gugus' => $this->session->userdata('kd_gugus')])->row_array();
        $data['pegawai'] = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai'), 'kd_sekolah' => $this->session->userdata('kd_sekolah')])->row_array();
                
        $data['gugus'] = $this->db->get('m_gugus')->row_array();
        $data['sekolah'] = $this->db->get('m_sekolah')->row_array();

        $this->load->view('layout/header-top',$data);
        $this->load->view('master_pegawai/status_pegawai/list_css');
        $this->load->view('layout/header-bottom',$data);
        // $this->load->view('layout/header-notif');
        $this->load->view('layout/main-navigation', $data);
        $this->load->view('master_pegawai/status_pegawai/list_create', $data);
        $this->load->view('layout/footer-top');
        $this->load->view('master_pegawai/status_pegawai/list_js');
        $this->load->view('layout/footer-bottom');
        $this->benchmark->mark('code_end');
    }

    public function lakukan_download()
    {
        force_download('panel/dist/excel/Template_PegawaiData.xlsx', NULL);
    }

    public function excel()
    {
        if (isset($_FILES["file"]["name"])) {

            $pegawai = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai'), 'kd_gugus' => $this->session->userdata('kd_gugus')])->row_array();
            $pegawai = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai'), 'kd_sekolah' => $this->session->userdata('kd_sekolah')])->row_array();
            $gugus = $this->db->get('m_gugus')->row_array();
            $sekolah = $this->db->get('m_sekolah')->row_array(); 

            if($pegawai['kd_gugus'] == $gugus['kd_gugus']){
                   // upload
                $file_tmp = $_FILES['file']['tmp_name'];
                $file_name = $_FILES['file']['name'];
                $file_size = $_FILES['file']['size'];
                $file_type = $_FILES['file']['type'];
                // move_uploaded_file($file_tmp,"uploads/".$file_name); // simpan filenya di folder uploads

                $object = PHPExcel_IOFactory::load($file_tmp);

                foreach ($object->getWorksheetIterator() as $worksheet) {

                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();

                    for ($row = 4; $row <= $highestRow; $row++) {

                        $nik = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $email_pribadi = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $email = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $nama_lengkap = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $alamat = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $telp = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $tgl_lahir = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $tgl_masuk = $worksheet->getCellByColumnAndRow(7, $row)->getValue();

                        $gugus = $this->db->get('m_gugus')->row_array();
                        $data_web = substr($gugus['web'], 4, 100);
                        $kd_gugus = $gugus['kd_gugus'];

                        $data[] = array( 
                            "nik" => $nik,
                            "kd_gugus" =>  $kd_gugus,
                            "email_pribadi" => $email_pribadi,
                            "email" => $email ."@". $data_web,
                            "nama_lengkap" => $nama_lengkap,
                            "alamat" => $alamat,
                            "telp" => $telp,
                            "tgl_lahir" => $tgl_lahir,
                            "tgl_masuk" => $tgl_masuk,              
                            "foto" => 'default.jpg',
                        );
                    }
                }
                $this->db->insert_batch('pegawai_data', $data);
                $message = array(
                    'message' => '<div class="alert alert-success">Import file excel berhasil disimpan di database</div>',
                );

                $this->session->set_flashdata($message);
                redirect('master_pegawai/status_pegawai');
            } 
            if($pegawai['kd_sekolah'] == $sekolah['kd_sekolah']){
                   // upload
                $file_tmp = $_FILES['file']['tmp_name'];
                $file_name = $_FILES['file']['name'];
                $file_size = $_FILES['file']['size'];
                $file_type = $_FILES['file']['type'];
                // move_uploaded_file($file_tmp,"uploads/".$file_name); // simpan filenya di folder uploads

                $object = PHPExcel_IOFactory::load($file_tmp);

                foreach ($object->getWorksheetIterator() as $worksheet) {

                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();

                    for ($row = 4; $row <= $highestRow; $row++) {

                        $nik = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $email_pribadi = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $email = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $nama_lengkap = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $alamat = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $telp = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $tgl_lahir = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $tgl_masuk = $worksheet->getCellByColumnAndRow(7, $row)->getValue();

                        $sekolah = $this->db->get('m_sekolah')->row_array();
                        $data_web = substr($sekolah['web'], 4, 100);
                        $kd_sekolah = $sekolah['kd_sekolah'];

                        $data[] = array(
                            "nik" => $nik,
                            "kd_sekolah" =>  $kd_sekolah,
                            "email_pribadi" => $email_pribadi,
                            "email" => $email ."@". $data_web,
                            "nama_lengkap" => $nama_lengkap,
                            "alamat" => $alamat,
                            "telp" => $telp,
                            "tgl_lahir" => $tgl_lahir,
                            "tgl_masuk" => $tgl_masuk,              
                            "foto" => 'default.jpg',
                        );
                    }
                }
                $this->db->insert_batch('pegawai_data', $data);
                $message = array(
                    'message' => '<div class="alert alert-success">Import file excel berhasil disimpan di database</div>',
                );

                $this->session->set_flashdata($message);
                redirect('master_pegawai/status_pegawai');
            }          
        } else {
            $message = array(
                'message' => '<div class="alert alert-danger">Import file gagal, coba lagi</div>',
            );

            $this->session->set_flashdata($message);
            redirect('master_pegawai/status_pegawai');
        }
    }
}

/* End of file Import.php */
/* Location: ./application/controllers/Import.php */
