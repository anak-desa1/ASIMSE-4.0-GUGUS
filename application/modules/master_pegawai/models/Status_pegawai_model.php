<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Status_pegawai_model extends CI_Model

{
    public function updateData()
    {
        $pegawai = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai'), 'kd_gugus' => $this->session->userdata('kd_gugus')])->row_array();
        $pegawai = $this->db->get_where('pegawai', ['email_pegawai' => $this->session->userdata('email_pegawai'), 'kd_sekolah' => $this->session->userdata('kd_sekolah')])->row_array();
        $gugus = $this->db->get('m_gugus')->row_array();
        $sekolah = $this->db->get('m_sekolah')->row_array();

        if($pegawai['kd_gugus'] == $gugus['kd_gugus']){
            
            $nik = $this->input->post('nik');
            $data = $this->db->get_where('pegawai_data',['nik' => $nik])->row_array();
            $kd_gugus = $data['kd_gugus'];    
            $kd_sekolah = $data['kd_sekolah'];       
            $nama_pegawai = $this->input->post('nama_pegawai');
            $email_pegawai = $this->input->post('email');
            $role_id =  $this->input->post('id');          
                       
            $data_gugus = [
                'nik' => $nik,
                'kd_gugus' => $kd_gugus,           
                'nama_pegawai' =>  $nama_pegawai,
                'email_pegawai ' => $email_pegawai,
                'password' => password_hash('12345678', PASSWORD_DEFAULT),
                'role_id' => $role_id,
                'img' => 'default.jpg',
                'is_active' => 1,
            ];

            $data_sekolah = [
                'nik' => $nik,
                'kd_sekolah' => $kd_sekolah,           
                'nama_pegawai' =>  $nama_pegawai,
                'email_pegawai ' => $email_pegawai,
                'password' => password_hash('12345678', PASSWORD_DEFAULT),
                'role_id' => $role_id,
                'img' => 'default.jpg',
                'is_active' => 1,
            ];

            if ($kd_gugus == '' ) {
                $this->db->insert('pegawai', $data_sekolah);
                // return json_encode(['status' => 'success', 'pesan' => 'Berhasil Ubah Data !']);
            } else {
                $this->db->insert('pegawai', $data_gugus);
                // return json_encode(['status' => 'success', 'pesan' => 'Berhasil Ubah Data !']);
            }
            
        }
        if($pegawai['kd_sekolah'] == $sekolah['kd_sekolah']){
            $kd_sekolah = $sekolah['kd_sekolah'];
            $nik = $this->input->post('nik');       
            $nama_pegawai = $this->input->post('nama_pegawai');
            $email_pegawai = $this->input->post('email');
            $role_id =  $this->input->post('id');
      
            $nik = $this->input->post('nik');
            $cekh = $this->db->get_where('pegawai', ['nik' => $nik])->row_array();

            $data = [
                'nik' => $nik,
                'kd_sekolah' => $kd_sekolah,           
                'nama_pegawai' =>  $nama_pegawai,
                'email_pegawai ' => $email_pegawai,
                'password' => password_hash('12345678', PASSWORD_DEFAULT),
                'role_id' => $role_id,
                'img' => 'default.jpg',
                'is_active' => 1,
            ];
            if ($cekh == 0) {
                $this->db->insert('pegawai', $data);
                // return json_encode(['status' => 'success', 'pesan' => 'Berhasil Ubah Data !']);
            } else {
                $this->db->where('nik', $nik);
                $this->db->update('pegawai', $data);
                // return json_encode(['status' => 'success', 'pesan' => 'Berhasil Ubah Data !']);
            }
        }
    }

    var $table = 'pegawai_data u';
    var $column_order = array('', 'u.nik', 'nama_lengkap'); //set order berdasarkan field yang di mau
    var $column_search = array('u.nik', 'nama_lengkap'); //set field yang bisa di search
    var $order = array('u.nik' => 'desc'); // default order 

    private function _get_data()
    {
        $this->db->select('u.*,pe.is_active,pe.email_pegawai,pr.*');
        $this->db->from($this->table);
        $this->db->join('pegawai pe', 'u.nik = pe.nik', 'left');
        $this->db->join('pegawai_role pr', 'pe.role_id = pr.id', 'left');
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

    public function get_tampil($limit, $start)
    {
        // return $this->db->get('pegawai_data', $limit, $start)->result_array();
        $this->db->order_by("nik", "desc");
        return $this->db->get('pegawai_data', $limit, $start)->result_array();
    }

    public function get_countdata()
    {
        return $this->db->get('pegawai_data')->num_rows();
    }

    public function get_departemen()
    {
        $this->db->select('*');
        $this->db->from('access_departemen');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_data()
    {
        $pegawai =
            $this->db->select('k.*,d.*,l.*,r.*')
            ->from('pegawai_data k')
            ->join('access_departemen d', 'k.dep_id = d.departemen_id', 'left')
            ->join('access_lokasi l', 'k.lok_id = l.lokasi_id', 'left')
            ->join('pegawai_role r', 'k.role_id = r.id', 'left')
            ->get()->result_array();
        return $pegawai;
    }

    public function get_data_admin()
    {
        $pegawai =
            $this->db->select('a.*,b.*,c.*')
            ->from('pegawai_data a')
            ->join('pegawai b', 'a.nik = b.nik', 'left')           
            ->join('pegawai_role c', 'b.role_id = c.id', 'left')            
            ->where(['a.status' => 1])
            ->get()->result_array();
        return $pegawai;
    }

    public function get_editData($id)
    {
        $bagidata =
            $this->db->select('k.*')
            ->from('pegawai_data k')
            ->where(['k.data_id' => $id])
            ->get()->row_array();
        return $bagidata;
    }
}
