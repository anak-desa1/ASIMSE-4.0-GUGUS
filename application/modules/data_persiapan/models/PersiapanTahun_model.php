<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PersiapanTahun_model extends CI_Model
{
    public function getLTahun()
    {
        $this->db->select('*');
        $this->db->from('t_tahun');
        $this->db->group_by('id', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    public function getTahun()
    {
        $this->db->select('*');
        $this->db->from('t_tahun', 'ASC');
        $this->db->group_by('id', 'ASC');
        $query = $this->db->get();
        return $query;
    }
}
