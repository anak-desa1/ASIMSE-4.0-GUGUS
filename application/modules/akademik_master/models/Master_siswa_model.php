<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_siswa_model extends CI_Model

{
    function get_datasekolah()
    {
        $this->db->select('s.*,p.*,k.*,c.*');
        $this->db->from('m_sekolah s');
        $this->db->join('m_provinsi p', 's.sekolah_provinsi_id = p.provinsi_id', 'left');
        $this->db->join('m_kota k', 's.sekolah_kota_id = k.kota_id', 'left');
        $this->db->join('m_kecamatan c', 's.sekolah_kecamatan_id = c.kecamatan_id', 'left');
        $this->db->where('kd_sekolah', $this->session->kd_sekolah);
        $query = $this->db->get()->result_array();
        return $query;
    }
    
    // tampil data
    var $table = 'm_siswa u';
    var $column_order = array('', 'u.nama', 'lk.tingkat'); //set order berdasarkan field yang di mau
    var $column_search = array('u.nama', 'lk.tingkat'); //set field yang bisa di search
    var $order = array('u.siswa_id' => 'ASC'); // default order 

    private function _get_data()
    {
        $this->db->select('u.siswa_id,u.nis,u.nisn,u.nama,u.jk,lk.tingkat,lk.th_active');
        $this->db->from($this->table);
        $this->db->join('m_sekolah ls', 'ls.kd_sekolah = u.kd_sekolah', 'left');
        $this->db->join('m_naik_kelas lk', 'lk.nis = u.nis', 'left');
        $i = 0;
        foreach ($this->column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // cek kalo ada search data
            {
                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open group like or like
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close group like or like
            }
            $i++;
        }
        $this->db->group_start(); // open group like or like
        $this->db->where('u.kd_sekolah', $this->session->kd_sekolah);
        // $this->db->where(['u.stat_data' => 'K']);
        $this->db->group_end(); //close group like or like
        if (isset($_POST['order'])) // cek kalo click order
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function tampildata()
    {
        $this->_get_data();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function count_filtered()
    {
        $this->_get_data();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    // end tampil data 

    public function get_tampil($id)
    {
        $bagidata =
            $this->db->select('*')
            ->from('m_siswa')
            ->where(['siswa_id' => $id])
            ->get()->row_array();
        return $bagidata;
    }
}