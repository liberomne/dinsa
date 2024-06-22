<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Profil_Laundry extends CI_Model
{
    public function getProfilLaundry()
    {
        return $this->db->get('profil_laundry')->result(); //profil_laundry adalah nama tabel pada database
    }

    public function getPembayaran()
    {
        return $this->db->get('pembayaran')->result(); //pembayaran adalah nama tabel pada database
    }

    public function editProfilLaundry($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('profil_laundry')->row_array();
    }

    public function update($data, $id){
        $this->db->where('id', $id);
        $this->db->update('profil_laundry', $data);
    }
}