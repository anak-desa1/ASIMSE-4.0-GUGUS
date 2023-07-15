<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{

    public function list_level_user()
    {
        return $this->db->get('pegawai_role')->result_array();
    }

    public function gugus()
    {       
        $data = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai'), 'kd_gugus' => $this->session->userdata('kd_gugus')])->row_array();
        $kd_gugus = $data['kd_gugus'];
        $gugus = $this->db->select('a.*,b.*,c.*,d.*')
            ->from('m_gugus a')
            ->join('m_provinsi b', 'a.gugus_provinsi_id = b.provinsi_id')
            ->join('m_kota c', 'a.gugus_kota_id = c.kota_id')
            ->join('m_kecamatan d', 'a.gugus_kecamatan_id = d.kecamatan_id', 'left')
            ->where(['a.kd_gugus' => $kd_gugus ])
            ->get()->row_array();
        return $gugus;
    }

    public function sekolah()
    {
        $data = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai'), 'kd_sekolah' => $this->session->userdata('kd_sekolah')])->row_array();
        $kd_sekolah = $data['kd_sekolah'];
        $sekolah = $this->db->select('a.*,b.*,c.*,d.*')
            ->from('m_sekolah a')
            ->join('m_provinsi b', 'a.sekolah_provinsi_id = b.provinsi_id')
            ->join('m_kota c', 'a.sekolah_kota_id = c.kota_id')
            ->join('m_kecamatan d', 'a.sekolah_kecamatan_id = d.kecamatan_id', 'left')
            ->where(['a.kd_sekolah' => $kd_sekolah ])
            ->get()->row_array();
        return $sekolah;
    }
   
    public function TotalGuru()
    {
        $total_guru = 
            $this->db->select('*,COUNT(nip) as total_guru')
                ->from('m_guru')
                ->where(['stat_data' => 'A'])                
                ->get()->result_array();
        return $total_guru;
    }

    public function TotalGuruSekolah()
    {
        $data = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai'), 'kd_sekolah' => $this->session->userdata('kd_sekolah')])->row_array();
        $kd_sekolah = $data['kd_sekolah'];
        $total_guru = 
            $this->db->select('*,COUNT(nip) as total_guru')
                ->from('m_guru')
                ->where(['stat_data' => 'A'])
                ->where(['kd_sekolah' => $kd_sekolah])
                ->get()->result_array();
        return $total_guru;
    }

    public function TotalSiswa()
    {
        $total_siswa = 
            $this->db->select('*,COUNT(nis) as total_siswa')
                ->from('m_siswa')
                ->where(['stat_data' => 'K'])
                ->get()->result_array();
        return $total_siswa;
    }

    public function TotalSiswaSekolah()
    {
        $data = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai'), 'kd_sekolah' => $this->session->userdata('kd_sekolah')])->row_array();
        $kd_sekolah = $data['kd_sekolah'];
        $total_siswa = 
            $this->db->select('*,COUNT(nis) as total_siswa')
                ->from('m_siswa')
                ->where(['stat_data' => 'K'])
                ->where(['kd_sekolah' => $kd_sekolah])
                ->get()->result_array();
        return $total_siswa;
    }

    public function TotalSekolah()
    {
        $total_sekolah = 
            $this->db->select('*,COUNT(kd_sekolah) as total_sekolah')
                ->from('m_sekolah')
                ->where(['is_active' => 1 ])
                ->get()->result_array();
        return $total_sekolah;
    }

    public function TotalOnline()
    {
        $total_online = 
            $this->db->select('*,COUNT(nik) as total_online')
                ->from('pegawai')
                ->where(['is_online' => 1])
                ->get()->result_array();
        return $total_online;
    }

    public function TotalOnlineSekolah()
    {
        $data = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai'), 'kd_sekolah' => $this->session->userdata('kd_sekolah')])->row_array();
        $kd_sekolah = $data['kd_sekolah'];

        $total_online = 
            $this->db->select('*,COUNT(nik) as total_online')
                ->from('pegawai')
                ->where(['is_online' => 1])
                ->where(['kd_sekolah' => $kd_sekolah])
                ->get()->result_array();
        return $total_online;
    }


}
