<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Atur_kkm_model extends CI_Model

{
    function get_datasekolah()
    {
        $this->db->select('s.*,p.*,k.*,c.*');
        $this->db->from('m_sekolah s');
        $this->db->join('m_provinsi p', 's.sekolah_provinsi_id = p.provinsi_id', 'left');
        $this->db->join('m_kota k', 's.sekolah_kota_id = k.kota_id', 'left');
        $this->db->join('m_kecamatan c', 's.sekolah_kecamatan_id = c.kecamatan_id', 'left');
        // $this->db->where('kd_sekolah', $this->session->kd_sekolah);
        $query = $this->db->get()->result_array();
        return $query;
    }
    
    // index

    public function get_kelas()
    {
        $this->db->select('*');
        $this->db->from('m_kelas');
        $this->db->group_by('tingkat', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_gururombel()
    {
        $bagidata =
            $this->db->select('k.*,s.nama_lengkap,s.foto')
            ->from('t_walikelas k')
            ->join('pegawai_data s', 'k.id_guru = s.nik', 'left')
            ->get()->result_array();
        return $bagidata;
    }

    public function get_detail($id)
    {
        $this->db->select('mk.*');
        $this->db->from('m_kelas mk');
        $this->db->where(['mk.tingkat' => $id]);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_kkm($id)
    {
        $bagidata =
            $this->db->select('tk.*,s.nama nmmapel,s.kd_singkat')
            ->from('t_kkm tk')
            ->join('m_mapel s', 'tk.id_mapel = s.id', 'left')
            ->where(['tk.kelas' => $id])
            ->get()->result_array();
        return $bagidata;
    }
  
    public function get_campus()
    {
        $this->db->select('*');
        $this->db->from('l_campus');
        $query = $this->db->get();
        return $query->result();
    }

    public function getLokasi()
    {
        return $this->db->get('l_sekolah')->result_array();
    }

    public function simpan_kkm()
    {
        $p = $this->input->post();

        $data = [
            "ta" => $p['ta'],
            "id_mapel" => $p['id_mapel'],
            "kelas" => $p['kelas'],
            "kkm" => $p['kkm'],
        ];
        $this->db->insert('t_kkm', $data);

        return json_encode(['status' => 'success', 'pesan' => 'Data berhasil disimpan !']);
    }

    public function ubah_kkm()
    {
        // cek user exist
        $id = $this->input->post('id', true);
        $p = $this->input->post();

        $data = [
            "kkm" => $p['kkm'],
        ];

        $this->db->where('id', $id);
        $this->db->update('t_kkm', $data);
        // return json_encode(['status' => 'success', 'pesan' => 'Data berhasil disimpan !']);
    }
    // end proses tambah
}
