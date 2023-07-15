<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PersiapanGugus_model extends CI_Model
{
    public function getLGugus()
    {
        $this->db->select('*');
        $this->db->from('m_gugus');
        $this->db->join('m_provinsi', 'gugus_provinsi_id = provinsi_id', 'left');
        $this->db->join('m_kota', 'gugus_kota_id = kota_id', 'left');
        $this->db->join('m_kecamatan', 'gugus_kecamatan_id = kecamatan_id', 'left');
        $query = $this->db->get()->row_array();
        return $query;
    }
}
