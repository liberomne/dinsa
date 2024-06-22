<?php

class M_Pembayaran extends CI_Model
{
    public function getPembayaran()
    {
        return $this->db->get('pembayaran')->result(); //pembayaran adalah nama tabel pada database
    }

    public function edit_pembayaran($id_pembayaran)
    {
        $this->db->where('id_pembayaran', $id_pembayaran);
        return $this->db->get('pembayaran')->row_array();
    }

    public function update($data, $id_pembayaran){
        $this->db->where('id_pembayaran', $id_pembayaran);
        $this->db->update('pembayaran', $data);
    }
}