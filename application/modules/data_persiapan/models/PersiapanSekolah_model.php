<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PersiapanSekolah_model extends CI_Model
{

    public function getSekolah()
    {
        $bagidata =
            $this->db->select('a.*, b.*')
            ->from('m_sekolah a')
            ->join('m_gugus b', 'a.kd_gugus = b.kd_gugus')           
            ->get()->result_array();
        return $bagidata;
    }

}
