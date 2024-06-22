<?php

class M_Krisar extends CI_Model
{
    public function getAllDataKrisar()
    {
        return $this->db->get('krisar')->result();
    }
    

    public function save()
    {
        $data = [
            "nama_pelanggan" => $this->input->post('nama_pelanggan'),
            "email" => $this->input->post('email'),
            "tanggal" => date('Y-m-d'),
            "kritik_saran" => $this->input->post('kritik_saran'),
            "id_pelanggan" => $this->session->userdata('id_pelanggan')
        ];
        $this->db->insert('krisar', $data);
    }
}