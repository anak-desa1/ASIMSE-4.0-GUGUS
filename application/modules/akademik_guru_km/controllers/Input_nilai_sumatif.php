<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Input_nilai_sumatif extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        cek_aktif_login();
        cek_akses_user();
        is_logged_in();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Input_nilai_sumatif_model', 'input_nilai_sumatif');
    }

    public function index()
    {
        if ($this->form_validation->run() == false) {
            $this->benchmark->mark('code_start');
            $data['title'] = 'Input Nilai Sumatif';
            $data['home'] = 'Rapor Guru';
            $data['subtitle'] = $data['title'];
            $data['main_menu'] = main_menu();
            $data['sub_menu'] = sub_menu();
            $data['cek_akses'] = cek_akses_user();
            $data['pegawai'] = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai')])->row_array();
            $data['pegawai'] = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai'), 'kd_gugus' => $this->session->userdata('kd_gugus')])->row_array();
            $data['pegawai'] = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai'), 'kd_sekolah' => $this->session->userdata('kd_sekolah')])->row_array();
                    
            $data['gugus'] = $this->db->get('m_gugus')->row_array();
            $data['sekolah'] = $this->db->get('m_sekolah')->row_array();

            $get_tasm = $this->db->get_where('t_tahun', ['aktif' => 'Y'])->row_array();
            $data['tasm'] = $get_tasm['tahun'];
            $data['tahun'] = substr($data['tasm'], 0, 4);
            $data['semester'] = substr($data['tasm'], -1, 1);

            $data['tampil'] = $this->input_nilai_sumatif->get_tampil();
            // var_dump($data['tampil']);
            // die;

            $this->load->view('layout/header-top', $data);
            $this->load->view('akademik_guru_km/input_nilai_sumatif/input_nilai_sumatif_css');
            $this->load->view('layout/header-bottom', $data);
            $this->load->view('layout/main-navigation', $data);
            $this->load->view('akademik_guru_km/input_nilai_sumatif/input_nilai_sumatif_v', $data);
            $this->load->view('layout/footer-top');
            $this->load->view('akademik_guru_km/input_nilai_sumatif/input_nilai_sumatif_js');
            $this->load->view('layout/footer-bottom');
            $this->benchmark->mark('code_end');
        } else {
        }
    }

    // nilai sumatif
    public function nilai_sumatif($id)
    {
        if ($this->form_validation->run() == false) {
            $this->benchmark->mark('code_start');
            $data['title'] = 'Input Nilai Sumatif';
            $data['home'] = 'Rapor Guru';
            $data['subtitle'] = $data['title'];
            $data['main_menu'] = main_menu();
            $data['sub_menu'] = sub_menu();
            $data['cek_akses'] = cek_akses_user();
            $data['pegawai'] = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai')])->row_array();
            $data['sekolah'] = $this->db->get('m_sekolah')->row_array();
            // var_dump($data['data_pegawai']);
            // die;  
            $data['data'] = $this->input_nilai_sumatif->detil_guru($id);
            $data['siswa'] = $this->input_nilai_sumatif->get_detailsiswa($id);
            $data['header'] = $this->input_nilai_sumatif->get_detailnilai($id);
            $data['nilai'] = $this->input_nilai_sumatif->get_nilai_sumatif($id);
            $data['nilai_sas'] = $this->input_nilai_sumatif->get_detailnilai_pas($id);
           
            $get_tasm = $this->db->get_where('t_tahun', ['aktif' => 'Y'])->row_array();
            $data['tasm'] = $get_tasm['tahun'];
            $data['ta'] = substr($data['tasm'], 4);
            $data['tahun'] = substr($data['tasm'], 0, 4);
            $data['semester'] = substr($data['tasm'], -1, 1);

            $this->load->view('layout/header-top', $data);
            $this->load->view('akademik_guru_km/nilai_asesmen_sumatif/nilai_asesmen_sumatif_css');
            $this->load->view('layout/header-bottom', $data);
            $this->load->view('layout/main-navigation', $data);
            $this->load->view('akademik_guru_km/nilai_asesmen_sumatif/nilai_asesmen_sumatif_v', $data);
            $this->load->view('layout/footer-top');
            $this->load->view('akademik_guru_km/nilai_asesmen_sumatif/nilai_asesmen_sumatif_js');
            $this->load->view('layout/footer-bottom');
            $this->benchmark->mark('code_end');
        } else {
        }
    }

    public function tambah_sumatif($id)
    {
        if ($this->form_validation->run() == false) {
            $this->benchmark->mark('code_start');
            $data['title'] = 'Input Nilai Sumatif';
            $data['home'] = 'Rapor Guru';
            $data['subtitle'] = $data['title'];
            $data['main_menu'] = main_menu();
            $data['sub_menu'] = sub_menu();
            $data['cek_akses'] = cek_akses_user();
            $data['pegawai'] = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai')])->row_array();
            $data['sekolah'] = $this->db->get('m_sekolah')->row_array();
            // var_dump($data['data_pegawai']);
            // die;  
           
            $get_tasm = $this->db->get_where('t_tahun', ['aktif' => 'Y'])->row_array();
            $data['tasm'] = $get_tasm['tahun'];
            $data['ta'] = substr($data['tasm'], 4);
            $data['tahun'] = substr($data['tasm'], 0, 4);
            $data['semester'] = substr($data['tasm'], -1, 1);

            $data['data'] = $this->input_nilai_sumatif->detil_guru($id);
            $data['mapel'] = $this->input_nilai_sumatif->get_mapel($id);
            $data['tingkat'] = $this->input_nilai_sumatif->get_tingkat($id);

            $data['siswa'] = $this->input_nilai_sumatif->get_detailsiswa($id);
            $data['header'] = $this->input_nilai_sumatif->get_detailnilai($id);
            $data['nilai'] = $this->input_nilai_sumatif->get_detailnilai($id);

            $this->load->view('layout/header-top', $data);
            $this->load->view('akademik_guru_km/nilai_asesmen_sumatif/nilai_asesmen_sumatif_css');
            $this->load->view('layout/header-bottom', $data);
            $this->load->view('layout/main-navigation', $data);
            $this->load->view('akademik_guru_km/nilai_asesmen_sumatif/nilai_asesmen_sumatif_add', $data);
            $this->load->view('layout/footer-top');
            $this->load->view('akademik_guru_km/nilai_asesmen_sumatif/nilai_asesmen_sumatif_js');
            $this->load->view('layout/footer-bottom');
            $this->benchmark->mark('code_end');
        } else {
        }
    }  

    public function tabel_sumatif($id)
    {
        $data['pegawai'] = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai')])->row_array();
        $get_tasm = $this->db->get_where('t_tahun', ['aktif' => 'Y'])->row_array();
        $data['tasm'] = $get_tasm['tahun'];
        $data['ta'] = substr($data['tasm'], 0, 4);

        $data['data'] = $this->input_nilai_sumatif->detil_guru($id);
        $data['mapel'] = $this->input_nilai_sumatif->get_mapel($id);
        $data['tingkat'] = $this->input_nilai_sumatif->get_tingkat($id);
        $data['siswa'] = $this->input_nilai_sumatif->get_detailsiswa($id);

        $get_tasm = $this->db->get_where('t_tahun', ['aktif' => 'Y'])->row_array();
        $semester = $get_tasm['semester'];
        $data['sumatif'] = $this->db->get_where('t_mapel_sumatif', ['semester' => $semester, 'id_mapel' => $id, 'id_guru' => $this->session->userdata('nik')])->result_array();

        $this->load->view('akademik_guru_km/nilai_asesmen_sumatif/nilai_asesmen_sumatif_table', $data);
    }

    public function nilai_sumatif_simpan()
    {
        cek_post();
        if (cek_akses_user()['role_id'] == 0) {
            redirect(base_url('unauthorized'));
        }
        echo $this->input_nilai_sumatif->nilai_sumatif_simpan();
        $mapel_id = $this->input->post('mapel_id');
        redirect('akademik_guru_km/input_nilai_sumatif/tambah_sumatif/' . $mapel_id);
    }

    public function tabel_pas($id)
    {
        $data['pegawai'] = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai')])->row_array();
        $get_tasm = $this->db->get_where('t_tahun', ['aktif' => 'Y'])->row_array();
        $data['tasm'] = $get_tasm['tahun'];
        $data['ta'] = substr($data['tasm'], 0, 4);

        $data['data'] = $this->input_nilai_sumatif->detil_guru($id);
        $data['mapel'] = $this->input_nilai_sumatif->get_mapel($id);
        $data['tingkat'] = $this->input_nilai_sumatif->get_tingkat($id);
        $data['siswa'] = $this->input_nilai_sumatif->get_detailsiswa($id);

        $get_tasm = $this->db->get_where('t_tahun', ['aktif' => 'Y'])->row_array();
        $semester = $get_tasm['semester'];
        $data['semester'] = $get_tasm['semester'];
        // $data['sumatif'] = $this->db->get_where('t_mapel_kd', ['semester' => $semester, 'id_mapel' => $id, 'id_guru' => $this->session->userdata('nik')])->result_array();

        $this->load->view('akademik_guru_km/nilai_asesmen_sumatif/nilai_asesmen_sumatif_table_pas', $data);
    }

    public function nilai_pas_simpan()
    {
        cek_post();
        if (cek_akses_user()['role_id'] == 0) {
            redirect(base_url('unauthorized'));
        }
        echo $this->input_nilai_sumatif->nilai_pas_simpan();
        $mapel_id = $this->input->post('mapel_id');
        redirect('akademik_guru_km/input_nilai_sumatif/tambah_sumatif/' . $mapel_id);
    }    

    public function edit_sumatif($id, $kd, $pen, $jenis)
    {
        if ($this->form_validation->run() == false) {
            $this->benchmark->mark('code_start');
            $data['title'] = 'Input Nilai Sumatif';
            $data['home'] = 'Rapor Guru';
            $data['subtitle'] = $data['title'];
            $data['main_menu'] = main_menu();
            $data['sub_menu'] = sub_menu();
            $data['cek_akses'] = cek_akses_user();
            $data['pegawai'] = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai')])->row_array();
            $data['sekolah'] = $this->db->get('m_sekolah')->row_array();
            // var_dump($data['data_pegawai']);
            // die;  
            $data['data'] = $this->input_nilai_sumatif->edit_guru($id);
            $data['siswa'] = $this->input_nilai_sumatif->edit_siswa($id);
            $data['header'] = $this->input_nilai_sumatif->edit_nilai($id, $kd, $pen, $jenis);
            $data['nilai'] = $this->input_nilai_sumatif->edit_nilai($id, $kd, $pen, $jenis);

            $this->load->view('layout/header-top', $data);
            $this->load->view('akademik_guru_km/nilai_asesmen_sumatif/nilai_asesmen_sumatif_css');
            $this->load->view('layout/header-bottom', $data);
            $this->load->view('layout/main-navigation', $data);
            $this->load->view('akademik_guru_km/nilai_asesmen_sumatif/nilai_asesmen_sumatif_edit', $data);
            $this->load->view('layout/footer-top');
            $this->load->view('akademik_guru_km/nilai_asesmen_sumatif/nilai_asesmen_sumatif_js');
            $this->load->view('layout/footer-bottom');
            $this->benchmark->mark('code_end');
        } else {
        }
    }

    public function update_sumatif_simpan()
    {
        cek_post();
        if (cek_akses_user()['role_id'] == 0) {
            redirect(base_url('unauthorized'));
        }
        echo $this->input_nilai_sumatif->update_sumatif_simpan();
        $this->session->set_flashdata('message', ' 
        <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i>Berhasil Ubah Nilai ! </h5>
        </div>
        ');
        $mapel_id = $this->input->post('mapel_id');
        $sumatif_id = $this->input->post('sumatif_id');
        $penilaian = $this->input->post('penilaian');
        $jenis = $this->input->post('jenis');
        redirect('akademik_guru_km/input_nilai_sumatif/edit_sumatif/' . $mapel_id . '/' . $sumatif_id . '/' . $penilaian . '/' . $jenis);
    }

    public function delete_sumatif($id, $kd, $pen, $jenis)
    {
        if ($this->form_validation->run() == false) {
            $this->benchmark->mark('code_start');
            $data['title'] = 'Input Nilai';
            $data['home'] = 'Rapor Guru';
            $data['subtitle'] = $data['title'];
            $data['main_menu'] = main_menu();
            $data['sub_menu'] = sub_menu();
            $data['cek_akses'] = cek_akses_user();
            $data['pegawai'] = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai')])->row_array();
            $data['sekolah'] = $this->db->get('m_sekolah')->row_array();
            // var_dump($data['data_pegawai']);
            // die;  
            $data['data'] = $this->input_nilai_sumatif->edit_guru($id);
            $data['siswa'] = $this->input_nilai_sumatif->edit_siswa($id);
            $data['header'] = $this->input_nilai_sumatif->hapus_nilai($id, $kd, $pen, $jenis);
            $data['nilai'] = $this->input_nilai_sumatif->hapus_nilai($id, $kd, $pen, $jenis);

            $this->load->view('layout/header-top', $data);
            $this->load->view('akademik_guru_km/nilai_asesmen_sumatif/nilai_asesmen_sumatif_css');
            $this->load->view('layout/header-bottom', $data);
            $this->load->view('layout/main-navigation', $data);
            $this->load->view('akademik_guru_km/nilai_asesmen_sumatif/nilai_asesmen_sumatif_delete', $data);
            $this->load->view('layout/footer-top');
            $this->load->view('akademik_guru_km/nilai_asesmen_sumatif/nilai_asesmen_sumatif_js');
            $this->load->view('layout/footer-bottom');
            $this->benchmark->mark('code_end');
        } else {
        }
    }

    public function delete_sumatif_data()
    {
        $id = $_POST['id'];
        $this->db->where_in('id', $id);
        $this->db->delete('t_nilai_sumatif');
        $this->session->set_flashdata('message', ' 
        <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i>Berhasil Hapus Data ! </h5>
        </div>
        ');
        $mapel_id = $this->input->post('mapel_id');
        redirect('akademik_guru_km/input_nilai_sumatif/tambah_sumatif/' . $mapel_id);
    }

    public function export_excel_sumatif($id)
    {
        $kolom_hidden = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "AA", "AB", "AC", "AD", "AE", "AF", "AG", "AH", "AI", "AJ", "AK", "AL", "AM", "AN", "AO", "AP", "AQ", "AR", "AS", "AT", "AU", "AV", "AW", "AX", "AY", "AZ");
        $kolom_xl = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "AA", "AB", "AC", "AD", "AE", "AF", "AG", "AH", "AI", "AJ", "AK", "AL", "AM", "AN", "AO", "AP", "AQ", "AR", "AS", "AT", "AU", "AV", "AW", "AX", "AY", "AZ");
        $header = $this->input_nilai_sumatif->detil_guru($id);
        $sekolah = $this->db->get('m_sekolah')->row_array();

        $get_tasm = $this->db->get_where('t_tahun', ['aktif' => 'Y'])->row_array();
        $tasm = $get_tasm['tahun'];
        $data['ta'] = substr($tasm, 4);      
        $semester = $get_tasm['semester'];

        $data['siswa'] = $this->input_nilai_sumatif->get_detailsiswa($id);
        $data['nilai'] = $this->input_nilai_sumatif->get_exportnilai_pas($id);

        // require_once(APPPATH . 'libraries/PHPExcel.php');
        // require_once(APPPATH . 'libraries/PHPExcel/Writer/Excel2007.php');
        $this->load->library('excel');

        $object = new PHPExcel();

        $object->getProperties()->setCreator("SISTEM ANAK DESA");
        $object->getProperties()->setLastModifiedBy("SISTEM ANAK DESA");
        $object->getProperties()->setTitle("Nilai Pengetahuan");

        $object->setActiveSheetIndex(0);

        $object->setActiveSheetIndex(0)->setCellValue('A1', "Nama Sekolah");
        $object->getActiveSheet()->mergeCells('A1:B1');
        $object->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $object->getActiveSheet()->getStyle('A1')->getFont()->setSize(12); // Set font size 15 untuk kolom A1
        $object->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $object->getActiveSheet()->setCellValue('C1', ':' . ' ' . $sekolah['nama_sekolah']);
        $object->getActiveSheet()->getStyle('C1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $object->getActiveSheet()->getStyle('C1')->getFont()->setSize(12); // Set font size 15 untuk kolom A1
        $object->getActiveSheet()->getStyle('C1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $object->setActiveSheetIndex(0)->setCellValue('A2', "Kelas");
        $object->getActiveSheet()->mergeCells('A2:B2');
        $object->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1
        $object->getActiveSheet()->getStyle('A2')->getFont()->setSize(12); // Set font size 15 untuk kolom A1
        $object->getActiveSheet()->getStyle('A2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $object->getActiveSheet()->setCellValue('C2', ':' . ' ' . $header['rombel']);
        $object->getActiveSheet()->getStyle('C2')->getFont()->setBold(TRUE); // Set bold kolom A1
        $object->getActiveSheet()->getStyle('C2')->getFont()->setSize(12); // Set font size 15 untuk kolom A1
        $object->getActiveSheet()->getStyle('C2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $object->setActiveSheetIndex(0)->setCellValue('A3', "Mata Pelajaran");
        $object->getActiveSheet()->mergeCells('A3:B3');
        $object->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE); // Set bold kolom A1
        $object->getActiveSheet()->getStyle('A3')->getFont()->setSize(12); // Set font size 15 untuk kolom A1
        $object->getActiveSheet()->getStyle('A3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $object->getActiveSheet()->setCellValue('C3', ':' . ' ' . $header['nama']);
        $object->getActiveSheet()->getStyle('C3')->getFont()->setBold(TRUE); // Set bold kolom A1
        $object->getActiveSheet()->getStyle('C3')->getFont()->setSize(12); // Set font size 15 untuk kolom A1
        $object->getActiveSheet()->getStyle('C3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $object->setActiveSheetIndex(0)->setCellValue('A4', "Guru MaPel");
        $object->getActiveSheet()->mergeCells('A4:B4');
        $object->getActiveSheet()->getStyle('A4')->getFont()->setBold(TRUE); // Set bold kolom A1
        $object->getActiveSheet()->getStyle('A4')->getFont()->setSize(12); // Set font size 15 untuk kolom A1
        $object->getActiveSheet()->getStyle('A4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $object->getActiveSheet()->setCellValue('C4', ':' . ' ' . $header['mapel_id'] . ' ' . '|' . ' ' . $header['nama_lengkap']);
        $object->getActiveSheet()->getStyle('C4')->getFont()->setBold(TRUE); // Set bold kolom A1
        $object->getActiveSheet()->getStyle('C4')->getFont()->setSize(12); // Set font size 15 untuk kolom A1
        $object->getActiveSheet()->getStyle('C4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $object->setActiveSheetIndex(0)->setCellValue('A6', "No");
        // $object->getActiveSheet()->mergeCells('A6');
        $object->getActiveSheet()->getStyle('A6')->getFont()->setBold(TRUE); // Set bold kolom A1
        $object->getActiveSheet()->getStyle('A6')->getFont()->getColor()->setARGB('ffffff');
        $object->getActiveSheet()->getStyle('A6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('041170'); // Set bold kolom A1
        $object->getActiveSheet()->getStyle('A6')->getFont()->setSize(14); // Set font size 15 untuk kolom A1
        $object->getActiveSheet()->getStyle('A6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $object->getActiveSheet()->getStyle('A6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $object->setActiveSheetIndex(0)->setCellValue('B6', "NIS");
        // $object->getActiveSheet()->mergeCells('B6');
        $object->getActiveSheet()->getStyle('B6')->getFont()->setBold(TRUE); // Set bold kolom A1
        $object->getActiveSheet()->getStyle('B6')->getFont()->getColor()->setARGB('ffffff');
        $object->getActiveSheet()->getStyle('B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('041170'); // Set bold kolom A1
        $object->getActiveSheet()->getStyle('B6')->getFont()->setSize(14); // Set font size 15 untuk kolom A1
        $object->getActiveSheet()->getStyle('B6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $object->getActiveSheet()->getStyle('B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $object->setActiveSheetIndex(0)->setCellValue('C6', "Nama Siswa");
        // $object->getActiveSheet()->mergeCells('C6:C7');
        $object->getActiveSheet()->getStyle('C6')->getFont()->setBold(TRUE); // Set bold kolom A1
        $object->getActiveSheet()->getStyle('C6')->getFont()->getColor()->setARGB('ffffff');
        $object->getActiveSheet()->getStyle('C6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('041170'); // Set bold kolom A1
        $object->getActiveSheet()->getStyle('C6')->getFont()->setSize(14); // Set font size 15 untuk kolom A1
        $object->getActiveSheet()->getStyle('C6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $object->getActiveSheet()->getStyle('C6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $baris_a = 7;
        $baris_b = 7;
        $no = 1;
        $kolomdanbaris1 = 3;
        foreach ($data['siswa'] as $s) {

            $object->getActiveSheet()->setCellValue('A' .  $baris_a, $no++);
            $object->getActiveSheet()->setCellValue('B' .  $baris_a, $s['nis']);
            $object->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $object->getActiveSheet()->setCellValue('C' .  $baris_a, $s['nama']);
            $baris_a++;
            
            // SUMATIF          
            $baris_c = 3;
            $kolom_a1 = $kolomdanbaris1;
            foreach ($data['nilai'] as $a)
                if ($a['tasm'] == $tasm)
                    if ($a['id_siswa'] == $s['id_siswa']) {
                        if ($a['jenis'] == 'SUMATIF') {
                            $object->getActiveSheet()->setCellValue($kolom_hidden[$kolom_a1] . $baris_c, $a['sumatif_id']);
                            $object->getActiveSheet()->getStyle($kolom_hidden[$kolom_a1] . $baris_c)->getFont()->getColor()->setARGB('ffffff');
                            $object->getActiveSheet()->getStyle($kolom_hidden[$kolom_a1] . $baris_c)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            $kolom_a1++;
                        }
                    }

            $baris_d = 4;
            $kolom_b1 = $kolomdanbaris1;
            foreach ($data['nilai'] as $a)
                if ($a['tasm'] == $tasm)
                    if ($a['id_siswa'] == $s['id_siswa']) {
                        if ($a['jenis'] == 'SUMATIF') {
                            $object->getActiveSheet()->setCellValue($kolom_hidden[$kolom_b1] . $baris_d, $a['penilaian']);
                            $object->getActiveSheet()->getStyle($kolom_hidden[$kolom_b1] . $baris_d)->getFont()->getColor()->setARGB('ffffff');
                            $object->getActiveSheet()->getStyle($kolom_hidden[$kolom_b1] . $baris_d)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            $kolom_b1++;
                        }
                    }  
                    
            $baris_e = 5;
            $kolom_c1 = $kolomdanbaris1;
            foreach ($data['nilai'] as $a)
                if ($a['tasm'] == $tasm)
                    if ($a['id_siswa'] == $s['id_siswa']) {
                        if ($a['jenis'] == 'SUMATIF') {
                            $object->getActiveSheet()->setCellValue($kolom_hidden[$kolom_c1] . $baris_e, $a['jenis']);
                            $object->getActiveSheet()->getStyle($kolom_hidden[$kolom_c1] . $baris_e)->getFont()->getColor()->setARGB('ffffff');
                            $object->getActiveSheet()->getStyle($kolom_hidden[$kolom_c1] . $baris_e)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            $kolom_c1++;
                        }
                    }

            $baris_f = 6;
            $kolom_d1 = $kolomdanbaris1;
            foreach ($data['nilai'] as $a)
                if ($a['tasm'] == $tasm)
                    if ($a['id_siswa'] == $s['id_siswa']) {
                        if ($a['jenis'] == 'SUMATIF') {
                            $object->getActiveSheet()->setCellValue($kolom_xl[$kolom_d1] . $baris_f, 'SUMATIF' . ' ' . $a['no_sumatif']);
                            $object->getActiveSheet()->getStyle($kolom_xl[$kolom_d1] . $baris_f)->getFont()->getColor()->setARGB('ffffff');
                            $object->getActiveSheet()->getStyle($kolom_xl[$kolom_d1] . $baris_f)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('041170'); // Set bold kolom A1
                            $object->getActiveSheet()->getStyle($kolom_xl[$kolom_d1] . $baris_f)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            $kolom_d1++;
                        }
                    }            

            $kolom_e1 = $kolomdanbaris1;
            foreach ($data['nilai'] as $b)
                if ($b['tasm'] == $tasm)
                    if ($b['id_siswa'] == $s['id_siswa']) {
                        if ($b['jenis'] == 'SUMATIF') {
                            $x = $b['nilai'];
                            $object->getActiveSheet()->setCellValue($kolom_xl[$kolom_e1] . $baris_b, $x);
                            $object->getActiveSheet()->getStyle($kolom_xl[$kolom_e1] . $baris_b)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            $kolom_e1++;
                        }
                    }
            // END SUMATIF

            // PAS
            $kolomdanbaris3 = $kolom_e1++;
            $baris_c = 3;
            $kolom_a1 = $kolomdanbaris3;
            foreach ($data['nilai'] as $a)
                if ($a['tasm'] == $tasm)
                    if ($a['id_siswa'] == $s['id_siswa']) {
                        if ($a['jenis'] == 'PAS') {
                            $object->getActiveSheet()->setCellValue($kolom_hidden[$kolom_a1] . $baris_c, $semester);
                            $object->getActiveSheet()->getStyle($kolom_hidden[$kolom_a1] . $baris_c)->getFont()->getColor()->setARGB('ffffff');
                            $object->getActiveSheet()->getStyle($kolom_hidden[$kolom_a1] . $baris_c)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            $kolom_a1++;
                        }
                    }

            $baris_d = 4;
            $kolom_b1 = $kolomdanbaris3;
            foreach ($data['nilai'] as $a)
                if ($a['tasm'] == $tasm)
                    if ($a['id_siswa'] == $s['id_siswa']) {
                        if ($a['jenis'] == 'PAS') {
                            $object->getActiveSheet()->setCellValue($kolom_hidden[$kolom_b1] . $baris_d, $a['penilaian']);
                            $object->getActiveSheet()->getStyle($kolom_hidden[$kolom_b1] . $baris_d)->getFont()->getColor()->setARGB('ffffff');
                            $object->getActiveSheet()->getStyle($kolom_hidden[$kolom_b1] . $baris_d)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            $kolom_b1++;
                        }
                    }

            $baris_e = 5;
            $kolom_c1 = $kolomdanbaris3;
            foreach ($data['nilai'] as $a)
                if ($a['tasm'] == $tasm)
                    if ($a['id_siswa'] == $s['id_siswa']) {
                        if ($a['jenis'] == 'PAS') {
                            $object->getActiveSheet()->setCellValue($kolom_hidden[$kolom_c1] . $baris_e, $a['jenis']);
                            $object->getActiveSheet()->getStyle($kolom_hidden[$kolom_c1] . $baris_e)->getFont()->getColor()->setARGB('ffffff');
                            $object->getActiveSheet()->getStyle($kolom_hidden[$kolom_c1] . $baris_e)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            $kolom_c1++;
                        }
                    }
            
            $baris_f = 6;
            $kolom_d1 = $kolomdanbaris3;
            foreach ($data['nilai'] as $a)
                if ($a['tasm'] == $tasm)
                    if ($a['id_siswa'] == $s['id_siswa']) {
                        if ($a['jenis'] == 'PAS') {
                            $object->getActiveSheet()->setCellValue($kolom_xl[$kolom_d1] . $baris_f, 'SUMATIF' . ' ' . 'AS');
                            $object->getActiveSheet()->getStyle($kolom_xl[$kolom_d1] . $baris_f)->getFont()->getColor()->setARGB('ffffff');
                            $object->getActiveSheet()->getStyle($kolom_xl[$kolom_d1] . $baris_f)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('041170'); // Set bold kolom A1
                            $object->getActiveSheet()->getStyle($kolom_xl[$kolom_d1] . $baris_f)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            $kolom_d1++;
                        }
                    }            

            $kolom_e1 = $kolomdanbaris3;
            foreach ($data['nilai'] as $b)
                if ($b['tasm'] == $tasm)
                    if ($b['id_siswa'] == $s['id_siswa']) {
                        if ($b['jenis'] == 'PAS') {
                            $x = $b['nilai'];
                            $object->getActiveSheet()->setCellValue($kolom_xl[$kolom_e1] . $baris_b, $x);
                            $object->getActiveSheet()->getStyle($kolom_xl[$kolom_e1] . $baris_b)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            $kolom_e1++;
                        }
                    }
            // END PAS

            $baris_b++;
        }

        $pendidik = $header['nama_lengkap'];
        $mapel = $header['kd_singkat'];
        $rombel = $header['rombel'];
        $filemane = "ASESMEN" . '_' . $pendidik . '_' . $rombel . '-' . $mapel . '.xlsx';
        $object->getActiveSheet()->setTitle(" ASESMEN | $rombel | $mapel ");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition:attachment; filename="' . $filemane . '"');
        header('Cache-Control: max-age=0');
        $writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
        // ob_end_clean();
        ob_get_contents();
        $writer->save('php://output');
        exit;
    }

    public function import_excel_sumatif($id)
    {
        if ($this->form_validation->run() == false) {
            $this->benchmark->mark('code_start');
            $data['title'] = 'Input Nilai Sumatif';
            $data['home'] = 'Rapor Guru';
            $data['subtitle'] = $data['title'];
            $data['main_menu'] = main_menu();
            $data['sub_menu'] = sub_menu();
            $data['cek_akses'] = cek_akses_user();
            $data['pegawai'] = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai')])->row_array();
            $data['sekolah'] = $this->db->get('m_sekolah')->row_array();
            // var_dump($data['data_pegawai']);
            // die;  
            $get_tasm = $this->db->get_where('t_tahun', ['aktif' => 'Y'])->row_array();
            $data['tasm'] = $get_tasm['tahun'];
            $data['ta'] = substr($data['tasm'], 0, 4);
            // var_dump($data['pegawai']);
            // die;
            // $data['p_penilaian'] = array('Pilih Penilaian ' => 'Pilih Penilaian', 'PTS' => 'PTS', 'PAS' => 'PAS');
            $data['data'] = $this->input_nilai_sumatif->detil_guru($id);
            $data['mapel'] = $this->input_nilai_sumatif->get_mapel($id);
            $data['tingkat'] = $this->input_nilai_sumatif->get_tingkat($id);

            $this->load->view('layout/header-top', $data);
            $this->load->view('akademik_guru_km/nilai_asesmen_sumatif/nilai_asesmen_sumatif_css');
            $this->load->view('layout/header-bottom', $data);
            $this->load->view('layout/main-navigation', $data);
            $this->load->view('akademik_guru_km/nilai_asesmen_sumatif/nilai_asesmen_sumatif_import_excel', $data);
            $this->load->view('layout/footer-top');
            $this->load->view('akademik_guru_km/nilai_asesmen_sumatif/nilai_asesmen_sumatif_js');
            $this->load->view('layout/footer-bottom');
            $this->benchmark->mark('code_end');
        } else {
        }
    }

    public function upload_excel_sumatif()
    {
        if (isset($_FILES['file']['name'])) {
            $path   = $_FILES['file']['tmp_name'];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow    = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                //$n = 3;
                $n = 0;
                for ($n = 0; $n < $n + 10; $n++) {
                    $id_mapel_sumatif = $worksheet->getCellByColumnAndRow(3 + $n, 3)->getValue();
                    $penilaian = $worksheet->getCellByColumnAndRow(3 + $n, 4)->getValue();
                    $jenis = $worksheet->getCellByColumnAndRow(3 + $n, 5)->getValue();
                    if ($id_mapel_sumatif == "") {
                        break;
                    }
                    for ($row = 7; $row <= $highestRow; $row++) {
                        $id_siswa = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $nilai = $worksheet->getCellByColumnAndRow(3 + $n, $row)->getValue();
                        // var_dump($nilai);
                        // die;
                        $id_guru_mapel = $this->input->post('id_guru_mapel');
                        $tasm = $this->input->post('tasm');                        
                        $result_nilai_nph = $this->db->get_where('t_nilai_sumatif', ['id_siswa' => $id_siswa, 'id_guru_mapel' => $id_guru_mapel, 'id_mapel_sumatif' => (int)$id_mapel_sumatif, 'tasm' => $tasm, 'penilaian' => $penilaian,'jenis' => $jenis])->row_array();
                        // $data1 = [
                        //     'id_guru_mapel' => $id_guru_mapel,
                        //     'id_mapel_kd' => $id_mapel_kd,
                        //     'id_siswa' => $id_siswa,
                        //     'jenis' => 'PAS',
                        //     'tasm'  => $tasm,
                        //     'nilai' => $nilai,
                        //     'penilaian' => $penilaian,
                        // ];
                        $data2 = [
                            'nilai' => $nilai,
                        ];
                        if ($result_nilai_nph == 0) {
                            $message = array(
                                'message' => '<div class="alert alert-warning">data yang dimasukkan tidak sesuai !!!</div>',
                            );
                        } else {
                            if ($penilaian == 'PAS' ) {
                                $this->db->where('id',  $result_nilai_nph['id']);
                                $this->db->update('t_nilai_sumatif', $data2);
                            }
                            $message = array(
                                'message' => '<div class="alert alert-success">Import file excel berhasil disimpan !!!</div>',
                            );                   
                        }
                    }
                }
            }
            $this->session->set_flashdata($message);
            $mapel_id = $this->input->post('mapel_id');
            redirect('akademik_guru_km/input_nilai_sumatif/nilai_sumatif/' . $mapel_id);
        } else {
            $message = array(
                'message' => '<div class="alert alert-danger">Import file gagal, coba lagi</div>',
            );
            $this->session->set_flashdata($message);
            $mapel_id = $this->input->post('mapel_id');
            redirect('akademik_guru_km/input_nilai_sumatif/nilai_sumatif/' . $mapel_id);
        }
    }
    // end nilai sumatif   
}